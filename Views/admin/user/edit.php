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
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/user') ?>">User</a></li>
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
                      <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('admin/user/update/'.$user['id_user']) ?>" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
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
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                            <input type="password" class="form-control" id="password" name="password">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" id="level" name="level" required>
                              <option value="">Pilih Level</option>
                              <option value="admin" <?= old('level', $user['level']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                              <option value="">Pilih Status</option>
                              <option value="1" <?= old('status', $user['status']) == '1' ? 'selected' : '' ?>>Aktif</option>
                              <option value="0" <?= old('status', $user['status']) == '0' ? 'selected' : '' ?>>Non-aktif</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="d-flex justify-content-end">
                        <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
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