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
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/team') ?>">Team</a></li>
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
                      <a href="<?= base_url('admin/team') ?>" class="btn btn-secondary btn-sm">
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
                    
 <form action="<?= base_url('admin/team/update/'.$team['id_member']) ?>" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" 
                                   value="<?= old('nama', $team['nama']) ?>" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control" id="posisi" name="posisi" 
                                   value="<?= old('posisi', $team['posisi']) ?>" required>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo" 
                                   accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                            
                            <div class="mt-2">
                              <?php if (!empty($team['photo_url'])): ?>
                                <div class="mb-2">
                                  <label class="form-label">Foto Saat Ini:</label><br>
                                  <img src="<?= base_url('admin/team/photo/' . $team['photo_url']) ?>" 
                                       alt="Current Photo" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                              <?php endif; ?>
                              
                              <img id="preview" src="#" alt="Preview" class="img-thumbnail" 
                                   style="max-width: 200px; display: none;">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label for="fb" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control" id="fb" name="fb" 
                                   value="<?= old('fb', $team['fb']) ?>" placeholder="https://facebook.com/username">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label for="x" class="form-label">Twitter/X URL</label>
                            <input type="url" class="form-control" id="x" name="x" 
                                   value="<?= old('x', $team['x']) ?>" placeholder="https://x.com/username">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label for="ig" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control" id="ig" name="ig" 
                                   value="<?= old('ig', $team['ig']) ?>" placeholder="https://instagram.com/username">
                          </div>
                        </div>
                      </div>
                      
                      <div class="d-flex justify-content-end">
                        <a href="<?= base_url('admin/team') ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                    <script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}
</script>
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