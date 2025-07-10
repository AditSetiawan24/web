<?= $this->include('header') ?>

<!-- Payment Success Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-white rounded-4 p-5 shadow-lg border-0">
                        <!-- Success Icon with Animation -->
                        <div class="success-icon-wrapper mb-4 position-relative">
                            <div class="success-bg-circle"></div>
                            <i class="fa fa-check-circle fa-5x text-success position-relative" style="z-index: 2;"></i>
                        </div>
                        
                        <h1 class="mb-4 text-dark fw-bold display-5">Pembayaran Berhasil!</h1>
                        
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success border-0 rounded-3 shadow-sm">
                                <i class="fa fa-info-circle me-2"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="order-info-card mb-4 p-4 bg-light rounded-3 border-start border-5 border-success">
                            <p class="mb-0 text-muted fs-5">
                                Pembayaran telah berhasil diproses. 
                                Status pesanan Anda telah diubah menjadi <span class="badge bg-info text-white px-3 py-2">Process</span> 
                                dan akan segera diproses oleh tim kami.
                            </p>
                        </div>
                        
                        <div class="row g-3 justify-content-center mb-4">
                            <div class="col-md-6">
                                <a href="<?= base_url('shipment/my-orders') ?>" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm btn-hover-effect">
                                    <i class="fa fa-list me-2"></i>Lihat Pesanan Saya
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url('services') ?>" class="btn btn-outline-primary w-100 py-3 rounded-3 shadow-sm btn-hover-effect">
                                    <i class="fa fa-plus me-2"></i>Pesan Lagi
                                </a>
                            </div>
                        </div>
                        
                        <div class="status-card p-4 bg-gradient-success rounded-4 shadow-sm border-0">
                            <h5 class="text-success mb-4 fw-bold">
                                <i class="fa fa-clipboard-check me-2"></i>Status Pesanan Terupdate:
                            </h5>
                            <div class="row text-start g-3">
                                <div class="col-md-6">
                                    <div class="status-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="status-icon bg-success rounded-circle me-3">
                                                <i class="fa fa-check text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Pembayaran:</strong> 
                                                <span class="text-success fw-bold">Lunas</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="status-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="status-icon bg-info rounded-circle me-3">
                                                <i class="fa fa-cog text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Status:</strong> 
                                                <span class="text-info fw-bold">Process</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="status-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="status-icon bg-warning rounded-circle me-3">
                                                <i class="fa fa-truck text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Selanjutnya:</strong> 
                                                <span class="text-warning fw-bold">Pickup barang</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="status-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="status-icon bg-primary rounded-circle me-3">
                                                <i class="fa fa-bell text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Notifikasi:</strong> 
                                                <span class="text-primary fw-bold">Update real-time</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress Timeline -->
                        <div class="timeline-wrapper mt-4 p-4 bg-light rounded-3">
                            <h6 class="text-muted mb-3">Timeline Proses:</h6>
                            <div class="timeline d-flex justify-content-between align-items-center">
                                <div class="timeline-step completed">
                                    <div class="step-circle bg-success">
                                        <i class="fa fa-check text-white"></i>
                                    </div>
                                    <span class="step-text">Order</span>
                                </div>
                                <div class="timeline-line completed"></div>
                                <div class="timeline-step completed">
                                    <div class="step-circle bg-success">
                                        <i class="fa fa-credit-card text-white"></i>
                                    </div>
                                    <span class="step-text">Payment</span>
                                </div>
                                <div class="timeline-line active"></div>
                                <div class="timeline-step active">
                                    <div class="step-circle bg-info">
                                        <i class="fa fa-cog text-white"></i>
                                    </div>
                                    <span class="step-text">Process</span>
                                </div>
                                <div class="timeline-line"></div>
                                <div class="timeline-step">
                                    <div class="step-circle bg-secondary">
                                        <i class="fa fa-truck text-white"></i>
                                    </div>
                                    <span class="step-text">Shipping</span>
                                </div>
                                <div class="timeline-line"></div>
                                <div class="timeline-step">
                                    <div class="step-circle bg-secondary">
                                        <i class="fa fa-flag text-white"></i>
                                    </div>
                                    <span class="step-text">Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Enhanced Styling -->
<style>
/* Success Icon Animation */
.success-icon-wrapper {
    display: inline-block;
}

.success-bg-circle {
    position: absolute;
    width: 120px;
    height: 120px;
    background: linear-gradient(45deg, #28a745, #20c997);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.1;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: translate(-50%, -50%) scale(1); opacity: 0.1; }
    50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.2; }
    100% { transform: translate(-50%, -50%) scale(1); opacity: 0.1; }
}

/* Button Hover Effects */
.btn-hover-effect {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-hover-effect:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

/* Status Icons */
.status-icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

/* Gradient Background */
.bg-gradient-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
}

/* Timeline Styles */
.timeline {
    position: relative;
}

.timeline-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
}

.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.step-text {
    font-size: 12px;
    font-weight: 600;
    color: #6c757d;
}

.timeline-line {
    height: 3px;
    flex: 1;
    background-color: #e9ecef;
    margin: 0 10px;
    margin-top: 20px;
    border-radius: 2px;
}

.timeline-line.completed {
    background: linear-gradient(90deg, #28a745, #20c997);
}

.timeline-line.active {
    background: linear-gradient(90deg, #20c997, #17a2b8);
    animation: progressFlow 2s ease-in-out infinite alternate;
}

@keyframes progressFlow {
    0% { opacity: 0.7; }
    100% { opacity: 1; }
}

.timeline-step.completed .step-text {
    color: #28a745;
    font-weight: 700;
}

.timeline-step.active .step-text {
    color: #17a2b8;
    font-weight: 700;
}

/* Status Item Hover */
.status-item {
    transition: all 0.3s ease;
}

.status-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

/* Order Info Card */
.order-info-card {
    transition: all 0.3s ease;
}

.order-info-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Enhanced Shadows */
.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .timeline {
        flex-direction: column;
        gap: 15px;
    }
    
    .timeline-line {
        display: none;
    }
    
    .status-card .row {
        gap: 0;
    }
}
</style>

<!-- Payment Success End -->

<?= $this->include('footer') ?>