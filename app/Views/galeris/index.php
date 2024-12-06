<!-- template header dan layout lainnya disesuaikan -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Galeri Kunjungan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <!-- Tambahkan di dalam <head> di template/header.php -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <div class="container">
            <div class="row">
                <?php if (!empty($ratings)): ?>
                    <?php foreach ($ratings as $rating): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <!-- Foto Dokumentasi -->
                                <?php if (!empty($rating['dokumentasi_foto'])): ?>
                                    <img src="<?= base_url('uploads/dokumentasi_foto/' . $rating['dokumentasi_foto']) ?>" class="card-img-top" alt="Dokumentasi" style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="<?= base_url('uploads/dokumentasi_foto/default.jpg') ?>" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                                <?php endif; ?>

                                <div class="card-body">
                                    <!-- Rating Bintang -->
                                    <h5 class="card-title">Rating Kunjungan</h5>
                                    <p>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $rating['rating_bintang'] ? 'text-warning' : 'text-secondary' ?>"></i>
                                        <?php endfor; ?>
                                        (<?= $rating['rating_bintang'] ?>/5)
                                    </p>

                                    <!-- Nama, Tanggal, Jam, Keterangan -->
                                    <p><strong>Nama     :  </strong> <?= esc($rating['nama']) ?></p>
                                    <p><strong>Waktu Kunjungan      :  </strong><?= esc($rating['jam']) ?></p>
                                    <p><strong>Tanggal Kunjungan        :  </strong> <?= esc($rating['tanggal']) ?> </p>
                                    <p><strong>Keterangan       :  </strong> <?= esc($rating['keterangan']) ?></p>
                                    <p><strong>Perusahaan       :  </strong> <?= esc($rating['nama_perusahaan']) ?></p>

                                    <!-- Nama Divisi -->
                                    <p><strong>Divisi Tujuan        :  </strong> <?= esc($rating['nama_divisi']) ?></p>

                                    <!-- Catatan Masukan -->
                                    <p class="card-text">
                                        <strong>Catatan     :  </strong> <?= esc($rating['catatan_masukan']) ?: 'Tidak ada masukan' ?>
                                    </p>

                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Tidak ada data Galeri kunjungan</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
