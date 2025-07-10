<?= $this->include('header') ?>
<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Our Services</h6>
            <h1 class="mb-5">Explore Our Services</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-1.jpg" alt="">
                    </div>
                    <h4 class="mb-3">Air Freight</h4>
                    <p>Pengiriman udara tercepat dengan estimasi 1-3 hari. Cocok untuk barang urgent dan bernilai tinggi.</p>
                    <a class="btn-slide mt-2" href="<?= base_url('shipment/order/udara') ?>"><i class="fa fa-arrow-right"></i><span>Pesan Sekarang</span></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-2.jpg" alt="">
                    </div>
                    <h4 class="mb-3">Ocean Freight</h4>
                    <p>Pengiriman laut paling ekonomis dengan kapasitas besar. Estimasi 7-21 hari untuk jarak jauh.</p>
                    <a class="btn-slide mt-2" href="<?= base_url('shipment/order/laut') ?>"><i class="fa fa-arrow-right"></i><span>Pesan Sekarang</span></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-3.jpg" alt="">
                    </div>
                    <h4 class="mb-3">Road Freight</h4>
                    <p>Pengiriman darat dengan jangkauan luas dan harga terjangkau. Estimasi 3-7 hari.</p>
                    <a class="btn-slide mt-2" href="<?= base_url('shipment/order/darat') ?>"><i class="fa fa-arrow-right"></i><span>Pesan Sekarang</span></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-4.jpg" alt="">
                    </div>
                    <h4 class="mb-3">Train Freight</h4>
                    <p>Pengiriman kereta api yang cepat dan stabil. Estimasi 2-5 hari, ramah lingkungan.</p>
                    <a class="btn-slide mt-2" href="<?= base_url('shipment/order/kereta') ?>"><i class="fa fa-arrow-right"></i><span>Pesan Sekarang</span></a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item p-4">
                    <div class="overflow-hidden mb-4">
                        <img class="img-fluid" src="img/service-6.jpg" alt="">
                    </div>
                    <h4 class="mb-3">Warehouse Solutions</h4>
                    <p>Solusi penyimpanan dengan berbagai paket sesuai kebutuhan. Fasilitas modern dan aman.</p>
                    <a class="btn-slide mt-2" href="<?= base_url('price') ?>"><i class="fa fa-arrow-right"></i><span>Lihat Paket</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Quick Order Section -->
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <?php if (session()->get('ses_Login')): ?>
                <!-- User sudah login -->
                <h6 class="text-secondary text-uppercase">Dashboard Cepat</h6>
                <h3 class="mb-4">Selamat datang kembali, <?= session()->get('ses_Username') ?>!</h3>
                
                <div class="row justify-content-center g-3">
                    <div class="col-lg-8">
                        <div class="bg-white rounded p-4 shadow-sm">
                            <div class="row g-3">
                                <!-- Pesanan Saya -->
                               
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="fa fa-list fa-lg"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Pesanan Saya</h6>
                                            <small class="text-muted">Lihat riwayat pengiriman</small>
                                        </div>
                                        <a href="<?= base_url('shipment/my-orders') ?>" class="btn btn-outline-primary btn-sm">
                                            Lihat <i class="fa fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- User belum login -->
                <h6 class="text-secondary text-uppercase">Mulai Pengiriman</h6>
                <h3 class="mb-4">Login untuk Akses Lengkap</h3>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="text-center">
            <h6 class="text-secondary text-uppercase">Testimonial</h6>
            <h1 class="mb-0">Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <div class="testimonial-item p-4 my-5">
                <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                <div class="d-flex align-items-end mb-4">
                    <img class="img-fluid flex-shrink-0" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <p class="m-0">Profession</p>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item p-4 my-5">
                <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                <div class="d-flex align-items-end mb-4">
                    <img class="img-fluid flex-shrink-0" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <p class="m-0">Profession</p>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item p-4 my-5">
                <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                <div class="d-flex align-items-end mb-4">
                    <img class="img-fluid flex-shrink-0" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <p class="m-0">Profession</p>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
            </div>
            <div class="testimonial-item p-4 my-5">
                <i class="fa fa-quote-right fa-3x text-light position-absolute top-0 end-0 mt-n3 me-4"></i>
                <div class="d-flex align-items-end mb-4">
                    <img class="img-fluid flex-shrink-0" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                    <div class="ms-4">
                        <h5 class="mb-1">Client Name</h5>
                        <p class="m-0">Profession</p>
                    </div>
                </div>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
<?= $this->include('footer') ?>
