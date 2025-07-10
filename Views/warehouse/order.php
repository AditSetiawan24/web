<?= $this->include('header') ?>

<!-- Order Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pemesanan Warehouse</h6>
            <h1 class="mb-5"><?= $title ?></h1>
        </div>
        
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="bg-light rounded p-5 wow fadeInUp" data-wow-delay="0.1s">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('warehouse/store') ?>" method="post" id="warehouseForm">
                        <input type="hidden" name="plan" value="<?= $plan ?>">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="warehouse" name="warehouse" required onchange="updateMaxVolume()">
                                        <option value="">Pilih Warehouse</option>
                                        <?php foreach ($warehouses as $warehouse): ?>
                                            <option value="<?= $warehouse['id_warehouse'] ?>" 
                                                    data-capacity="<?= $warehouse['kapasitas'] ?>"
                                                    <?= old('warehouse') == $warehouse['id_warehouse'] ? 'selected' : '' ?>>
                                                <?= $warehouse['lokasi'] ?> (Kapasitas: <?= number_format($warehouse['kapasitas'], 2) ?> m³)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="warehouse">Warehouse</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="debit/credit" <?= old('metode_pembayaran') == 'debit/credit' ? 'selected' : '' ?>>Debit/Credit Card</option>
                                        <option value="VA" <?= old('metode_pembayaran') == 'VA' ? 'selected' : '' ?>>Virtual Account</option>
                                        <option value="e-wallet" <?= old('metode_pembayaran') == 'e-wallet' ? 'selected' : '' ?>>E-Wallet</option>
                                    </select>
                                    <label for="metode_pembayaran">Metode Pembayaran</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" 
                                           value="<?= old('tanggal_mulai') ?>" required>
                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="durasi" name="durasi" required>
                                        <option value="">Pilih Durasi</option>
                                        <option value="1" <?= old('durasi') == '1' ? 'selected' : '' ?>>1 Bulan</option>
                                        <option value="3" <?= old('durasi') == '3' ? 'selected' : '' ?>>3 Bulan</option>
                                        <option value="6" <?= old('durasi') == '6' ? 'selected' : '' ?>>6 Bulan</option>
                                        <option value="12" <?= old('durasi') == '12' ? 'selected' : '' ?>>12 Bulan</option>
                                    </select>
                                    <label for="durasi">Durasi Sewa</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="volume_tersimpan" name="volume_tersimpan" 
                                           value="<?= old('volume_tersimpan') ?>" min="0.01" required>
                                    <label for="volume_tersimpan">Volume yang Akan Disimpan (m³)</label>
                                </div>
                                <small class="text-muted" id="capacityHint" style="display: none;">
                                    Maksimal volume: <span id="maxCapacity"></span> m³
                                </small>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">
                                    <i class="fa fa-paper-plane me-2"></i>Buat Pesanan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="bg-primary rounded p-5 wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="text-white mb-4">Informasi <?= ucfirst($plan) ?> Plan</h4>
                    
                    <?php 
                    $planInfo = [
                        'basic' => [
                            'price' => '$49',
                            'capacity' => '10 m² / 1 ton',
                            'features' => [
                                'Akses jam kerja',
                                'CCTV 24 jam',
                                'Tanpa sistem manajemen stok',
                                'Tidak termasuk asuransi'
                            ]
                        ],
                        'standard' => [
                            'price' => '$99',
                            'capacity' => '25 m² / 3 ton',
                            'features' => [
                                'Akses 24 jam',
                                'CCTV & petugas keamanan',
                                'Sistem manajemen stok',
                                'Notifikasi email'
                            ]
                        ],
                        'advanced' => [
                            'price' => '$149',
                            'capacity' => '50 m² / 5 ton',
                            'features' => [
                                'Akses 24 jam + kartu pribadi',
                                'CCTV, keamanan, asuransi',
                                'Sistem manajemen stok',
                                'Dashboard analytics'
                            ]
                        ]
                    ];
                    $currentPlan = $planInfo[$plan];
                    ?>
                    
                    <div class="text-white">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-warehouse fa-2x me-3"></i>
                            <h5 class="mb-0"><?= ucfirst($plan) ?> Plan</h5>
                        </div>
                        
                        <p><i class="fa fa-dollar-sign me-2"></i><strong>Harga:</strong> <?= $currentPlan['price'] ?>/bulan</p>
                        <p><i class="fa fa-cube me-2"></i><strong>Kapasitas:</strong> <?= $currentPlan['capacity'] ?></p>
                        
                        <h6 class="mt-4 mb-3">Fitur:</h6>
                        <ul class="list-unstyled">
                            <?php foreach ($currentPlan['features'] as $feature): ?>
                                <li><i class="fa fa-check me-2"></i><?= $feature ?></li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="mt-4 p-3 bg-white rounded">
                            <h6 class="mb-2 text-dark">Komponen Biaya:</h6>
                            <small class="text-dark">
                                • Tarif dasar: <?= $currentPlan['price'] ?>/bulan<br>
                                • Volume tambahan: $10/m³<br>
                                • Kurs: Rp 15.000/USD
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order End -->

<script>
function updateMaxVolume() {
    const warehouseSelect = document.getElementById('warehouse');
    const volumeInput = document.getElementById('volume_tersimpan');
    const capacityHint = document.getElementById('capacityHint');
    const maxCapacitySpan = document.getElementById('maxCapacity');
    
    if (warehouseSelect.value) {
        const selectedOption = warehouseSelect.options[warehouseSelect.selectedIndex];
        const maxCapacity = parseFloat(selectedOption.getAttribute('data-capacity'));
        
        // Set max attribute untuk input volume
        volumeInput.setAttribute('max', maxCapacity);
        
        // Tampilkan hint kapasitas maksimal
        maxCapacitySpan.textContent = maxCapacity.toFixed(2);
        capacityHint.style.display = 'block';
    } else {
        // Reset jika warehouse tidak dipilih
        volumeInput.removeAttribute('max');
        capacityHint.style.display = 'none';
    }
}

// Validasi saat form disubmit
document.getElementById('warehouseForm').addEventListener('submit', function(e) {
    const volumeInput = document.getElementById('volume_tersimpan');
    const maxCapacity = parseFloat(volumeInput.getAttribute('max'));
    const inputVolume = parseFloat(volumeInput.value);
    
    if (maxCapacity && inputVolume > maxCapacity) {
        e.preventDefault();
        alert('Volume yang diinput (' + inputVolume + ' m³) melebihi kapasitas warehouse maksimal (' + maxCapacity + ' m³)!');
        volumeInput.focus();
        return false;
    }
});
</script>

<?= $this->include('footer') ?>