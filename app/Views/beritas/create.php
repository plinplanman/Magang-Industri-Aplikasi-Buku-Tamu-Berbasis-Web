<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Berita</li>
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
                <h3 class="card-title">Form Tambah Berita</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="/beritas/store" method="post">
                    <div class="form-group">
                        <label for="rating_id">Tamu : Nama/Tanggal/Jam/Tujuan</label>
                        <select name="rating_id" class="form-control" required>
                            <?php foreach ($ratings as $rating): ?>
                                <option value="<?= $rating['rating_id'] ?>">
                                    <?= $rating['nama'] ?> / <?= date('d-m-Y', strtotime($rating['tanggal'])) ?> / <?= $rating['jam'] ?> / <?= $rating['nama_divisi'] ?>
                                </option> <!-- Tampilkan nama, tanggal, jam, dan nama divisi -->
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" name="judul_berita" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_berita">Isi Berita</label>
                        <textarea name="isi_berita" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="/beritas" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->