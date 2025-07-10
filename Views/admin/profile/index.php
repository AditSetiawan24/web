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
              <!-- Profile Info -->
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Informasi Profil</h3>
                  </div>
                  <div class="card-body text-center">
                    <div class="mb-3">
                      <i class="bi bi-person-circle" style="font-size: 5rem; color: #007bff;"></i>
                    </div>
                    <h5><?= $user['nama'] ?></h5>
                    <p class="text-muted">@<?= $user['username'] ?></p>
                    <span class="badge bg-<?= $user['level'] == 'admin' ? 'primary' : 'secondary' ?>">
                      <?= ucfirst($user['level']) ?>
                    </span>
                    <div class="mt-3">
                      <span class="badge bg-<?= $user['status'] == 1 ? 'success' : 'secondary' ?>">
                        <?= $user['status'] == 1 ? 'Aktif' : 'Non-aktif' ?>
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-3">
                  <div class="card-header">
                    <h3 class="card-title">Aksi Cepat</h3>
                  </div>
                  <div class="card-body">
                    <div class="d-grid gap-2">
                      <a href="<?= base_url('admin/profile/change-password') ?>" class="btn btn-warning">
                        <i class="bi bi-key"></i> Ubah Password
                      </a>
                      <a href="<?= base_url('logout') ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin logout?')">
                        <i class="bi bi-box-arrow-right"></i> Logout
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Edit Profile Form -->
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Edit Profil</h3>
                  </div>
                  <div class="card-body">
                    <?php if (session()->getFlashdata('success')): ?>
                      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                      <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('admin/profile/update') ?>" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?= old('nama', $user['nama']) ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?= old('username', $user['username']) ?>" required>
                          </div>
                        </div>
                      </div>
                      
                      <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-check-circle"></i> Update Profil
                        </button>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Account Statistics -->
                <div class="card mt-3">
                  <div class="card-header">
                    <h3 class="card-title">Statistik Akun</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="info-box">
                          <span class="info-box-icon bg-info">
                            <i class="bi bi-calendar"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Bergabung Sejak</span>
                            <span class="info-box-number">
                              <?= date('d F Y', strtotime('2025-01-01')) ?>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="info-box">
                          <span class="info-box-icon bg-success">
                            <i class="bi bi-clock"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Login Terakhir</span>
                            <span class="info-box-number">
                              <?= date('d/m/Y H:i') ?>
                            </span>
                          </div>
                        </div>
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

    <script>
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
    </script>
  </body>
  <!--end::Body-->
</html>