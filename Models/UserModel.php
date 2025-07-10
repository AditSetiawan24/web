<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'username', 'password', 'level', 'status'];
    protected $useTimestamps = false;
}