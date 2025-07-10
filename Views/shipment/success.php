<?= $this->include('header') ?>

<!-- Success Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-light rounded p-5">
                        <i class="fa fa-check-circle fa-5x text-success mb-4"></i>
                        <h1 class="mb-4">Pesanan Berhasil Dibuat!</h1>
                        
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <p class="mb-4">Terima kasih atas kepercayaan Anda. Pesanan pengiriman Anda telah berhasil dibuat dan sedang diproses oleh tim kami.</p>
                        
                        <div class="row g-3 justify-content-center">
                            <div class="col-md-6">
                                <a href="<?= base_url('shipment/my-orders') ?>" class="btn btn-primary w-100 py-3">
                                    <i class="fa fa-list me-2"></i>Lihat Pesanan Saya
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url('services') ?>" class="btn btn-outline-primary w-100 py-3">
                                    <i class="fa fa-plus me-2"></i>Pesan Lagi
                                </a>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 bg-info bg-opacity-10 rounded">
                            <h5 class="text-info mb-3">Langkah Selanjutnya:</h5>
                            <div class="row text-start">
                                <div class="col-md-6">
                                    <p class="mb-2"><i class="fa fa-clock text-info me-2"></i><strong>1-2 jam:</strong> Konfirmasi pesanan</p>
                                    <p class="mb-2"><i class="fa fa-credit-card text-info me-2"></i><strong>24 jam:</strong> Proses pembayaran</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><i class="fa fa-truck text-info me-2"></i><strong>Setelah bayar:</strong> Pickup barang</p>
                                    <p class="mb-2"><i class="fa fa-bell text-info me-2"></i><strong>Real-time:</strong> Update status</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Success End -->

<?= $this->include('footer') ?>