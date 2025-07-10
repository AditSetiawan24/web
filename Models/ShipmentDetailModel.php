<?php

namespace App\Models;

use CodeIgniter\Model;

class ShipmentDetailModel extends Model
{
    protected $table = 'tb_shipment_detail';
    protected $primaryKey = 'id_shipment_detail';
    protected $allowedFields = ['id_shipment', 'quantity', 'total_berat', 'total_volume', 'total_biaya'];
    protected $useTimestamps = false;
}