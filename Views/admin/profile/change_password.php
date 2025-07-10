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
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/profile') ?>">Pengaturan Akun</a></li>
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
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="bi bi-key me-2"></i><?= $title ?>
                    </h3>
                    <div class="card-tools">
                      <a href="<?= base_url('admin/profile') ?>" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                      </a>
                    </div>
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

                    <!-- User Info -->
                    <div class="alert alert-info">
                      <i class="bi bi-info-circle me-2"></i>
                      <strong>Pengguna:</strong> <?= $user['nama'] ?> (@<?= $user['username'] ?>)
                    </div>
                    
                    <form action="<?= base_url('admin/profile/update-password') ?>" method="post" id="changePasswordForm">
                      <div class="mb-3">
                        <label for="password_lama" class="form-label">
                          <i class="bi bi-lock me-1"></i>Password Lama
                        </label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                          <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_lama')">
                            <i class="bi bi-eye" id="password_lama_icon"></i>
                          </button>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="password_baru" class="form-label">
                          <i class="bi bi-key me-1"></i>Password Baru
                        </label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                          <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru')">
                            <i class="bi bi-eye" id="password_baru_icon"></i>
                          </button>
                        </div>
                        <div class="form-text">
                          Password minimal 3 karakter
                        </div>
                      </div>

                      <div class="mb-3">
                        <label for="konfirmasi_password" class="form-label">
                          <i class="bi bi-check-circle me-1"></i>Konfirmasi Password Baru
                        </label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
                          <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('konfirmasi_password')">
                            <i class="bi bi-eye" id="konfirmasi_password_icon"></i>
                          </button>
                        </div>
                        <div class="invalid-feedback" id="password_match_error">
                          Password tidak cocok
                        </div>
                      </div>

                      <!-- Password Strength Indicator -->
                      <div class="mb-3">
                        <label class="form-label">Kekuatan Password:</label>
                        <div class="progress" style="height: 8px;">
                          <div class="progress-bar" id="password_strength_bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small class="text-muted" id="password_strength_text">Masukkan password baru</small>
                      </div>
                      
                      <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/profile') ?>" class="btn btn-secondary">
                          <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                          <i class="bi bi-check-circle"></i> Ubah Password
                        </button>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Security Tips -->
                <div class="card mt-3">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="bi bi-shield-check me-2"></i>Tips Keamanan
                    </h3>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol
                      </li>
                      <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Minimal 8 karakter untuk keamanan yang lebih baik
                      </li>
                      <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Hindari menggunakan informasi pribadi yang mudah ditebak
                      </li>
                      <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Ubah password secara berkala
                      </li>
                    </ul>
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
    // Toggle password visibility
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '_icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            passwordInput.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    // Password strength checker
    document.getElementById('password_baru').addEventListener('input', function() {
        const password = this.value;
        const strengthBar = document.getElementById('password_strength_bar');
        const strengthText = document.getElementById('password_strength_text');
        
        let strength = 0;
        let strengthLabel = '';
        
        if (password.length >= 3) strength += 25;
        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        
        strengthBar.style.width = strength + '%';
        
        if (strength < 25) {
            strengthBar.className = 'progress-bar bg-danger';
            strengthLabel = 'Sangat Lemah';
        } else if (strength < 50) {
            strengthBar.className = 'progress-bar bg-warning';
            strengthLabel = 'Lemah';
        } else if (strength < 75) {
            strengthBar.className = 'progress-bar bg-info';
            strengthLabel = 'Sedang';
        } else {
            strengthBar.className = 'progress-bar bg-success';
            strengthLabel = 'Kuat';
        }
        
        strengthText.textContent = strengthLabel;
    });

    // Password confirmation validation
    document.getElementById('konfirmasi_password').addEventListener('input', function() {
        const password = document.getElementById('password_baru').value;
        const confirm = this.value;
        
        if (password !== confirm) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });

    // Form validation
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password_baru').value;
        const confirm = document.getElementById('konfirmasi_password').value;
        
        if (password !== confirm) {
            e.preventDefault();
            document.getElementById('konfirmasi_password').classList.add('is-invalid');
            alert('Password baru dan konfirmasi password tidak cocok!');
        }
    });
    </script>
  </body>
  <!--end::Body-->
</html>