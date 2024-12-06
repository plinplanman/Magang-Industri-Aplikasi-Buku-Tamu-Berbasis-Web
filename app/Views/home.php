<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Selamat Datang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Halaman Utama</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Portal Buku Tamu</h3>

                
            </div>
            <div class="card-body">
                <h1>Selamat Datang di Portal Buku Tamu Desnet</h1>
                <p>Silakan pilih menu untuk mengakses fitur-fitur di portal ini:</p>

                <!-- Navigation Links -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?= base_url('pengajuans/create') ?>" class="nav-link">
                            <i class="fas fa-user-plus"></i> Form Pendaftaran Kunjungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('jadwals/cari') ?>" class="nav-link">
                            <i class="fas fa-info-circle"></i> Detail Data Kunjungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('galeris') ?>" class="nav-link">
                            <i class="fas fa-image"></i> Konten Galeri Kunjungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('beritas/halamanberita') ?>" class="nav-link">
                            <i class="fas fa-newspaper"></i> Konten Berita dan Informasi
                        </a>
                    </li>
                </ul>

                <!-- Menampilkan 3 berita terbaru -->
                <div class="container mt-4">
                    <h2><b>Berita Terbaru</b></h2>

                    <?php if (!empty($beritas) && is_array($beritas)): ?>
                        <div class="list-group">
                            <?php foreach ($beritas as $berita): ?>
                                <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#modalBerita<?= $berita['berita_id']; ?>">

                                    <!-- Cek apakah ada dokumentasi_foto untuk berita ini -->
                                    <?php if (!empty($berita['dokumentasi_foto'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url('uploads/dokumentasi_foto/' . $berita['dokumentasi_foto']); ?>" alt="Dokumentasi Foto" style="max-width: 150px;">
                                        </div>
                                    <?php endif; ?>



                                    <h4 class="mb-1"><b><?= $berita['judul_berita']; ?></b></h4>
                                    <p class="mb-1"><?= substr($berita['isi_berita'], 0, 150); ?>...</p>
                                    <small><?= date('d-m-Y', strtotime($berita['created_at'])); ?></small>
                                </a>

                                <!-- Modal untuk setiap berita -->
                                <div class="modal fade" id="modalBerita<?= $berita['berita_id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $berita['berita_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel<?= $berita['berita_id']; ?>"><?= $berita['judul_berita']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tampilkan dokumentasi foto jika ada -->
                                                <?php if (!empty($berita['dokumentasi_foto'])): ?>
                                                    <div class="mt-2">
                                                        <img src="<?= base_url('uploads/dokumentasi_foto/' . $berita['dokumentasi_foto']); ?>" alt="Dokumentasi Foto" style="max-width: 100%;">
                                                    </div>
                                                <?php endif; ?>
                                                <p><?= $berita['isi_berita']; ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Tidak ada berita terbaru.</p>
                    <?php endif; ?>
                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->