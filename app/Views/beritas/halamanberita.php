<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<div class="container">
    <h1><b><?= $title; ?></b></h1>

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
        <p>Tidak ada berita yang ditemukan.</p>
    <?php endif; ?>
</div>
