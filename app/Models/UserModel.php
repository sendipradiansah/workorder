<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    // protected $returnType = "object";
    protected $allowedFields = ['id', 'username', 'password', 'role', 'active', 'is_deleted'];
}
