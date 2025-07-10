<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseStorageModel extends Model
{
    protected $table = 'tb_warehouse_storage';
    protected $primaryKey = 'id_warehouse_storage';
    protected $allowedFields = [
        'id_warehouse', 
        'id_customer', 
        'id_payment', 
        'tanggal_mulai', 
        'tanggal_berakhir', 
        'volume_tersimpan', 
        'tipe'
    ];
    protected $useTimestamps = false;
}