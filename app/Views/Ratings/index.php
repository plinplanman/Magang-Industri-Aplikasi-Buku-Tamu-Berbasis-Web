<!-- template header dan layout lainnya disesuaikan -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Rating Kunjungan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <!-- Tambahkan di dalam <head> di template/header.php -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kunjungan dan Rating</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pengajuan ID</th>
                            <th>Rating Bintang</th>
                            <th>Catatan Masukan</th>
                            <th>Dokumentasi Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ratings)): ?>
                            <?php foreach ($ratings as $rating): ?>
                                <tr>
                                    <td><?= $rating['rating_id'] ?></td>
                                    <td><?= $rating['pengajuan_id'] ?></td>
                                    <td>
                                        <!-- Tampilan Bintang -->
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= $rating['rating_bintang'] ? 'text-warning' : 'text-secondary' ?>"></i>
                                        <?php endfor; ?>
                                        (<?= $rating['rating_bintang'] ?>/5)
                                    </td>
                                    <td><?= $rating['catatan_masukan'] ?: 'Tidak ada masukan' ?></td>
                                    <td>
                                        <?php if (!empty($rating['dokumentasi_foto'])): ?>
                                            <img src="<?= base_url('uploads/dokumentasi_foto/' . $rating['dokumentasi_foto']) ?>" alt="Dokumentasi" width="100">
                                        <?php else: ?>
                                            Tidak ada dokumentasi
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/ratings/edit/<?= $rating['rating_id'] ?>" class="btn btn-warning">Edit</a>
                                        <form action="/ratings/delete/<?= $rating['rating_id'] ?>" method="post" style="display:inline;">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data rating kunjungan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>