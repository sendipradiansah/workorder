<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        //
        if (session()->get('is_logged_in') == TRUE) {
            return redirect()->to('/');
        }
        
        return view('login_view');

    }

    public function login(){
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
                    'id'            => $data['id'],
                    'name'          => $data['name'],
                    'username'      => $data['username'],
                    'role'          => $data['role'],
                    'is_logged_in'  => TRUE
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
