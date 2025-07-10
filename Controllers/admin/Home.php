<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\ShipmentModel;
use App\Models\WarehouseStorageModel;
use App\Models\CustomerModel;
use App\Models\PaymentModel;
use App\Models\WarehouseModel;
use App\Models\TeamModel;

class Home extends BaseController
{
    protected $shipmentModel;
    protected $warehouseStorageModel;
    protected $customerModel;
    protected $paymentModel;
    protected $warehouseModel;
    protected $teamModel;

    public function __construct()
    {
        $this->shipmentModel = new ShipmentModel();
        $this->warehouseStorageModel = new WarehouseStorageModel();
        $this->customerModel = new CustomerModel();
        $this->paymentModel = new PaymentModel();
        $this->warehouseModel = new WarehouseModel();
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        // Check if user is logged in and is admin
        if (!session()->get('ses_Login') || session()->get('ses_Level') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        try {
            // Get statistics
            $data = [
                'totalShipments' => $this->shipmentModel->countAll(),
                'totalWarehouseStorage' => $this->warehouseStorageModel->countAll(),
                'totalCustomers' => $this->customerModel->countAll(),
                'totalWarehouses' => $this->warehouseModel->countAll(),
                'totalTeamMembers' => $this->teamModel->countAll(),
                'totalRevenue' => $this->getTotalRevenue(),
                'statusStats' => $this->getDetailedStatusStats(),
                'recentTransactions' => $this->getRecentTransactions(),
                'topCustomers' => $this->getTopCustomers(),
                'monthlyOrders' => $this->getMonthlyOrders(),
                'todayOrders' => $this->getTodayOrders(),
                'monthlyShipping' => $this->getMonthlyShipping(),
                'monthlyWarehouse' => $this->getMonthlyWarehouse(),
                'monthlyRevenue' => $this->getMonthlyRevenue(),
                'paymentStats' => $this->getPaymentStats()
            ];

            return view('admin/v_index', $data);
            
        } catch (\Exception $e) {
            log_message('error', 'Error in Home::index: ' . $e->getMessage());
            return view('admin/v_index', [
                'totalShipments' => 0,
                'totalWarehouseStorage' => 0,
                'totalCustomers' => 0,
                'totalWarehouses' => 0,
                'totalTeamMembers' => 0,
                'totalRevenue' => 0,
                'statusStats' => [
                    'shipping' => ['pending' => 0, 'process' => 0, 'selesai' => 0, 'cancel' => 0],
                    'warehouse' => ['active' => 0, 'expired' => 0],
                    'payment' => ['pending' => 0, 'paid' => 0, 'failed' => 0]
                ],
                'recentTransactions' => [],
                'topCustomers' => [],
                'monthlyOrders' => 0,
                'todayOrders' => 0,
                'monthlyShipping' => array_fill(0, 12, 0),
                'monthlyWarehouse' => array_fill(0, 12, 0),
                'monthlyRevenue' => array_fill(0, 12, 0),
                'paymentStats' => ['pending' => 0, 'paid' => 0, 'failed' => 0]
            ]);
        }
    }

    private function getTotalRevenue()
    {
        try {
            // Langsung query dari tb_payment tanpa JOIN untuk menghindari duplikasi
            $result = $this->paymentModel
                ->selectSum('total_bayar', 'total')
                ->where('status', 'paid')
                ->first();
            
            return (int)($result['total'] ?? 0);
        } catch (\Exception $e) {
            log_message('error', 'Error in getTotalRevenue: ' . $e->getMessage());
            return 0;
        }
    }

    private function getDetailedStatusStats()
    {
        // Shipping status dari tb_shipment
        $shippingStats = $this->shipmentModel
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        $shipping = [
            'pending' => 0,
            'process' => 0,
            'selesai' => 0,
            'cancel' => 0
        ];

        foreach ($shippingStats as $stat) {
            if (isset($shipping[$stat['status']])) {
                $shipping[$stat['status']] = (int)$stat['count'];
            }
        }

        // Warehouse storage - cek berdasarkan tanggal_berakhir
        $totalWarehouse = $this->warehouseStorageModel->countAll();
        $activeWarehouse = 0;
        $expiredWarehouse = 0;

        if ($totalWarehouse > 0) {
            $activeWarehouse = $this->warehouseStorageModel
                ->where('tanggal_berakhir >=', date('Y-m-d'))
                ->countAllResults();
            $expiredWarehouse = $totalWarehouse - $activeWarehouse;
        }

        // Payment status dari tb_payment
        $paymentStats = $this->paymentModel
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        $payment = [
            'pending' => 0,
            'paid' => 0,
            'failed' => 0
        ];

        foreach ($paymentStats as $stat) {
            if (isset($payment[$stat['status']])) {
                $payment[$stat['status']] = (int)$stat['count'];
            }
        }

        return [
            'shipping' => $shipping,
            'warehouse' => [
                'active' => $activeWarehouse,
                'expired' => $expiredWarehouse
            ],
            'payment' => $payment
        ];
    }

    private function getPaymentStats()
    {
        $paymentStats = $this->paymentModel
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->findAll();

        $data = [
            'pending' => 0,
            'paid' => 0,
            'failed' => 0
        ];

        foreach ($paymentStats as $stat) {
            if (isset($data[$stat['status']])) {
                $data[$stat['status']] = (int)$stat['count'];
            }
        }

        return $data;
    }

    private function getRecentTransactions($limit = 10)
    {
        try {
            // Get recent shipments with correct field names
            $shipments = $this->shipmentModel
                ->select('tb_shipment.id_shipment as id, tb_shipment.*, tb_user.nama as customer_name, tb_payment.total_bayar, tb_payment.status as payment_status, tb_shipment.tanggal_kirim as created_at, "shipping" as type')
                ->join('tb_customer', 'tb_customer.id_customer = tb_shipment.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_payment', 'tb_payment.id_payment = tb_shipment.id_payment')
                ->orderBy('tb_shipment.id_shipment', 'DESC')
                ->limit($limit)
                ->findAll();

            // Get recent warehouse storage with correct field names
            $warehouses = $this->warehouseStorageModel
                ->select('tb_warehouse_storage.id_warehouse_storage as id, tb_warehouse_storage.*, tb_user.nama as customer_name, tb_payment.total_bayar, tb_payment.status as payment_status, tb_warehouse.lokasi, tb_warehouse_storage.tanggal_mulai as created_at, "warehouse" as type')
                ->join('tb_customer', 'tb_customer.id_customer = tb_warehouse_storage.id_customer')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_payment', 'tb_payment.id_payment = tb_warehouse_storage.id_payment')
                ->join('tb_warehouse', 'tb_warehouse.id_warehouse = tb_warehouse_storage.id_warehouse')
                ->orderBy('tb_warehouse_storage.id_warehouse_storage', 'DESC')
                ->limit($limit)
                ->findAll();

            // Add status for warehouse based on tanggal_berakhir
            foreach ($warehouses as &$warehouse) {
                $currentDate = date('Y-m-d');
                if (isset($warehouse['tanggal_berakhir']) && $warehouse['tanggal_berakhir'] >= $currentDate) {
                    $warehouse['status'] = 'active';
                } else {
                    $warehouse['status'] = 'expired';
                }
            }

            // Combine and sort by date
            $transactions = array_merge($shipments, $warehouses);
            
            // Sort by created_at descending
            usort($transactions, function($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return array_slice($transactions, 0, $limit);
        } catch (\Exception $e) {
            log_message('error', 'Error in getRecentTransactions: ' . $e->getMessage());
            return [];
        }
    }

    private function getTopCustomers($limit = 5)
    {
        try {
            // Gunakan DISTINCT untuk menghindari duplikasi payment
            return $this->customerModel
                ->select('tb_user.nama, COUNT(DISTINCT tb_payment.id_payment) as total_orders, SUM(DISTINCT tb_payment.total_bayar) as total_spent')
                ->join('tb_user', 'tb_user.id_user = tb_customer.id_user')
                ->join('tb_payment', 'tb_payment.id_customer = tb_customer.id_customer')
                ->where('tb_payment.status', 'paid')
                ->groupBy('tb_customer.id_customer, tb_user.nama')
                ->orderBy('total_spent', 'DESC')
                ->limit($limit)
                ->findAll();
        } catch (\Exception $e) {
            log_message('error', 'Error in getTopCustomers: ' . $e->getMessage());
            return [];
        }
    }

    private function getMonthlyOrders()
    {
        $currentMonth = date('Y-m');
        
        $shipments = $this->shipmentModel
            ->where("DATE_FORMAT(tanggal_kirim, '%Y-%m')", $currentMonth)
            ->countAllResults();

        $warehouses = $this->warehouseStorageModel
            ->where("DATE_FORMAT(tanggal_mulai, '%Y-%m')", $currentMonth)
            ->countAllResults();

        return $shipments + $warehouses;
    }

    private function getTodayOrders()
    {
        $today = date('Y-m-d');
        
        $shipments = $this->shipmentModel
            ->where('DATE(tanggal_kirim)', $today)
            ->countAllResults();

        $warehouses = $this->warehouseStorageModel
            ->where('DATE(tanggal_mulai)', $today)
            ->countAllResults();

        return $shipments + $warehouses;
    }

    private function getMonthlyShipping()
    {
        $data = [];
        $currentYear = date('Y');
        
        for ($month = 1; $month <= 12; $month++) {
            $count = $this->shipmentModel
                ->where('YEAR(tanggal_kirim)', $currentYear)
                ->where('MONTH(tanggal_kirim)', $month)
                ->countAllResults();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getMonthlyWarehouse()
    {
        $data = [];
        $currentYear = date('Y');
        
        for ($month = 1; $month <= 12; $month++) {
            $count = $this->warehouseStorageModel
                ->where('YEAR(tanggal_mulai)', $currentYear)
                ->where('MONTH(tanggal_mulai)', $month)
                ->countAllResults();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getMonthlyRevenue()
    {
            $data = [];
    $currentYear = date('Y');
    $totalMonths = 12;
    for ($month = 1; $month <= $totalMonths; $month++) {
        try {
            // Fetch total payment for the month without JOIN to avoid duplication
            $result = $this->paymentModel
                ->selectSum('total_bayar', 'total')
                ->where('status', 'paid')
                ->where('MONTH(tanggal_pembayaran)', $month)
                ->where('YEAR(tanggal_pembayaran)', $currentYear) // Ensure we are filtering by the current year
                ->first();
            // Store the total revenue for the month, defaulting to 0 if not set
            $data[] = (int)($result['total'] ?? 0);
        } catch (\Exception $e) {
            log_message('error', 'Error in getMonthlyRevenue for month ' . $month . ': ' . $e->getMessage());
            $data[] = 0; // Default to 0 on error
        }
        }
        
        return $data;
    }
}