<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tb_payment';
    protected $primaryKey = 'id_payment';
    protected $allowedFields = ['id_customer', 'total_bayar', 'tanggal_pembayaran', 'metode_pembayaran', 'status'];
    protected $useTimestamps = false;
}