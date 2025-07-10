<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="<?=base_url('../admin_assets/assets/img/AdminLTELogo.png')?>"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">One Logistic Hub</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="<?= base_url('admin/home') ?>" class="nav-link active">
                  <i class="nav-icon bi bi-house-fill"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-collection-fill"></i>
                  <p>
                    Master Data
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('admin/user')?>" class="nav-link">
                      <i class="nav-icon bi bi-person-vcard"></i>
                      <p>Data User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/customer')?>" class="nav-link">
                      <i class="nav-icon bi bi-person"></i>
                      <p>Data Pelanggan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/warehouse')?>" class="nav-link">
                      <i class="nav-icon bi bi-door-open"></i>
                      <p>Data Warehouse</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/team')?>" class="nav-link">
                      <i class="nav-icon bi bi-people"></i>
                      <p>Data Team</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Transaksi
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url('admin/shipping') ?>" class="nav-link">
                      <i class="nav-icon bi bi-truck"></i>
                      <p>Shipping</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/warehouse-storage') ?>" class="nav-link">
                      <i class="nav-icon bi bi-box-seam"></i>
                      <p>Warehouse</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/profile') ?>" class="nav-link">
                  <i class="nav-icon bi bi-person-fill-gear"></i>
                  <p>
                    Pengaturan Akun
                  </p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>