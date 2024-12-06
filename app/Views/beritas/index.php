<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Berita</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a href="/beritas/create" class="btn btn-primary">Tambah Berita</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul Berita</th>
                            <th>Tamu</th>
                            <th>dibuat</th>
                            <th>diperbarui</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($beritas as $berita): ?>
                            <tr>
                                <td><?= $berita['berita_id'] ?></td>
                                <td><?= $berita['judul_berita'] ?></td>
                                <td>
                                    <?php foreach ($ratings as $rating): ?>
                                        <?php if ($rating['rating_id'] == $berita['rating_id']): ?>
                                            <?= $rating['nama'] ?> / <?= date('d-m-Y', strtotime($rating['tanggal'])) ?> / <?= $rating['jam'] ?> / <?= $rating['nama_divisi'] ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $berita['created_at'] ?></td>
                                <td><?= $berita['updated_at'] ?></td>
                                <td>
                                    <a href="/beritas/edit/<?= $berita['berita_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/beritas/delete/<?= $berita['berita_id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->