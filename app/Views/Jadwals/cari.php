<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cari Jadwal Kunjungan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pencarian Pengajuan Berdasarkan ID</h3>
            </div>
            <div class="card-body">
                <!-- Form pencarian pengajuan_id -->
                <form action="<?= base_url('jadwals/cari'); ?>" method="get" class="form-inline mb-3">
                    <div class="form-group">
                        <label for="pengajuan_id">Masukkan Pengajuan ID Yang Ingin Anda Cari :</label>
                        <input type="text" class="form-control mx-2" id="pengajuan_id" name="pengajuan_id" placeholder="Pengajuan ID" value="<?= isset($pengajuan_id) ? $pengajuan_id : ''; ?>" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>

                <!-- Jika ada hasil pencarian -->
                <?php if (isset($pengajuan)): ?>
                    <?php if ($pengajuan): ?>
                        <!-- Tampilkan hanya jika status 'Disetujui' -->
                        <?php if ($pengajuan['status'] === 'Disetujui'): ?>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Pengajuan</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>No HP</th>
                                                <th>Tanggal</th>
                                                <th>Jam</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Detail</th>
                                                <th> Rating</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $pengajuan['pengajuan_id']; ?></td>
                                                <td><?= $pengajuan['nama']; ?></td>
                                                <td><?= $pengajuan['email']; ?></td>
                                                <td><?= $pengajuan['no_hp']; ?></td>
                                                <td><?= $pengajuan['tanggal']; ?></td>
                                                <td><?= $pengajuan['jam']; ?></td>
                                                <td><?= $pengajuan['status']; ?></td>
                                                <td><?= $pengajuan['keterangan']; ?><!-- Tambahkan kolom Rating -->
                                                <td><a href="<?=base_url('detail/'. $pengajuan['pengajuan_id'])?>" class="btn btn-primary">Detail Kunjungan</a></td>
                                                <td>
                                                    <?php if (isset($rating) && $rating): ?>
                                                        <!-- Jika sudah ada rating, tampilkan tombol edit rating -->
                                                        <a href="<?= base_url('ratings/edit/' . $rating['rating_id']) ?>"><button class="btn btn-primary">Edit Rating</button></a>
                                                    <?php else: ?>
                                                        <!-- Jika belum ada rating, tampilkan tombol beri rating -->
                                                        <a href="<?= base_url('ratings/create/' . $pengajuan['pengajuan_id']) ?>"><button class="btn btn-primary">Beri Rating</button></a>
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Pesan jika pengajuan tidak ditemukan -->
                        <div class="alert alert-danger mt-3">
                            Data yang Anda cari tidak ada.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>