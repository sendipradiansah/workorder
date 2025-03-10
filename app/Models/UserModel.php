<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    // protected $returnType = "object";
    protected $allowedFields = ['id', 'name', 'username', 'password', 'role', 'active', 'is_deleted'];

    public function getListOperator(){
        $builder = $this->db->table('users');

        $builder->where('role', 'operator');
        return $builder->get()->getResultArray();
    }
}
