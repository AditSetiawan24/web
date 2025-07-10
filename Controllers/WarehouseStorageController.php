<?php

namespace App\Controllers;

use App\Models\WarehouseStorageModel;
use App\Models\PaymentModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;

class WarehouseStorageController extends BaseController
{
    protected $warehouseStorageModel;
    protected $paymentModel;
    protected $customerModel;
    protected $warehouseModel;

    public function __construct()
    {
        $this->warehouseStorageModel = new WarehouseStorageModel();
        $this->paymentModel = new PaymentModel();
        $this->customerModel = new CustomerModel();
        $this->warehouseModel = new WarehouseModel();
    }

    private function checkLogin()
    {
        if (!session()->get('ses_Login')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        return null;
    }

    private function getCustomerId()
    {
        $userId = session()->get('ses_IdUser');
        $customer = $this->customerModel->where('id_user', $userId)->first();
        return $customer ? $customer['id_customer'] : null;
    }

    public function order($plan)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        if (!in_array($plan, ['basic', 'standard', 'advanced'])) {
            return redirect()->to('/price')->with('error', 'Paket tidak valid');
        }

        $warehouses = $this->warehouseModel->findAll();
        
        $data = [
            'title' => 'Order ' . ucfirst($plan) . ' Plan',
            'plan' => $plan,
            'warehouses' => $warehouses
        ];

        return view('warehouse/order', $data);
    }

    public function store()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan. Silakan lengkapi profil Anda.');
        }

        // Validasi dasar
        $validation = \Config\Services::validation();
        $validation->setRules([
            'plan' => 'required|in_list[basic,standard,advanced]',
            'warehouse' => 'required|integer',
            'tanggal_mulai' => 'required|valid_date',
            'durasi' => 'required|integer|greater_than[0]',
            'volume_tersimpan' => 'required|numeric|greater_than[0]',
            'metode_pembayaran' => 'required|in_list[debit/credit,VA,e-wallet]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Validasi kapasitas warehouse
        $warehouseId = $this->request->getPost('warehouse');
        $volumeInput = $this->request->getPost('volume_tersimpan');
        
        $warehouse = $this->warehouseModel->find($warehouseId);
        if (!$warehouse) {
            return redirect()->back()->withInput()->with('error', 'Warehouse tidak ditemukan');
        }

        // Validasi kapasitas: volume input tidak boleh melebihi total kapasitas warehouse
        if ($volumeInput > $warehouse['kapasitas']) {
            return redirect()->back()->withInput()->with('error', 
                'Volume yang diinput (' . number_format($volumeInput, 2) . ' m³) melebihi kapasitas warehouse (' . 
                number_format($warehouse['kapasitas'], 2) . ' m³).'
            );
        }

        // Hitung biaya berdasarkan plan dan durasi
        $plan = $this->request->getPost('plan');
        $durasi = $this->request->getPost('durasi');
        $volume = $this->request->getPost('volume_tersimpan');
        
        $biaya = $this->hitungBiaya($plan, $durasi, $volume);

        // Hitung tanggal berakhir
        $tanggalMulai = $this->request->getPost('tanggal_mulai');
        $tanggalBerakhir = date('Y-m-d', strtotime($tanggalMulai . ' + ' . $durasi . ' months'));

        try {
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            // Insert payment
            $paymentData = [
                'id_customer' => $customerId,
                'total_bayar' => $biaya,
                'tanggal_pembayaran' => date('Y-m-d'),
                'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                'status' => 'pending'
            ];
            $this->paymentModel->save($paymentData);
            $paymentId = $this->paymentModel->insertID();

            // Insert warehouse storage
            $storageData = [
                'id_warehouse' => $warehouseId,
                'id_customer' => $customerId,
                'id_payment' => $paymentId,
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_berakhir' => $tanggalBerakhir,
                'volume_tersimpan' => $volume,
                'tipe' => $plan
            ];
            $this->warehouseStorageModel->save($storageData);
            $storageId = $this->warehouseStorageModel->insertID();

            // Complete transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
            }

            // Redirect to payment page
            return redirect()->to('/warehouse/payment/' . $storageId)->with('success', 'Pesanan berhasil dibuat dengan ID: ' . $storageId);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function payment($storageId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->to('/')->with('error', 'Data customer tidak ditemukan');
        }

        // Get storage details with payment info
        $storage = $this->warehouseStorageModel->select('tb_warehouse_storage.*, tb_warehouse.lokasi, tb_payment.total_bayar, tb_payment.metode_pembayaran, tb_payment.status as payment_status, tb_payment.id_payment')
                                              ->join('tb_warehouse', 'tb_warehouse.id_warehouse = tb_warehouse_storage.id_warehouse')
                                              ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                                              ->where(['tb_warehouse_storage.id_warehouse_storage' => $storageId, 'tb_warehouse_storage.id_customer' => $customerId])
                                              ->first();

        if (!$storage) {
            return redirect()->to('/warehouse/my-orders')->with('error', 'Pesanan tidak ditemukan');
        }

        $data = [
            'title' => 'Pembayaran Warehouse',
            'storage' => $storage
        ];

        return view('warehouse/payment', $data);
    }

    public function processPayment($storageId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        
        // Get storage details
        $storage = $this->warehouseStorageModel->select('tb_warehouse_storage.*, tb_payment.id_payment')
                                              ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                                              ->where(['tb_warehouse_storage.id_warehouse_storage' => $storageId, 'tb_warehouse_storage.id_customer' => $customerId])
                                              ->first();

        if (!$storage) {
            return redirect()->to('/warehouse/my-orders')->with('error', 'Pesanan tidak ditemukan');
        }

        try {
            // Update payment status to paid
            $this->paymentModel->update($storage['id_payment'], [
                'status' => 'paid',
                'tanggal_pembayaran' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/warehouse/payment-success/' . $storageId)->with('success', 'Pembayaran berhasil diproses');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function paymentSuccess($storageId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $data = [
            'title' => 'Pembayaran Berhasil',
            'storageId' => $storageId
        ];

        return view('warehouse/payment_success', $data);
    }

    public function myOrders()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->to('/')->with('error', 'Data customer tidak ditemukan');
        }

        $orders = $this->warehouseStorageModel->select('tb_warehouse_storage.*, tb_warehouse.lokasi, tb_payment.total_bayar, tb_payment.metode_pembayaran, tb_payment.status as payment_status')
                                             ->join('tb_warehouse', 'tb_warehouse.id_warehouse = tb_warehouse_storage.id_warehouse')
                                             ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                                             ->where('tb_warehouse_storage.id_customer', $customerId)
                                             ->orderBy('tb_warehouse_storage.id_warehouse_storage', 'DESC')
                                             ->findAll();

        $data = [
            'title' => 'Pesanan Warehouse Saya',
            'orders' => $orders
        ];

        return view('warehouse/my_orders', $data);
    }

    // Method untuk mendapatkan kapasitas warehouse (untuk AJAX - optional)
    public function getWarehouseCapacity($warehouseId)
    {
        $warehouse = $this->warehouseModel->find($warehouseId);
        if (!$warehouse) {
            return $this->response->setJSON(['error' => 'Warehouse tidak ditemukan']);
        }

        // Hitung kapasitas yang sudah terpakai (opsional untuk implementasi lanjutan)
        $usedCapacity = $this->warehouseStorageModel
                           ->selectSum('volume_tersimpan')
                           ->where('id_warehouse', $warehouseId)
                           ->where('tanggal_berakhir >=', date('Y-m-d'))
                           ->get()
                           ->getRow()
                           ->volume_tersimpan ?? 0;

        $availableCapacity = $warehouse['kapasitas'] - $usedCapacity;

        return $this->response->setJSON([
            'total_capacity' => $warehouse['kapasitas'],
            'used_capacity' => $usedCapacity,
            'available_capacity' => $availableCapacity
        ]);
    }

    // Method untuk success page setelah order dibuat
    public function success()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $data = [
            'title' => 'Pesanan Berhasil'
        ];

        return view('warehouse/success', $data);
    }

    private function hitungBiaya($plan, $durasi, $volume)
    {
        $tarifDasar = [
            'basic' => 49,      // $49/month
            'standard' => 99,   // $99/month
            'advanced' => 149   // $149/month
        ];

        $tarif = $tarifDasar[$plan] ?? 99;
        $biayaVolume = $volume * 10; // $10 per m³
        
        // Convert to Rupiah (assuming 1 USD = 15,000 IDR)
        $totalUSD = ($tarif * $durasi) + $biayaVolume;
        $totalIDR = $totalUSD * 15000;

        return $totalIDR;
    }
}