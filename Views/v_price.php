<?=$this->include('header') ?>
    <!-- Pricing Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Pricing Plan</h6>
                <h1 class="mb-5">Perfect Pricing Plan</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item">
                        <div class="border-bottom p-4 mb-4">
                            <h5 class="text-primary mb-1">Basic Plan</h5>
                            <h1 class="display-5 mb-0">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>49.00<small
                                    class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                            </h1>
                        </div>
                        <div class="p-4 pt-0">
                            <p><i class="fa fa-check text-success me-3"></i>Kapasitas 10 m² / 1 ton</p>
                            <p><i class="fa fa-check text-success me-3"></i>Akses jam kerja</p>
                            <p><i class="fa fa-check text-success me-3"></i>CCTV 24 jam</p>
                            <p><i class="fa fa-check text-success me-3"></i>Tanpa sistem manajemen stok</p>
                            <p><i class="fa fa-check text-success me-3"></i>Tidak termasuk perlindungan asuransi</p>
                            <a class="btn-slide mt-2" href="<?= base_url('warehouse/order/basic') ?>">
                                <i class="fa fa-arrow-right"></i><span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="price-item">
                        <div class="border-bottom p-4 mb-4">
                            <h5 class="text-primary mb-1">Standard Plan</h5>
                            <h1 class="display-5 mb-0">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>99.00<small
                                    class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                            </h1>
                        </div>
                        <div class="p-4 pt-0">
                            <p><i class="fa fa-check text-success me-3"></i>Kapasitas 25 m² / 3 ton</p>
                            <p><i class="fa fa-check text-success me-3"></i>Akses 24 jam</p>
                            <p><i class="fa fa-check text-success me-3"></i>CCTV & petugas keamanan</p>
                            <p><i class="fa fa-check text-success me-3"></i>Sistem manajemen stok</p>
                            <p><i class="fa fa-check text-success me-3"></i>Notifikasi email saat barang masuk/keluar</p>
                            <a class="btn-slide mt-2" href="<?= base_url('warehouse/order/standard') ?>">
                                <i class="fa fa-arrow-right"></i><span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="price-item">
                        <div class="border-bottom p-4 mb-4">
                            <h5 class="text-primary mb-1">Advanced Plan</h5>
                            <h1 class="display-5 mb-0">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>149.00<small
                                    class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                            </h1>
                        </div>
                       <div class="p-4 pt-0">
                            <p><i class="fa fa-check text-success me-3"></i>Kapasitas 50 m² / 5 ton</p>
                            <p><i class="fa fa-check text-success me-3"></i>Akses 24 jam + kartu akses pribadi</p>
                            <p><i class="fa fa-check text-success me-3"></i>CCTV, petugas keamanan, asuransi barang</p>
                            <p><i class="fa fa-check text-success me-3"></i>Sistem manajemen stok</p>
                            <p><i class="fa fa-check text-success me-3"></i>Laporan real-time + dashboard analytics</p>
                            <a class="btn-slide mt-2" href="<?= base_url('warehouse/order/advanced') ?>">
                                <i class="fa fa-arrow-right"></i><span>Order Now</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing End -->
<?= $this->include('footer') ?>