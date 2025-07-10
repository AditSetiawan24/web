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
                  </div>
                  <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Tipe</th>
                            <th>Tanggal Kirim</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $page = $pager->getCurrentPage() ?? 1;
                          $perPage = 10;
                          $no = ($page - 1) * $perPage + 1;
                          foreach ($shipments as $shipment): ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $shipment['customer_name'] ?></td>
                            <td><?= $shipment['asal'] ?></td>
                            <td><?= $shipment['tujuan'] ?></td>
                            <td>
                              <span class="badge bg-info"><?= ucfirst($shipment['tipe']) ?></span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($shipment['tanggal_kirim'])) ?></td>
                            <td>Rp <?= number_format($shipment['total_bayar'], 0, ',', '.') ?></td>
                            <td>
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
                            <td>
                              <a href="<?= base_url('admin/shipping/detail/'.$shipment['id_shipment']) ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                              </a>
                              <?php if ($shipment['status'] != 'selesai' && $shipment['status'] != 'cancel'): ?>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                    Update Status
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $shipment['id_shipment'] ?>, 'process')">Process</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $shipment['id_shipment'] ?>, 'selesai')">Selesai</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="updateStatus(<?= $shipment['id_shipment'] ?>, 'cancel')">Cancel</a></li>
                                  </ul>
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      
                      <!-- Pagination sederhana hanya angka -->
                      <?php if ($pager): ?>
                        <div class="d-flex justify-content-center mt-3">
                          <?php 
                          $currentPage = $pager->getCurrentPage();
                          $totalPages = $pager->getPageCount();
                          
                          for ($i = 1; $i <= $totalPages; $i++): ?>
                            <?php if ($i == $currentPage): ?>
                              <span class="badge bg-primary mx-1"><?= $i ?></span>
                            <?php else: ?>
                              <a href="<?= $pager->getPageURI($i) ?>" class="btn btn-outline-primary btn-sm mx-1"><?= $i ?></a>
                            <?php endif; ?>
                          <?php endfor; ?>
                        </div>
                      <?php endif; ?>
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

    <form id="statusForm" method="post" style="display: none;">
      <input type="hidden" name="status" id="statusInput">
    </form>

    <script>
    function updateStatus(id, status) {
      if (confirm('Yakin ingin mengupdate status?')) {
        document.getElementById('statusInput').value = status;
        document.getElementById('statusForm').action = '<?= base_url('admin/shipping/update-status/') ?>' + id;
        document.getElementById('statusForm').submit();
      }
    }
    </script>
  </body>
  <!--end::Body-->
</html>