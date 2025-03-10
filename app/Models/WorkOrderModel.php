<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkOrderModel extends Model
{
    protected $table    = 'workorders';
    
    protected $allowedFields = ['id', 'workorder_number', 'product_name', 'quantity', 'deadline','operator', 'status', 'is_deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function getListDataWO(){
        $builder = $this->db->table('workorders w');
        $builder->select('w.id, w.workorder_number, w.product_name, w.quantity, w.deadline, s.name, w.status, w.is_deleted, w.created_by, w.updated_by, w.created_at, w.updated_at');
        $builder->where('w.is_deleted', '0');
        if(session()->get('role') == 'operator'){
            $builder->where('w.operator', session()->get('id'));
        }
        $builder->join('users s', 's.id = w.operator', 'left');
        return $builder->get()->getResultArray();

    }

    public function getTotalWOToday(){
        $builder = $this->db->table('workorders');
        $builder->where('DATE(created_at)', date('Y-m-d'));
        $builder->orderBy('workorder_number', 'DESC');
        $builder->limit(1);
        return $builder->get()->getRowArray();
    }

    public function getDetailWO($id){
        $builder = $this->db->table('workorders w');
        $builder->select('w.id, w.workorder_number, w.product_name, w.quantity, w.deadline, s.name, w.status, w.is_deleted, w.created_by, w.updated_by, w.created_at, w.updated_at');
        $builder->where('w.id', $id);
        $builder->where('w.is_deleted', '0');
        $builder->join('users s', 's.id = w.operator', 'left');
        return $builder->get()->getRowArray();
    }
}

