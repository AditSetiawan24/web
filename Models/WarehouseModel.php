<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model
{
    protected $table = 'tb_warehouse';
    protected $primaryKey = 'id_warehouse';
    protected $allowedFields = ['lokasi', 'kapasitas'];
    protected $useTimestamps = false;
}