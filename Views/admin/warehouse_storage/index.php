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
                            <th>Warehouse</th>
                            <th>Tipe</th>
                            <th>Volume (m³)</th>
                            <th>Periode</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $page = $pager->getCurrentPage() ?? 1;
                          $perPage = 10;
                          $no = ($page - 1) * $perPage + 1;
                          foreach ($storages as $storage): ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $storage['customer_name'] ?></td>
                            <td><?= $storage['lokasi'] ?></td>
                            <td>
                              <span class="badge bg-primary"><?= ucfirst($storage['tipe']) ?></span>
                            </td>
                            <td><?= number_format($storage['volume_tersimpan'], 2) ?></td>
                            <td>
                              <?= date('d/m/Y', strtotime($storage['tanggal_mulai'])) ?> - 
                              <?= date('d/m/Y', strtotime($storage['tanggal_berakhir'])) ?>
                            </td>
                            <td>Rp <?= number_format($storage['total_bayar'], 0, ',', '.') ?></td>
                            <td>
                              <a href="<?= base_url('admin/warehouse-storage/detail/'.$storage['id_warehouse_storage']) ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Detail
                              </a>
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
  </body>
  <!--end::Body-->
</html>