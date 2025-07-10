<?= $this->include('header') ?>

<!-- Order Start -->
<div class="container-xxl py-5">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Pemesanan Pengiriman</h6>
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

                    <form action="<?= base_url('shipment/store') ?>" method="post">
                        <input type="hidden" name="tipe" value="<?= $tipe ?>">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="tanggal_kirim" name="tanggal_kirim" 
                                           value="<?= old('tanggal_kirim') ?>" required>
                                    <label for="tanggal_kirim">Tanggal Kirim</label>
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
                                    <input type="text" class="form-control" id="asal" name="asal" 
                                           value="<?= old('asal') ?>" required>
                                    <label for="asal">Kota Asal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tujuan" name="tujuan" 
                                           value="<?= old('tujuan') ?>" required>
                                    <label for="tujuan">Kota Tujuan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama_penerima" name="nama_penerima" 
                                           value="<?= old('nama_penerima') ?>" required>
                                    <label for="nama_penerima">Nama Penerima</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="no_telp_penerima" name="no_telp_penerima" 
                                           value="<?= old('no_telp_penerima') ?>" required>
                                    <label for="no_telp_penerima">No. Telp Penerima</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="quantity" name="quantity" 
                                           value="<?= old('quantity') ?>" min="1" required>
                                    <label for="quantity">Jumlah Barang</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="total_berat" name="total_berat" 
                                           value="<?= old('total_berat') ?>" min="0.01" required>
                                    <label for="total_berat">Total Berat (kg)</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="total_volume" name="total_volume" 
                                           value="<?= old('total_volume') ?>" min="0.01" required>
                                    <label for="total_volume">Total Volume (m³)</label>
                                </div>
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
                    <h4 class="text-white mb-4">Informasi <?= ucfirst($tipe) ?> Freight</h4>
                    
                    <?php 
                    $info = [
                        'udara' => [
                            'icon' => 'fa-plane',
                            'waktu' => '1-3 hari',
                            'biaya' => 'Rp 15.000 + biaya berat/volume',
                            'kelebihan' => ['Sangat cepat', 'Aman untuk barang bernilai tinggi', 'Tracking real-time']
                        ],
                        'darat' => [
                            'icon' => 'fa-truck',
                            'waktu' => '3-7 hari',
                            'biaya' => 'Rp 8.000 + biaya berat/volume',
                            'kelebihan' => ['Ekonomis', 'Cocok untuk barang berat', 'Jangkauan luas']
                        ],
                        'laut' => [
                            'icon' => 'fa-ship',
                            'waktu' => '7-21 hari',
                            'biaya' => 'Rp 5.000 + biaya berat/volume',
                            'kelebihan' => ['Paling ekonomis', 'Kapasitas besar', 'Ramah lingkungan']
                        ],
                        'kereta' => [
                            'icon' => 'fa-train',
                            'waktu' => '2-5 hari',
                            'biaya' => 'Rp 10.000 + biaya berat/volume',
                            'kelebihan' => ['Cepat dan stabil', 'Tidak terpengaruh cuaca', 'Eco-friendly']
                        ]
                    ];
                    $currentInfo = $info[$tipe];
                    ?>
                    
                    <div class="text-white">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa <?= $currentInfo['icon'] ?> fa-2x me-3"></i>
                            <h5 class="mb-0"><?= ucfirst($tipe) ?> Freight</h5>
                        </div>
                        
                        <p><i class="fa fa-clock me-2"></i><strong>Estimasi:</strong> <?= $currentInfo['waktu'] ?></p>
                        <p><i class="fa fa-money-bill me-2"></i><strong>Tarif:</strong> <?= $currentInfo['biaya'] ?></p>
                        
                        <h6 class="mt-4 mb-3">Kelebihan:</h6>
                        <ul class="list-unstyled">
                            <?php foreach ($currentInfo['kelebihan'] as $item): ?>
                                <li><i class="fa fa-check me-2"></i><?= $item ?></li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <div class="mt-4 p-3 bg-light bg-opacity-10 rounded">
                            <h6 class="mb-2">Komponen Biaya:</h6>
                            <small class="text-dark">
                                • Tarif dasar: <?= explode(' +', $currentInfo['biaya'])[0] ?><br>
                                • Berat: Rp 2.000/kg<br>
                                • Volume: Rp 1.000/m³<br>
                                • Per item: Rp 5.000
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order End -->

<?= $this->include('footer') ?>