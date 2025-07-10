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
                        
                        <h1 class="mb-4 text-dark fw-bold display-5">Pembayaran Warehouse Berhasil!</h1>
                        
                        <p class="mb-4 text-muted fs-5 lh-lg">
                            Pembayaran telah berhasil diproses. 
                            Warehouse Anda siap digunakan sesuai periode yang telah dipilih.
                        </p>
                        
                        <div class="row g-3 justify-content-center mb-4">
                            <div class="col-md-6">
                                <a href="<?= base_url('warehouse/my-orders') ?>" class="btn btn-primary w-100 py-3 rounded-3 shadow-sm btn-hover-effect">
                                    <i class="fa fa-list me-2"></i>Lihat Pesanan Saya
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="<?= base_url('price') ?>" class="btn btn-outline-primary w-100 py-3 rounded-3 shadow-sm btn-hover-effect">
                                    <i class="fa fa-plus me-2"></i>Pesan Lagi
                                </a>
                            </div>
                        </div>
                        
                        <div class="warehouse-access-card p-4 bg-gradient-success rounded-4 border-0 shadow-sm">
                            <h5 class="text-success mb-4 fw-bold">
                                <i class="fa fa-warehouse me-2"></i>Akses Warehouse:
                            </h5>
                            <div class="row text-start g-3">
                                <div class="col-md-6">
                                    <div class="access-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="access-icon bg-success rounded-circle me-3">
                                                <i class="fa fa-check text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Pembayaran:</strong> 
                                                <span class="text-success fw-bold">Lunas</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="access-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="access-icon bg-info rounded-circle me-3">
                                                <i class="fa fa-warehouse text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Status:</strong> 
                                                <span class="text-info fw-bold">Aktif</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="access-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="access-icon bg-warning rounded-circle me-3">
                                                <i class="fa fa-key text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Akses:</strong> 
                                                <span class="text-warning fw-bold">Segera aktif</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="access-item p-3 bg-white rounded-3 mb-3 shadow-sm">
                                        <p class="mb-2 d-flex align-items-center">
                                            <span class="access-icon bg-primary rounded-circle me-3">
                                                <i class="fa fa-bell text-white"></i>
                                            </span>
                                            <span>
                                                <strong>Reminder:</strong> 
                                                <span class="text-primary fw-bold">Email notification</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Next Steps -->
                            <div class="next-steps-section mt-4 p-4 bg-gradient-info rounded-3">
                                <h6 class="text-info mb-3 fw-bold">
                                    <i class="fa fa-list-check me-2"></i>Langkah Selanjutnya:
                                </h6>
                                <div class="steps-timeline">
                                    <div class="step-item d-flex align-items-center mb-2">
                                        <span class="step-number bg-success text-white rounded-circle me-3">1</span>
                                        <span class="text-dark">Terima email konfirmasi akses warehouse</span>
                                    </div>
                                    <div class="step-item d-flex align-items-center mb-2">
                                        <span class="step-number bg-info text-white rounded-circle me-3">2</span>
                                        <span class="text-dark">Koordinasi dengan tim untuk penyimpanan barang</span>
                                    </div>
                                    <div class="step-item d-flex align-items-center">
                                        <span class="step-number bg-warning text-white rounded-circle me-3">3</span>
                                        <span class="text-dark">Mulai gunakan fasilitas warehouse Anda</span>
                                    </div>
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
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.btn-hover-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-hover-effect:hover::before {
    left: 100%;
}

/* Access Icons */
.access-icon {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

/* Gradient Backgrounds */
.bg-gradient-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(52, 144, 220, 0.1) 100%);
}

/* Warehouse Access Card */
.warehouse-access-card {
    transition: all 0.3s ease;
}

.warehouse-access-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
}

/* Access Items */
.access-item {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.access-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.1) !important;
    border-color: rgba(0,123,255,0.2);
}

/* Feature Badges */
.feature-badge {
    transition: all 0.3s ease;
    cursor: pointer;
}

.feature-badge:hover {
    transform: translateY(-3px);
    background-color: #f8f9fa !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.feature-badge i {
    font-size: 1.2rem;
}

/* Steps Timeline */
.step-number {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    min-width: 30px;
}

.step-item {
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 8px;
}

.step-item:hover {
    background-color: rgba(255,255,255,0.5);
    transform: translateX(5px);
}

/* Enhanced Shadows and Borders */
.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.12) !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-3 {
    border-radius: 0.5rem !important;
}

/* Text Enhancements */
.lh-lg {
    line-height: 1.8 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .feature-badge {
        margin-bottom: 10px;
    }
    
    .access-item {
        margin-bottom: 10px !important;
    }
    
    .step-item {
        flex-direction: column;
        text-align: center;
        margin-bottom: 15px !important;
    }
    
    .step-number {
        margin-bottom: 8px;
        margin-right: 0 !important;
    }
}

/* Loading Animation for Features */
.feature-badge {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

.feature-badge:nth-child(1) { animation-delay: 0.1s; }
.feature-badge:nth-child(2) { animation-delay: 0.2s; }
.feature-badge:nth-child(3) { animation-delay: 0.3s; }
.feature-badge:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- Payment Success End -->

<?= $this->include('footer') ?>