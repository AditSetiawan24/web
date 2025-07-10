<?= $this->include('header') ?>

<!-- My Orders Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pesanan Warehouse Saya</h6>
            <h1 class="mb-5">Riwayat Penyewaan Warehouse</h1>
        </div>
        
        <div class="row">
            <div class="col-12">
                <?php if (empty($orders)): ?>
                    <div class="text-center bg-light rounded p-5">
                        <i class="fa fa-warehouse fa-5x text-muted mb-4"></i>
                        <h4 class="text-muted mb-3">Belum Ada Pesanan Warehouse</h4>
                        <p class="text-muted mb-4">Anda belum memiliki riwayat penyewaan warehouse.</p>
                        <a href="<?= base_url('price') ?>" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Pesan Warehouse Pertama
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($orders as $order): ?>
                            <div class="col-lg-6">
                                <div class="bg-light rounded p-4 wow fadeInUp" data-wow-delay="0.1s" style="height: 100%;">
                                    <!-- Header Order -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="mb-0 text-dark">Storage #<?= $order['id_warehouse_storage'] ?></h5>
                                        <span class="badge bg-<?= $order['payment_status'] == 'paid' ? 'success' : 'warning' ?> fs-6">
                                            <?= ucfirst($order['payment_status']) ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Order Info -->
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-warehouse text-primary me-2 fa-lg"></i>
                                                <strong class="text-dark"><?= ucfirst($order['tipe']) ?> Plan</strong>
                                            </div>
                                            <p class="mb-1 small">
                                                <i class="fa fa-map-marker-alt text-muted me-2"></i>
                                                <span class="text-dark"><?= $order['lokasi'] ?></span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-calendar text-muted me-2"></i>
                                                <span class="text-dark"><?= date('d M Y', strtotime($order['tanggal_mulai'])) ?> - <?= date('d M Y', strtotime($order['tanggal_berakhir'])) ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 small">
                                                <i class="fa fa-cube text-muted me-2"></i>
                                                <span class="text-dark"><?= number_format($order['volume_tersimpan'], 2) ?> m³</span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-credit-card text-muted me-2"></i>
                                                <span class="text-dark"><?= ucfirst($order['metode_pembayaran']) ?></span>
                                            </p>
                                            <p class="mb-1 small">
                                                <i class="fa fa-clock text-muted me-2"></i>
                                                <span class="text-dark">
                                                    <?php 
                                                    $today = new DateTime();
                                                    $endDate = new DateTime($order['tanggal_berakhir']);
                                                    $diff = $today->diff($endDate);
                                                    
                                                    if ($endDate < $today) {
                                                        echo '<span class="text-danger">Expired</span>';
                                                    } else {
                                                        echo $diff->days . ' hari lagi';
                                                    }
                                                    ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <hr class="my-3">
                                    
                                    <!-- Order Details -->
                                    <div class="row g-2 text-center mb-3">
                                        <div class="col-6">
                                            <div class="bg-white rounded p-2">
                                                <small class="text-muted d-block">Mulai</small>
                                                <strong class="text-dark"><?= date('d/m/Y', strtotime($order['tanggal_mulai'])) ?></strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-white rounded p-2">
                                                <small class="text-muted d-block">Berakhir</small>
                                                <strong class="text-dark"><?= date('d/m/Y', strtotime($order['tanggal_berakhir'])) ?></strong>
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
                                            <?php if ($order['payment_status'] == 'pending'): ?>
                                                <div class="d-flex flex-column align-items-end">
                                                    <a href="<?= base_url('warehouse/payment/' . $order['id_warehouse_storage']) ?>" 
                                                       class="btn btn-warning btn-sm mb-2">
                                                        <i class="fa fa-credit-card me-1"></i>Bayar Sekarang
                                                    </a>
                                                    <small class="text-warning">
                                                        <i class="fa fa-clock me-1"></i>Menunggu Pembayaran
                                                    </small>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center">
                                                    <i class="fa fa-check-circle text-success fa-lg mb-1"></i>
                                                    <small class="text-success d-block fw-bold">Aktif</small>
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
                        <a href="<?= base_url('price') ?>" class="btn btn-primary btn-lg">
                            <i class="fa fa-plus me-2"></i>Pesan Warehouse Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- My Orders End -->

<?= $this->include('footer') ?>