<?= $this->include('header') ?>

<!-- My Orders Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pesanan Saya</h6>
            <h1 class="mb-5">Riwayat Pengiriman</h1>
        </div>
        
        <div class="row">
            <div class="col-12">
                <?php if (empty($orders)): ?>
                    <div class="text-center bg-light rounded p-5">
                        <i class="fa fa-box-open fa-5x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3">Belum Ada Pesanan</h4>
                        <p class="text-muted mb-4">Anda belum memiliki riwayat pengiriman.</p>
                        <a href="<?= base_url('services') ?>" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Buat Pesanan Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($orders as $order): ?>
                            <div class="col-lg-6">
                                <div class="bg-light rounded p-4 wow fadeInUp" data-wow-delay="0.1s" style="height: 100%;">
                                    <!-- Header Order -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="mb-0 text-dark">Order #<?= $order['id_shipment'] ?></h5>
                                        <span class="badge bg-<?= 
                                            $order['status'] == 'pending' ? 'warning' : 
                                            ($order['status'] == 'process' ? 'info' : 
                                            ($order['status'] == 'transit' ? 'primary' :
                                            ($order['status'] == 'selesai' ? 'success' : 'danger'))) 
                                        ?> fs-6">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Order Info -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-<?= 
                                                    $order['tipe'] == 'udara' ? 'plane' : 
                                                    ($order['tipe'] == 'darat' ? 'truck' : 
                                                    ($order['tipe'] == 'laut' ? 'ship' : 'train')) 
                                                ?> text-primary me-2 fa-lg"></i>
                                                <strong class="text-dark"><?= ucfirst($order['tipe']) ?> Freight</strong>
                                            </div>
                                            <p class="mb-1 small">
                                                <i class="fa fa-calendar text-muted me-2"></i>
                                                <span class="text-dark"><?= date('d M Y', strtotime($order['tanggal_kirim'])) ?></span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-map-marker-alt text-muted me-2"></i>
                                                <span class="text-dark"><?= $order['asal'] ?> → <?= $order['tujuan'] ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 small">
                                                <i class="fa fa-user text-muted me-2"></i>
                                                <span class="text-dark"><?= $order['nama_penerima'] ?></span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-phone text-muted me-2"></i>
                                                <span class="text-dark"><?= $order['no_telp_penerima'] ?></span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-credit-card text-muted me-2"></i>
                                                <span class="text-dark"><?= ucfirst($order['metode_pembayaran']) ?></span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <hr class="my-3">
                                    
                                    <!-- Order Details -->
                                    <div class="row g-2 text-center mb-3">
                                        <div class="col-4">
                                            <div class="bg-white rounded p-2">
                                                <small class="text-muted d-block">Quantity</small>
                                                <strong class="text-dark"><?= $order['quantity'] ?> item</strong>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-white rounded p-2">
                                                <small class="text-muted d-block">Berat</small>
                                                <strong class="text-dark"><?= number_format($order['total_berat'], 1) ?> kg</strong>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="bg-white rounded p-2">
                                                <small class="text-muted d-block">Volume</small>
                                                <strong class="text-dark"><?= number_format($order['total_volume'], 1) ?> m³</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Footer with Price and Actions -->
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                        <div>
                                            <small class="text-muted d-block">Total Biaya</small>
                                            <h5 class="text-primary mb-0 fw-bold">Rp <?= number_format($order['total_bayar'], 0, ',', '.') ?></h5>
                                        </div>
                                        <div class="text-end">
                                            <?php if ($order['status'] == 'pending'): ?>
                                                <div class="d-flex flex-column align-items-end">
                                                    <a href="<?= base_url('shipment/payment/' . $order['id_shipment']) ?>" 
                                                       class="btn btn-warning btn-sm mb-2">
                                                        <i class="fa fa-credit-card me-1"></i>Bayar Sekarang
                                                    </a>
                                                    <small class="text-warning">
                                                        <i class="fa fa-clock me-1"></i>Menunggu Pembayaran
                                                    </small>
                                                </div>
                                            <?php elseif ($order['status'] == 'process'): ?>
                                                <div class="text-center">
                                                    <i class="fa fa-cog fa-spin text-info mb-1"></i>
                                                    <small class="text-info d-block">Sedang Diproses</small>
                                                </div>
                                            <?php elseif ($order['status'] == 'transit'): ?>
                                                <div class="text-center">
                                                    <i class="fa fa-shipping-fast text-primary mb-1"></i>
                                                    <small class="text-primary d-block">Dalam Perjalanan</small>
                                                </div>
                                            <?php elseif ($order['status'] == 'selesai'): ?>
                                                <div class="text-center">
                                                    <i class="fa fa-check-circle text-success fa-lg mb-1"></i>
                                                    <small class="text-success d-block fw-bold">Terkirim</small>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center">
                                                    <i class="fa fa-times-circle text-danger fa-lg mb-1"></i>
                                                    <small class="text-danger d-block">Dibatalkan</small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Add New Order Button -->
                    <div class="text-center mt-5">
                        <a href="<?= base_url('services') ?>" class="btn btn-primary btn-lg">
                            <i class="fa fa-plus me-2"></i>Buat Pesanan Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- My Orders End -->

<?= $this->include('footer') ?>