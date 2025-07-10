<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\WarehouseStorageModel;
use App\Models\WarehouseModel;
use App\Models\CustomerModel;
use App\Models\PaymentModel;

class WarehouseStorageController extends BaseController
{
    protected $warehouseStorageModel;
    protected $warehouseModel;
    protected $customerModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->warehouseStorageModel = new WarehouseStorageModel();
        $this->warehouseModel = new WarehouseModel();
        $this->customerModel = new CustomerModel();
        $this->paymentModel = new PaymentModel();
        
        // Set memory limit
        ini_set('memory_limit', '256M');
    }

    public function index()
    {
        try {
            $perPage = 10; // Kurangi per page
            
            $storages = $this->warehouseStorageModel
                ->select('tb_warehouse_storage.*, tb_user.nama as customer_name, tb_warehouse.lokasi, tb_payment.total_bayar')
                ->join('tb_customer', 'tb_customer.id_customer = tb_warehouse_storage.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_warehouse', 'tb_warehouse.id_warehouse = tb_warehouse_storage.id_warehouse')
                ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                ->orderBy('tb_warehouse_storage.id_warehouse_storage', 'DESC')
                ->paginate($perPage, 'warehouse_storage_group');

            $data = [
                'title' => 'Data Warehouse Storage',
                'storages' => $storages,
                'pager' => $this->warehouseStorageModel->pager
            ];
            
            return view('admin/warehouse_storage/index', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in WarehouseStorageController::index: ' . $e->getMessage());
            return redirect()->to('/admin/home')->with('error', 'Terjadi kesalahan saat memuat data warehouse storage');
        }
    }

    public function detail($id)
    {
        try {
            $storage = $this->warehouseStorageModel
                ->select('tb_warehouse_storage.*, tb_user.nama as customer_name, tb_customer.email, tb_customer.no_telp, tb_warehouse.lokasi, tb_warehouse.kapasitas, tb_payment.total_bayar, tb_payment.metode_pembayaran, tb_payment.status as payment_status')
                ->join('tb_customer', 'tb_customer.id_customer = tb_warehouse_storage.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_warehouse', 'tb_warehouse.id_warehouse = tb_warehouse_storage.id_warehouse')
                ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                ->where('tb_warehouse_storage.id_warehouse_storage', $id)
                ->first();

            if (!$storage) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Warehouse Storage tidak ditemukan');
            }

            $data = [
                'title' => 'Detail Warehouse Storage',
                'storage' => $storage
            ];
            
            return view('admin/warehouse_storage/detail', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in WarehouseStorageController::detail: ' . $e->getMessage());
            return redirect()->to('/admin/warehouse-storage')->with('error', 'Terjadi kesalahan saat memuat detail storage');
        }
    }
}