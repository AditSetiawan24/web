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
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/warehouse-storage') ?>">Warehouse Storage</a></li>
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
                      <a href="<?= base_url('admin/warehouse-storage') ?>" class="btn btn-secondary btn-sm">
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
                            <td>: <?= $storage['customer_name'] ?></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>: <?= $storage['email'] ?></td>
                          </tr>
                          <tr>
                            <td>No. Telp</td>
                            <td>: <?= $storage['no_telp'] ?></td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <h5>Informasi Warehouse</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Lokasi</td>
                            <td>: <?= $storage['lokasi'] ?></td>
                          </tr>
                          <tr>
                            <td>Kapasitas Total</td>
                            <td>: <?= number_format($storage['kapasitas'], 2) ?> m³</td>
                          </tr>
                          <tr>
                            <td>Tipe Storage</td>
                            <td>: <span class="badge bg-primary"><?= ucfirst($storage['tipe']) ?></span></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-6">
                        <h5>Detail Storage</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Volume Tersimpan</td>
                            <td>: <?= number_format($storage['volume_tersimpan'], 2) ?> m³</td>
                          </tr>
                          <tr>
                            <td>Tanggal Mulai</td>
                            <td>: <?= date('d F Y', strtotime($storage['tanggal_mulai'])) ?></td>
                          </tr>
                          <tr>
                            <td>Tanggal Berakhir</td>
                            <td>: <?= date('d F Y', strtotime($storage['tanggal_berakhir'])) ?></td>
                          </tr>
                          <tr>
                            <td>Durasi</td>
                            <td>: 
                              <?php
                              $start = new DateTime($storage['tanggal_mulai']);
                              $end = new DateTime($storage['tanggal_berakhir']);
                              $diff = $start->diff($end);
                              echo $diff->days . ' hari';
                              ?>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-6">
                        <h5>Informasi Pembayaran</h5>
                        <table class="table table-borderless">
                          <tr>
                            <td width="30%">Total Bayar</td>
                            <td>: Rp <?= number_format($storage['total_bayar'], 0, ',', '.') ?></td>
                          </tr>
                          <tr>
                            <td>Metode Pembayaran</td>
                            <td>: <?= ucfirst($storage['metode_pembayaran']) ?></td>
                          </tr>
                          <tr>
                            <td>Status Pembayaran</td>
                            <td>: 
                              <?php
                              $paymentStatusColor = '';
                              switch($storage['payment_status']) {
                                case 'pending': $paymentStatusColor = 'warning'; break;
                                case 'paid': $paymentStatusColor = 'success'; break;
                                case 'failed': $paymentStatusColor = 'danger'; break;
                              }
                              ?>
                              <span class="badge bg-<?= $paymentStatusColor ?>"><?= ucfirst($storage['payment_status']) ?></span>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
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