<!doctype html>
<html lang="en">
  <!--begin::Head-->

  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
          <!--begin::Head-->
  <?= $this->include('admin/template/header') ?>
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
                <h3 class="mb-0"><?= $title ?></h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item">Transaksi</li>
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/shipping') ?>">Shipping</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
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
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><?= $title ?></h3>
                    <div class="card-tools">
                      <a href="<?= base_url('admin/shipping') ?>" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <h5>Informasi Customer</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Nama</td>
                            <td>: <?= $shipment['customer_name'] ?></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>: <?= $shipment['email'] ?></td>
                          </tr>
                          <tr>
                            <td>No. Telp</td>
                            <td>: <?= $shipment['no_telp'] ?></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <h5>Informasi Pengiriman</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Asal</td>
                            <td>: <?= $shipment['asal'] ?></td>
                          </tr>
                          <tr>
                            <td>Tujuan</td>
                            <td>: <?= $shipment['tujuan'] ?></td>
                          </tr>
                          <tr>
                            <td>Tipe</td>
                            <td>: <span class="badge bg-info"><?= ucfirst($shipment['tipe']) ?></span></td>
                          </tr>
                          <tr>
                            <td>Tanggal Kirim</td>
                            <td>: <?= date('d/m/Y', strtotime($shipment['tanggal_kirim'])) ?></td>
                          </tr>
                          <tr>
                            <td>Status</td>
                            <td>: 
                              <?php
                              $statusColor = '';
                              switch($shipment['status']) {
                                case 'pending': $statusColor = 'warning'; break;
                                case 'process': $statusColor = 'info'; break;
                                case 'selesai': $statusColor = 'success'; break;
                                case 'cancel': $statusColor = 'danger'; break;
                              }
                              ?>
                              <span class="badge bg-<?= $statusColor ?>"><?= ucfirst($shipment['status']) ?></span>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-6">
                        <h5>Informasi Penerima</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Nama Penerima</td>
                            <td>: <?= $shipment['nama_penerima'] ?></td>
                          </tr>
                          <tr>
                            <td>No. Telp Penerima</td>
                            <td>: <?= $shipment['no_telp_penerima'] ?></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <h5>Detail Paket</h5>
                        <?php if ($shipmentDetail): ?>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Quantity</td>
                            <td>: <?= $shipmentDetail['quantity'] ?> paket</td>
                          </tr>
                          <tr>
                            <td>Total Berat</td>
                            <td>: <?= $shipmentDetail['total_berat'] ?> kg</td>
                          </tr>
                          <tr>
                            <td>Total Volume</td>
                            <td>: <?= $shipmentDetail['total_volume'] ?> m³</td>
                          </tr>
                          <tr>
                            <td>Total Biaya</td>
                            <td>: Rp <?= number_format($shipmentDetail['total_biaya'], 0, ',', '.') ?></td>
                          </tr>
                        </table>
                        <?php endif; ?>
                      </div>
                    </div>

                    <hr>

                    <h5>Informasi Pembayaran</h5>
                    <table class="table table-borderless">
                      <tr>
                        <td width="15%">Total Bayar</td>
                        <td>: Rp <?= number_format($shipment['total_bayar'], 0, ',', '.') ?></td>
                      </tr>
                      <tr>
                        <td>Metode Pembayaran</td>
                        <td>: <?= ucfirst($shipment['metode_pembayaran']) ?></td>
                      </tr>
                      <tr>
                        <td>Status Pembayaran</td>
                        <td>: 
                          <?php
                          $paymentStatusColor = '';
                          switch($shipment['payment_status']) {
                            case 'pending': $paymentStatusColor = 'warning'; break;
                            case 'paid': $paymentStatusColor = 'success'; break;
                            case 'failed': $paymentStatusColor = 'danger'; break;
                          }
                          ?>
                          <span class="badge bg-<?= $paymentStatusColor ?>"><?= ucfirst($shipment['payment_status']) ?></span>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Row-->
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
  </body>
  <!--end::Body-->
</html>