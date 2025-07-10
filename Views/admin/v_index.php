<!doctype html>
<html lang="en">
  <!--begin::Head-->
  
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
<?= $this->include('admin/template/header') ?>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <?= $this->include('admin/template/sidebar') ?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Dashboard</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            
            <!--begin::Stats Cards Row-->
            <div class="row mb-4">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
                <div class="small-box text-bg-primary">
                  <div class="inner">
                    <h3><?= $totalShipments ?? 0 ?></h3>
                    <p>Total Shipments</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 116 0h3a3 3 0 116 0h.375c1.035 0 1.875-.84 1.875-1.875V15zM8.25 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0zM15.75 19.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z"
                    ></path>
                  </svg>
                  <a
                    href="<?= base_url('admin/shipping') ?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3><?= $totalWarehouseStorage ?? 0 ?></h3>
                    <p>Warehouse Storage</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h15a3 3 0 013 3v4.146a4.466 4.466 0 00-.75-.146h-15c-.26 0-.508.05-.75.146z"
                    ></path>
                  </svg>
                  <a
                    href="<?= base_url('admin/warehouse-storage') ?>"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 3-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3><?= $totalCustomers ?? 0 ?></h3>
                    <p>Total Customers</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"
                    ></path>
                  </svg>
                  <a
                    href="<?= base_url('admin/customer') ?>"
                    class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 3-->
              </div>
              <!--end::Col-->
              
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-danger">
                  <div class="inner">
                    <h3>Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?></h3>
                    <p>Total Revenue</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                      d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v.816a3.836 3.836 0 00-1.72.756 2.25 2.25 0 000 3.78c.583.24 1.21.418 1.72.756V15a.75.75 0 001.5 0v-.647a4.062 4.062 0 001.828-.816 2.25 2.25 0 00.222-3.206 4.087 4.087 0 00-2.05-.971V6z"
                    ></path>
                  </svg>
                  <a
                    href="#"
                    class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
                  >
                    More info <i class="bi bi-link-45deg"></i>
                  </a>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Stats Cards Row-->
            
            <!--begin::Main Content Row-->
            <div class="row">
              <!--begin::Left Column-->
              <div class="col-lg-8">
                
                <!-- System Performance Card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">System Performance Overview</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <!-- Transaction Speed -->
                      <div class="col-md-6 mb-4">
                        <div class="info-box bg-gradient-primary">
                          <span class="info-box-icon">
                            <i class="fas fa-tachometer-alt"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Transaction Speed</span>
                            <span class="info-box-number">
                              <?= round((($totalShipments + $totalWarehouseStorage) / max(1, $monthlyOrders)) * 100, 1) ?>%
                            </span>
                            <div class="progress">
                              <div class="progress-bar" style="width: <?= min(100, round((($totalShipments + $totalWarehouseStorage) / max(1, $monthlyOrders)) * 10, 1)) ?>%"></div>
                            </div>
                            <span class="progress-description">Processing efficiency this month</span>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Customer Satisfaction -->
                      <div class="col-md-6 mb-4">
                        <div class="info-box bg-gradient-success">
                          <span class="info-box-icon">
                            <i class="fas fa-thumbs-up"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Completion Rate</span>
                            <?php 
                            $completedShipments = $statusStats['shipping']['selesai'] ?? 0;
                            $totalActiveShipments = array_sum($statusStats['shipping']);
                            $completionRate = $totalActiveShipments > 0 ? round(($completedShipments / $totalActiveShipments) * 100, 1) : 0;
                            ?>
                            <span class="info-box-number"><?= $completionRate ?>%</span>
                            <div class="progress">
                              <div class="progress-bar bg-success" style="width: <?= $completionRate ?>%"></div>
                            </div>
                            <span class="progress-description">Orders completed successfully</span>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Payment Success Rate -->
                      <div class="col-md-6 mb-4">
                        <div class="info-box bg-gradient-warning">
                          <span class="info-box-icon">
                            <i class="fas fa-credit-card"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Payment Success</span>
                            <?php 
                            $paidPayments = $statusStats['payment']['paid'] ?? 0;
                            $totalPayments = array_sum($statusStats['payment']);
                            $paymentRate = $totalPayments > 0 ? round(($paidPayments / $totalPayments) * 100, 1) : 0;
                            ?>
                            <span class="info-box-number"><?= $paymentRate ?>%</span>
                            <div class="progress">
                              <div class="progress-bar bg-warning" style="width: <?= $paymentRate ?>%"></div>
                            </div>
                            <span class="progress-description">Successful payment rate</span>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Storage Utilization -->
                      <div class="col-md-6 mb-4">
                        <div class="info-box bg-gradient-info">
                          <span class="info-box-icon">
                            <i class="fas fa-warehouse"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Storage Active</span>
                            <?php 
                            $activeStorage = $statusStats['warehouse']['active'] ?? 0;
                            $totalStorage = array_sum($statusStats['warehouse']);
                            $storageRate = $totalStorage > 0 ? round(($activeStorage / $totalStorage) * 100, 1) : 0;
                            ?>
                            <span class="info-box-number"><?= $storageRate ?>%</span>
                            <div class="progress">
                              <div class="progress-bar bg-info" style="width: <?= $storageRate ?>%"></div>
                            </div>
                            <span class="progress-description">Active warehouse utilization</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Recent Transactions Card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Recent Transactions</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Customer</th>
                            <th>Service Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($recentTransactions)): ?>
                            <?php foreach ($recentTransactions as $transaction): ?>
                            <tr>
                             
                              <td>
                                <strong><?= esc($transaction['customer_name']) ?></strong>
                              </td>
                              <td>
                                <?php if ($transaction['type'] == 'shipping'): ?>
                                  <span class="badge bg-primary">
                                    <i class="fas fa-shipping-fast me-1"></i>Shipping
                                  </span>
                                  <small class="d-block text-muted">
                                    <?= esc($transaction['asal']) ?> → <?= esc($transaction['tujuan']) ?>
                                  </small>
                                <?php else: ?>
                                  <span class="badge bg-success">
                                    <i class="fas fa-warehouse me-1"></i>Storage
                                  </span>
                                  <small class="d-block text-muted">
                                    <?= esc($transaction['lokasi']) ?>
                                  </small>
                                <?php endif; ?>
                              </td>
                              <td>
                                <strong>Rp <?= number_format($transaction['total_bayar'], 0, ',', '.') ?></strong>
                              </td>
                              <td>
                                <?php
                                $statusColor = '';
                                $statusIcon = '';
                                switch($transaction['status']) {
                                  case 'pending': 
                                    $statusColor = 'warning'; 
                                    $statusIcon = 'clock';
                                    break;
                                  case 'process': 
                                    $statusColor = 'info'; 
                                    $statusIcon = 'cogs';
                                    break;
                                  case 'selesai': 
                                    $statusColor = 'success'; 
                                    $statusIcon = 'check-circle';
                                    break;
                                  case 'cancel': 
                                    $statusColor = 'danger'; 
                                    $statusIcon = 'times-circle';
                                    break;
                                  case 'active': 
                                    $statusColor = 'success'; 
                                    $statusIcon = 'play-circle';
                                    break;
                                  case 'expired': 
                                    $statusColor = 'secondary'; 
                                    $statusIcon = 'stop-circle';
                                    break;
                                  default: 
                                    $statusColor = 'secondary';
                                    $statusIcon = 'question-circle';
                                }
                                ?>
                                <span class="badge bg-<?= $statusColor ?>">
                                  <i class="fas fa-<?= $statusIcon ?> me-1"></i><?= ucfirst(esc($transaction['status'])) ?>
                                </span>
                              </td>
                              <td>
                                <?php
                                $paymentColor = '';
                                $paymentIcon = '';
                                switch($transaction['payment_status']) {
                                  case 'pending': 
                                    $paymentColor = 'warning'; 
                                    $paymentIcon = 'hourglass-half';
                                    break;
                                  case 'paid': 
                                    $paymentColor = 'success'; 
                                    $paymentIcon = 'check-circle';
                                    break;
                                  case 'failed': 
                                    $paymentColor = 'danger'; 
                                    $paymentIcon = 'exclamation-triangle';
                                    break;
                                  default: 
                                    $paymentColor = 'secondary';
                                    $paymentIcon = 'question-circle';
                                }
                                ?>
                                <span class="badge bg-<?= $paymentColor ?>">
                                  <i class="fas fa-<?= $paymentIcon ?> me-1"></i><?= ucfirst(esc($transaction['payment_status'])) ?>
                                </span>
                              </td>
                              <td><?= date('d/m/Y', strtotime($transaction['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="7" class="text-center">
                                <i class="fas fa-inbox fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No recent transactions found</p>
                              </td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
              </div>
              <!--end::Left Column-->
              
              <!--begin::Right Column-->
              <div class="col-lg-4">
                
                <!-- Shipping Status Card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Shipping Status</h3>
                  </div>
                  <div class="card-body">
                    <?php 
                    $shippingTotal = array_sum($statusStats['shipping']); 
                    if ($shippingTotal > 0):
                      foreach ($statusStats['shipping'] as $status => $count):
                    ?>
                    <div class="progress-group mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold">
                          <?php
                          $statusIcon = '';
                          switch($status) {
                            case 'pending': $statusIcon = 'clock'; break;
                            case 'process': $statusIcon = 'cogs'; break;
                            case 'selesai': $statusIcon = 'check-circle'; break;
                            case 'cancel': $statusIcon = 'times-circle'; break;
                          }
                          ?>
                          <i class="fas fa-<?= $statusIcon ?> me-2"></i><?= ucfirst($status) ?>
                        </span>
                        <span><b><?= $count ?></b>/<?= $shippingTotal ?></span>
                      </div>
                      <div class="progress progress-sm">
                        <?php
                        $percentage = $shippingTotal > 0 ? round(($count / $shippingTotal) * 100) : 0;
                        $progressColor = '';
                        switch($status) {
                          case 'pending': $progressColor = 'bg-warning'; break;
                          case 'process': $progressColor = 'bg-info'; break;
                          case 'selesai': $progressColor = 'bg-success'; break;
                          case 'cancel': $progressColor = 'bg-danger'; break;
                        }
                        ?>
                        <div class="progress-bar <?= $progressColor ?>" style="width: <?= $percentage ?>%"></div>
                      </div>
                      <small class="text-muted"><?= $percentage ?>% of total shipments</small>
                    </div>
                    <?php 
                      endforeach;
                    else:
                    ?>
                      <div class="text-center">
                        <i class="fas fa-shipping-fast fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No shipping data available</p>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Warehouse Status Card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Warehouse Storage</h3>
                  </div>
                  <div class="card-body">
                    <?php 
                    $warehouseTotal = array_sum($statusStats['warehouse']); 
                    if ($warehouseTotal > 0):
                      foreach ($statusStats['warehouse'] as $status => $count):
                    ?>
                    <div class="progress-group mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold">
                          <i class="fas fa-<?= $status == 'active' ? 'play-circle' : 'stop-circle' ?> me-2"></i><?= ucfirst($status) ?> Storage
                        </span>
                        <span><b><?= $count ?></b>/<?= $warehouseTotal ?></span>
                      </div>
                      <div class="progress progress-sm">
                        <?php
                        $percentage = $warehouseTotal > 0 ? round(($count / $warehouseTotal) * 100) : 0;
                        $progressColor = $status == 'active' ? 'bg-success' : 'bg-secondary';
                        ?>
                        <div class="progress-bar <?= $progressColor ?>" style="width: <?= $percentage ?>%"></div>
                      </div>
                      <small class="text-muted"><?= $percentage ?>% of total storage</small>
                    </div>
                    <?php 
                      endforeach; 
                    else:
                    ?>
                      <div class="text-center">
                        <i class="fas fa-warehouse fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No warehouse storage data</p>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Payment Status Card -->
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Payment Status</h3>
                  </div>
                  <div class="card-body">
                    <?php 
                    $paymentTotal = array_sum($statusStats['payment']); 
                    if ($paymentTotal > 0):
                      foreach ($statusStats['payment'] as $status => $count):
                    ?>
                    <div class="progress-group mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-bold">
                          <?php
                          $paymentIcon = '';
                          switch($status) {
                            case 'pending': $paymentIcon = 'hourglass-half'; break;
                            case 'paid': $paymentIcon = 'check-circle'; break;
                            case 'failed': $paymentIcon = 'exclamation-triangle'; break;
                          }
                          ?>
                          <i class="fas fa-<?= $paymentIcon ?> me-2"></i><?= ucfirst($status) ?>
                        </span>
                        <span><b><?= $count ?></b>/<?= $paymentTotal ?></span>
                      </div>
                      <div class="progress progress-sm">
                        <?php
                        $percentage = $paymentTotal > 0 ? round(($count / $paymentTotal) * 100) : 0;
                        $progressColor = '';
                        switch($status) {
                          case 'pending': $progressColor = 'bg-warning'; break;
                          case 'paid': $progressColor = 'bg-success'; break;
                          case 'failed': $progressColor = 'bg-danger'; break;
                        }
                        ?>
                        <div class="progress-bar <?= $progressColor ?>" style="width: <?= $percentage ?>%"></div>
                      </div>
                      <small class="text-muted"><?= $percentage ?>% of total payments</small>
                    </div>
                    <?php 
                      endforeach;
                    else:
                    ?>
                      <div class="text-center">
                        <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No payment data available</p>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
              </div>
              <!--end::Right Column-->
              
            </div>
            <!--end::Main Content Row-->
            
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
        
      </main>
      <!--end::App Main-->
      
      <!--begin::Footer-->
      <?= $this->include('admin/template/footer') ?>
      <!--end::Footer-->
      
    </div>
    <!--end::App Wrapper-->

    <!-- Custom Styles -->
    <style>
      .info-box {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        transition: transform 0.3s;
      }
      
      .info-box:hover {
        transform: translateY(-5px);
      }
      
      .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
      }
      
      .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        color: white;
      }
      
      .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: black;
      }
      
      .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
        color: white;
      }
      
      .progress {
        height: 8px;
        background-color: rgba(255,255,255,0.3);
      }
      
      .card {
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
      }
      
      .table-responsive {
        border-radius: 8px;
      }
      
      .badge {
        font-size: 0.75rem;
      }
    </style>

    <!-- Custom Scripts -->
    <script>
      // Auto refresh data setiap 5 menit
      setInterval(function() {
        location.reload();
      }, 300000);
      
      // Tooltip initialization
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
    </script>
    
  </body>
  <!--end::Body-->
</html>