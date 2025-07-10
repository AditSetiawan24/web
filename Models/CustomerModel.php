<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'tb_customer';
    protected $primaryKey = 'id_customer';
    protected $allowedFields = ['id_user', 'email', 'alamat', 'no_telp'];
    protected $useTimestamps = false;
    
    public function getCustomerWithUser()
    {
        return $this->select('tb_customer.*, tb_user.nama, tb_user.username')
                    ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                    ->findAll();
    }
}