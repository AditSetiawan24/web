<?php

namespace App\Controllers;

use App\Models\ShipmentModel;
use App\Models\ShipmentDetailModel;
use App\Models\PaymentModel;
use App\Models\CustomerModel;

class ShipmentController extends BaseController
{
    protected $shipmentModel;
    protected $shipmentDetailModel;
    protected $paymentModel;
    protected $customerModel;

    public function __construct()
    {
        $this->shipmentModel = new ShipmentModel();
        $this->shipmentDetailModel = new ShipmentDetailModel();
        $this->paymentModel = new PaymentModel();
        $this->customerModel = new CustomerModel();
    }

    private function checkLogin()
    {
        if (!session()->get('ses_Login')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan');
        }
        return null;
    }

    private function getCustomerId()
    {
        $userId = session()->get('ses_IdUser');
        $customer = $this->customerModel->where('id_user', $userId)->first();
        return $customer ? $customer['id_customer'] : null;
    }

    public function order($tipe = null)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        if (!in_array($tipe, ['udara', 'darat', 'laut', 'kereta'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tipe pengiriman tidak valid');
        }

        $data = [
            'title' => 'Pemesanan ' . ucfirst($tipe) . ' Freight',
            'tipe' => $tipe
        ];
        
        return view('shipment/order', $data);
    }

    public function store()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->back()->with('error', 'Data customer tidak ditemukan. Silakan lengkapi profil Anda.');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal_kirim' => 'required|valid_date',
            'asal' => 'required|min_length[3]',
            'tujuan' => 'required|min_length[3]',
            'nama_penerima' => 'required|min_length[3]',
            'no_telp_penerima' => 'required|min_length[10]',
            'tipe' => 'required|in_list[udara,darat,laut,kereta]',
            'quantity' => 'required|integer|greater_than[0]',
            'total_berat' => 'required|numeric|greater_than[0]',
            'total_volume' => 'required|numeric|greater_than[0]',
            'metode_pembayaran' => 'required|in_list[debit/credit,VA,e-wallet]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Hitung biaya berdasarkan tipe dan detail
        $biaya = $this->hitungBiaya(
            $this->request->getPost('tipe'),
            $this->request->getPost('total_berat'),
            $this->request->getPost('total_volume'),
            $this->request->getPost('quantity')
        );

        try {
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            // Insert payment with pending status
            $paymentData = [
                'id_customer' => $customerId,
                'total_bayar' => $biaya,
                'tanggal_pembayaran' => date('Y-m-d'),
                'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                'status' => 'pending'
            ];
            $this->paymentModel->save($paymentData);
            $paymentId = $this->paymentModel->insertID();

            // Insert shipment
            $shipmentData = [
                'id_customer' => $customerId,
                'id_payment' => $paymentId,
                'tanggal_kirim' => $this->request->getPost('tanggal_kirim'),
                'asal' => $this->request->getPost('asal'),
                'tujuan' => $this->request->getPost('tujuan'),
                'nama_penerima' => $this->request->getPost('nama_penerima'),
                'no_telp_penerima' => $this->request->getPost('no_telp_penerima'),
                'tipe' => $this->request->getPost('tipe'),
                'status' => 'pending'
            ];
            $this->shipmentModel->save($shipmentData);
            $shipmentId = $this->shipmentModel->insertID();

            // Insert shipment detail
            $detailData = [
                'id_shipment' => $shipmentId,
                'quantity' => $this->request->getPost('quantity'),
                'total_berat' => $this->request->getPost('total_berat'),
                'total_volume' => $this->request->getPost('total_volume'),
                'total_biaya' => $biaya
            ];
            $this->shipmentDetailModel->save($detailData);

            // Complete transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
            }

            // Redirect to payment page with order ID
            return redirect()->to('/shipment/payment/' . $shipmentId)->with('success', 'Pesanan berhasil dibuat dengan ID: ' . $shipmentId);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Method untuk halaman pembayaran
    public function payment($orderId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->to('/')->with('error', 'Data customer tidak ditemukan');
        }

        // Get order details with payment info
        $order = $this->shipmentModel->select('tb_shipment.*, tb_shipment_detail.*, tb_payment.total_bayar, tb_payment.metode_pembayaran, tb_payment.status as payment_status, tb_payment.id_payment')
                                    ->join('tb_shipment_detail', 'tb_shipment_detail.id_shipment = tb_shipment.id_shipment')
                                    ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                                    ->where(['tb_shipment.id_shipment' => $orderId, 'tb_shipment.id_customer' => $customerId])
                                    ->first();

        if (!$order) {
            return redirect()->to('/shipment/my-orders')->with('error', 'Pesanan tidak ditemukan');
        }

        $data = [
            'title' => 'Pembayaran',
            'order' => $order
        ];

        return view('shipment/payment', $data);
    }

    // Method untuk proses pembayaran
    public function processPayment($orderId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        
        // Get order details
        $order = $this->shipmentModel->select('tb_shipment.*, tb_payment.id_payment')
                                    ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                                    ->where(['tb_shipment.id_shipment' => $orderId, 'tb_shipment.id_customer' => $customerId])
                                    ->first();

        if (!$order) {
            return redirect()->to('/shipment/my-orders')->with('error', 'Pesanan tidak ditemukan');
        }

        try {
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();

            // Update payment status to paid
            $this->paymentModel->update($order['id_payment'], [
                'status' => 'paid',
                'tanggal_pembayaran' => date('Y-m-d H:i:s')
            ]);

            // Update shipment status to process
            $this->shipmentModel->update($orderId, [
                'status' => 'process'
            ]);

            // Complete transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran');
            }

            return redirect()->to('/shipment/payment-success/' . $orderId)->with('success', 'Pembayaran berhasil diproses');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function paymentSuccess($orderId)
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $data = [
            'title' => 'Pembayaran Berhasil',
            'orderId' => $orderId
        ];

        return view('shipment/payment_success', $data);
    }

    private function hitungBiaya($tipe, $berat, $volume, $quantity)
    {
        $tarifDasar = [
            'udara' => 15000,
            'darat' => 8000,
            'laut' => 5000,
            'kereta' => 10000
        ];

        $tarif = $tarifDasar[$tipe] ?? 8000;
        $biayaBerat = $berat * 2000; // Rp 2000 per kg
        $biayaVolume = $volume * 1000; // Rp 1000 per m³
        $biayaQuantity = $quantity * 5000; // Rp 5000 per item

        return $tarif + $biayaBerat + $biayaVolume + $biayaQuantity;
    }

    public function success()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        return view('shipment/success');
    }

    public function myOrders()
    {
        $loginCheck = $this->checkLogin();
        if ($loginCheck) return $loginCheck;

        $customerId = $this->getCustomerId();
        if (!$customerId) {
            return redirect()->to('/')->with('error', 'Data customer tidak ditemukan');
        }

        $orders = $this->shipmentModel->select('tb_shipment.*, tb_shipment_detail.*, tb_payment.total_bayar, tb_payment.metode_pembayaran')
                                     ->join('tb_shipment_detail', 'tb_shipment_detail.id_shipment = tb_shipment.id_shipment')
                                     ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                                     ->where('tb_shipment.id_customer', $customerId)
                                     ->orderBy('tb_shipment.id_shipment', 'DESC')
                                     ->findAll();

        $data = [
            'title' => 'Pesanan Saya',
            'orders' => $orders
        ];

        return view('shipment/my_orders', $data);
    }
}