<?php 

namespace App\Controllers;

use App\Models\WorkOrderModel;

class WorkOrder extends BaseController
{

    protected $workOrderModel;

    protected $helpers = ['form'];

    public function __construct(){
        $this->workOrderModel = new WorkOrderModel;
    }

    public function index(): string
    {
        $data['data'] = $this->workOrderModel->getListDataWO();
        return view('workorder/workorder_view', $data);
    }

    public function add()
    {
        return view('workorder/workorder_add_view');
    }

    public function insert()
    {

        $nowDate = date('Ymd');

        $lastWO = $this->workOrderModel->getTotalWOToday();

        // $lastnumber = str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        // $idWO = 'WO-' . $nowDate . '-' . $lastnumber;

        $newNumber = 1; 

        if ($lastWO) {
            // Ambil 4 digit terakhir sebagai nomor urut
            $lastNumber = intval(substr($lastWO['workorder_number'], -4));
            $newNumber = $lastNumber + 1; // Tambah 1 untuk nomor baru
        }

        // Format nomor baru
        $newWoNumber = sprintf("WO-%s-%04d", $nowDate, $newNumber);

        $rules = [
            'product_name' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Kolom Nama Produk harus diisi.',
                    'min_length'    => 'Kolom Nama Produk minimal harus berisi 3 karakter.'
                ],
            ],
            'quantity' => [
                'rules'  => 'required|integer|greater_than[0]',
                'errors' => [
                    'required'          => 'Kolom Jumlah harus diisi.',
                    'integer'           => 'Kolom Jumlah harus diisi angka.',
                    'greater_than'      => 'Kolom Jumlah harus diisi lebih dari 0.',
                ],
            ],
            'deadline' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kolom Batas Waktu harus diisi.',
                ],
            ],
            'operator' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kolom Operator harus diisi.',
                ]
            ]
        ];

        // if(!$this->validate($rules, $messages)){
        if(!$this->validate($rules)){
            $validation = \Config\Services::validation();
            // return view('workorder_add_view', ['validation' => $this->validator]);
            return redirect()->to('/workorder/add')->withInput()->with('validation', $this->validator);
        }


        $data = [
            'workorder_number'          => $newWoNumber,
            'product_name'              => $this->request->getPost('product_name'),
            'quantity'                  => $this->request->getPost('quantity'),
            'deadline'                  => $this->request->getPost('deadline'),
            'operator'                  => $this->request->getPost('operator'),
            'status'                    => 'Pending',
            'created_by'                => session()->get('id'),
            'updated_by'                => session()->get('id'),
            'created_at'                => date('Y-m-d H:i:s'),
            'updated_at'                => date('Y-m-d H:i:s')              
        ];

        $this->workOrderModel->insert($data);

        return redirect()->to('/workorder')->with('success', 'Work Order berhasil ditambahkan');
    }

    public function detail($id)
    {
        $data['data'] = $this->workOrderModel->getDetailWO($id);
        return view('workorder/workorder_detail_view', $data);
    }

    public function edit($id)
    {
        $data['data'] = $this->workOrderModel->find($id);
        return view('workorder/workorder_edit_view', $data);
    }

    public function update($id)
    {
        $rules = [
            'product_name' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required'      => 'Kolom Nama Produk harus diisi.',
                    'min_length'    => 'Kolom Nama Produk minimal harus berisi 3 karakter.'
                ],
            ],
            'quantity' => [
                'rules'  => 'required|integer|greater_than[0]',
                'errors' => [
                    'required'          => 'Kolom Jumlah harus diisi.',
                    'integer'           => 'Kolom Jumlah harus diisi angka.',
                    'greater_than'      => 'Kolom Jumlah harus diisi lebih dari 0.',
                ],
            ],
            'deadline' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kolom Batas Waktu harus diisi.',
                ],
            ],
            'operator' => [
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'Kolom Operator harus diisi.',
                ]
            ]
        ];

        if(!$this->validate($rules)){
            return redirect()->to('/workorder/edit/'. $id)->withInput()->with('validation', $this->validator);
        }

        $data = [
                'product_name'              => $this->request->getPost('product_name'),
                'quantity'                  => $this->request->getPost('quantity'),
                'deadline'                  => $this->request->getPost('deadline'),
                'operator'                  => $this->request->getPost('operator'),
                'status'                    => $this->request->getPost('status'),
                'updated_by'                => session()->get('id'),
                'updated_at'                => date('Y-m-d H:i:s')              
        ];

        $this->workOrderModel->update($id, $data);

        return redirect()->to('/workorder')->with('success', 'Work Order berhasil diubah');
    }

    public function delete($id){

        $data = [
                'is_deleted'                => '1',
                'updated_by'                => session()->get('id'),
                'updated_at'                => date('Y-m-d H:i:s')
        ];

        $this->workOrderModel->update($id, $data);

        $this->workOrderModel->getlastQuery();exit;
       
        return redirect()->to('/workorder')->with('success', 'Work Order berhasil dihapus');

    }
}