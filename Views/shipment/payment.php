<?= $this->include('header') ?>

<!-- Payment Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pembayaran</h6>
            <h1 class="mb-5">Selesaikan Pembayaran</h1>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <div class="bg-light rounded p-5">
                    <div class="row">
                        <!-- Order Details -->
                        <div class="col-md-6">
                            <h4 class="mb-4">Detail Pesanan</h4>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Order #<?= $order['id_shipment'] ?></h5>
                                    <p class="card-text">
                                        <i class="fa fa-<?= 
                                            $order['tipe'] == 'udara' ? 'plane' : 
                                            ($order['tipe'] == 'darat' ? 'truck' : 
                                            ($order['tipe'] == 'laut' ? 'ship' : 'train')) 
                                        ?> text-primary me-2"></i>
                                        <strong><?= ucfirst($order['tipe']) ?> Freight</strong>
                                    </p>
                                    <hr>
                                    <p><strong>Asal:</strong> <?= $order['asal'] ?></p>
                                    <p><strong>Tujuan:</strong> <?= $order['tujuan'] ?></p>
                                    <p><strong>Tanggal Kirim:</strong> <?= date('d M Y', strtotime($order['tanggal_kirim'])) ?></p>
                                    <p><strong>Penerima:</strong> <?= $order['nama_penerima'] ?></p>
                                    <p><strong>No. Telp:</strong> <?= $order['no_telp_penerima'] ?></p>
                                    <hr>
                                    <p><strong>Quantity:</strong> <?= $order['quantity'] ?> item</p>
                                    <p><strong>Berat:</strong> <?= number_format($order['total_berat'], 1) ?> kg</p>
                                    <p><strong>Volume:</strong> <?= number_format($order['total_volume'], 1) ?> m³</p>
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
                                        <span class="badge bg-<?= $order['payment_status'] == 'paid' ? 'success' : 'warning' ?>">
                                            <?= ucfirst($order['payment_status']) ?>
                                        </span>
                                    </div>
                                    
                                    <p><strong>Metode Pembayaran:</strong> <?= ucfirst($order['metode_pembayaran']) ?></p>
                                    
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total Biaya:</strong>
                                        <h4 class="text-primary">Rp <?= number_format($order['total_bayar'], 0, ',', '.') ?></h4>
                                    </div>
                                    
                                    <?php if ($order['payment_status'] == 'pending'): ?>
                                        <hr>
                                        <div class="payment-methods">
                                            <h6 class="mb-3">Pilih Metode Pembayaran:</h6>
                                            
                                            <?php if ($order['metode_pembayaran'] == 'debit/credit'): ?>
                                                <div class="mb-3 p-3 border rounded">
                                                    <h6><i class="fa fa-credit-card text-primary me-2"></i>Kartu Debit/Credit</h6>
                                                    <p class="text-muted small mb-2">Pembayaran dengan kartu debit atau credit card</p>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="simulatePayment()">
                                                        <i class="fa fa-credit-card me-1"></i>Bayar Sekarang
                                                    </button>
                                                </div>
                                            <?php elseif ($order['metode_pembayaran'] == 'VA'): ?>
                                                <div class="mb-3 p-3 border rounded">
                                                    <h6><i class="fa fa-university text-info me-2"></i>Virtual Account</h6>
                                                    <p class="text-muted small mb-2">Transfer ke nomor virtual account:</p>
                                                    <div class="bg-light p-2 rounded mb-2">
                                                        <strong>VA Number: 1234567890<?= $order['id_shipment'] ?></strong>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm ms-2" onclick="copyVA()">
                                                            <i class="fa fa-copy"></i>
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-info btn-sm" onclick="simulatePayment()">
                                                        <i class="fa fa-check me-1"></i>Sudah Transfer
                                                    </button>
                                                </div>
                                            <?php else: ?>
                                                <div class="mb-3 p-3 border rounded">
                                                    <h6><i class="fa fa-mobile-alt text-success me-2"></i>E-Wallet</h6>
                                                    <p class="text-muted small mb-2">Pembayaran dengan e-wallet (OVO, GoPay, DANA)</p>
                                                    <button type="button" class="btn btn-success btn-sm" onclick="simulatePayment()">
                                                        <i class="fa fa-mobile-alt me-1"></i>Bayar dengan E-Wallet
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-success mt-3">
                                            <i class="fa fa-check-circle me-2"></i>Pembayaran sudah berhasil!
                                        </div>
                                        <a href="<?= base_url('shipment/my-orders') ?>" class="btn btn-primary w-100">
                                            <i class="fa fa-list me-2"></i>Lihat Pesanan Saya
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="<?= base_url('shipment/my-orders') ?>" class="btn btn-outline-secondary me-2">
                                <i class="fa fa-arrow-left me-1"></i>Kembali ke Pesanan
                            </a>
                            <?php if ($order['payment_status'] == 'pending'): ?>
                                <small class="text-muted d-block mt-3">
                                    <i class="fa fa-info-circle me-1"></i>
                                    Pembayaran akan otomatis mengubah status pesanan menjadi "Process"
                                </small>
                            <?php endif; ?>
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
        // Redirect to process payment
        window.location.href = '<?= base_url('shipment/process-payment/' . $order['id_shipment']) ?>';
    }
}

function copyVA() {
    const vaNumber = '1234567890<?= $order['id_shipment'] ?>';
    navigator.clipboard.writeText(vaNumber).then(function() {
        alert('Nomor VA berhasil disalin!');
    });
}
</script>

<?= $this->include('footer') ?>