<?= $this->include('header') ?>

<!-- Payment Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pembayaran</h6>
            <h1 class="mb-5">Selesaikan Pembayaran Warehouse</h1>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light rounded p-5">
                    <div class="row">
                        <!-- Storage Details -->
                        <div class="col-md-6">
                            <h4 class="mb-4">Detail Pesanan</h4>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Storage #<?= $storage['id_warehouse_storage'] ?></h5>
                                    <p class="card-text">
                                        <i class="fa fa-warehouse text-primary me-2"></i>
                                        <strong><?= ucfirst($storage['tipe']) ?> Plan</strong>
                                    </p>
                                    <hr>
                                    <p><strong>Warehouse:</strong> <?= $storage['lokasi'] ?></p>
                                    <p><strong>Tanggal Mulai:</strong> <?= date('d M Y', strtotime($storage['tanggal_mulai'])) ?></p>
                                    <p><strong>Tanggal Berakhir:</strong> <?= date('d M Y', strtotime($storage['tanggal_berakhir'])) ?></p>
                                    <hr>
                                    <p><strong>Volume Tersimpan:</strong> <?= number_format($storage['volume_tersimpan'], 2) ?> m³</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Details -->
                        <div class="col-md-6">
                            <h4 class="mb-4">Detail Pembayaran</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span>Status Pembayaran:</span>
                                        <span class="badge bg-<?= $storage['payment_status'] == 'paid' ? 'success' : 'warning' ?>">
                                            <?= ucfirst($storage['payment_status']) ?>
                                        </span>
                                    </div>
                                    
                                    <p><strong>Metode Pembayaran:</strong> <?= ucfirst($storage['metode_pembayaran']) ?></p>
                                    
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total Biaya:</strong>
                                        <h4 class="text-primary">Rp <?= number_format($storage['total_bayar'], 0, ',', '.') ?></h4>
                                    </div>
                                    
                                    <?php if ($storage['payment_status'] == 'pending'): ?>
                                        <hr>
                                        <div class="payment-methods">
                                            <h6 class="mb-3">Pilih Metode Pembayaran:</h6>
                                            
                                            <div class="mb-3 p-3 border rounded">
                                                <h6><i class="fa fa-credit-card text-primary me-2"></i><?= ucfirst($storage['metode_pembayaran']) ?></h6>
                                                <p class="text-muted small mb-2">Pembayaran untuk <?= ucfirst($storage['tipe']) ?> Plan</p>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="simulatePayment()">
                                                    <i class="fa fa-credit-card me-1"></i>Bayar Sekarang
                                                </button>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-success mt-3">
                                            <i class="fa fa-check-circle me-2"></i>Pembayaran sudah berhasil!
                                        </div>
                                        <a href="<?= base_url('warehouse/my-orders') ?>" class="btn btn-primary w-100">
                                            <i class="fa fa-list me-2"></i>Lihat Pesanan Saya
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('warehouse/my-orders') ?>" class="btn btn-outline-secondary me-2">
                                <i class="fa fa-arrow-left me-1"></i>Kembali ke Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Payment End -->

<script>
function simulatePayment() {
    if (confirm('Lanjutkan pembayaran? (Simulasi)')) {
        window.location.href = '<?= base_url('warehouse/process-payment/' . $storage['id_warehouse_storage']) ?>';
    }
}
</script>

<?= $this->include('footer') ?>