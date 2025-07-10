<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ShipmentModel;
use App\Models\ShipmentDetailModel;
use App\Models\CustomerModel;
use App\Models\PaymentModel;

class ShipmentController extends BaseController
{
    protected $shipmentModel;
    protected $shipmentDetailModel;
    protected $customerModel;
    protected $paymentModel;

    public function __construct()
    {
        $this->shipmentModel = new ShipmentModel();
        $this->shipmentDetailModel = new ShipmentDetailModel();
        $this->customerModel = new CustomerModel();
        $this->paymentModel = new PaymentModel();
        
        // Set memory limit for this controller
        ini_set('memory_limit', '256M');
    }

    public function index()
    {
        try {
            $perPage = 10; // Kurangi per page untuk menghemat memory
            
            $shipments = $this->shipmentModel
                ->select('tb_shipment.*, tb_user.nama as customer_name, tb_payment.total_bayar')
                ->join('tb_customer', 'tb_customer.id_customer = tb_shipment.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                ->orderBy('tb_shipment.id_shipment', 'DESC')
                ->paginate($perPage, 'shipment_group');

            $data = [
                'title' => 'Data Shipping',
                'shipments' => $shipments,
                'pager' => $this->shipmentModel->pager
            ];
            
            return view('admin/shipping/index', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in ShipmentController::index: ' . $e->getMessage());
            return redirect()->to('/admin/home')->with('error', 'Terjadi kesalahan saat memuat data shipping');
        }
    }

    public function detail($id)
    {
        try {
            $shipment = $this->shipmentModel
                ->select('tb_shipment.*, tb_user.nama as customer_name, tb_customer.email, tb_customer.no_telp, tb_payment.total_bayar, tb_payment.metode_pembayaran, tb_payment.status as payment_status')
                ->join('tb_customer', 'tb_customer.id_customer = tb_shipment.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                ->where('tb_shipment.id_shipment', $id)
                ->first();

            if (!$shipment) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Shipment tidak ditemukan');
            }

            $shipmentDetail = $this->shipmentDetailModel->where('id_shipment', $id)->first();

            $data = [
                'title' => 'Detail Shipping',
                'shipment' => $shipment,
                'shipmentDetail' => $shipmentDetail
            ];
            
            return view('admin/shipping/detail', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in ShipmentController::detail: ' . $e->getMessage());
            return redirect()->to('/admin/shipping')->with('error', 'Terjadi kesalahan saat memuat detail shipping');
        }
    }

    public function updateStatus($id)
    {
        try {
            $shipment = $this->shipmentModel->find($id);
            
            if (!$shipment) {
                return redirect()->to('/admin/shipping')->with('error', 'Shipment tidak ditemukan');
            }

            $status = $this->request->getPost('status');
            
            $this->shipmentModel->update($id, ['status' => $status]);
            return redirect()->to('/admin/shipping')->with('success', 'Status shipment berhasil diupdate');
            
        } catch (\Exception $e) {
            log_message('error', 'Error in ShipmentController::updateStatus: ' . $e->getMessage());
            return redirect()->to('/admin/shipping')->with('error', 'Terjadi kesalahan saat mengupdate status');
        }
    }
}