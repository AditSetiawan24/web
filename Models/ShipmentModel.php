<?php

namespace App\Models;

use CodeIgniter\Model;

class ShipmentModel extends Model
{
    protected $table = 'tb_shipment';
    protected $primaryKey = 'id_shipment';
    protected $allowedFields = ['id_customer', 'id_payment', 'tanggal_kirim', 'asal', 'tujuan', 'nama_penerima', 'no_telp_penerima', 'tipe', 'status'];
    protected $useTimestamps = false;
}