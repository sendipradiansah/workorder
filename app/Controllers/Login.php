<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        //
        return view('login_view');
    }

    public function auth(){
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where(['username' => $username])->first();

        if($data){
            // $passwordDB = password_hash('sendi', PASSWORD_DEFAULT);
            // print_r($passwordDB);exit;
            $passwordDB = $data['password'];
            $verify_password = password_verify($password, $passwordDB);
            if($verify_password){
                $session_data = [
                    // 'nama' => $data['nama'],
                    'username' => $data['username'],
                    'role'      => $data['role']

                ];
                $session->set($session_data);
                return redirect()->to('/');
            }else{
                $session->setFlashdata('msg', 'Maaf, password yang anda masukkan salah!');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Maaf, Username tidak ditemukan!');
            return redirect()->to('/login');

        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
        
    }
}
