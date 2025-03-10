<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel  = new UserModel;
    }

    public function index(): string
    {
        $data['data'] = $this->userModel->findAll();
        return view('workorder_view', $data);
    }

    public function getListOperator()
    {
        $data = $this->userModel->getListOperator();

        return response()->setJSON($data);
    }
}

?>