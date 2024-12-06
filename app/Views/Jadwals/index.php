<!-- template header dan layout lainnya disesuaikan -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Kunjungan</h1>
                </div>
            </div>
        </div>
        
        <a href="<?= base_url('jadwals/cari') ?>"><button class="btn btn-primary">Cari Jadwal</button> </a>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Welcome message box -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jadwal Kunjungan yang Disetujui </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Divisi</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th> Beri Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($jadwals)): ?>
                            <?php foreach ($jadwals as $jadwal): ?>
                                <tr>
                                    <td><?= $jadwal['pengajuan_id'] ?></td>
                                    <td><?= isset($divisiMap[$jadwal['divisi_id']]) ? $divisiMap[$jadwal['divisi_id']] : 'Divisi tidak ditemukan'; ?></td>
                                    <td><?= $jadwal['email'] ?></td>
                                    <td><?= $jadwal['no_hp'] ?></td>
                                    <td><?= $jadwal['nama'] ?></td>
                                    <td><?= $jadwal['tanggal'] ?></td>
                                    <td><?= $jadwal['jam'] ?></td>
                                    <td class="text-success"><b><?= $jadwal['status'] ?></b></td>
                                    <td>
                                        <?php if (isset($jadwal['rating']) && $jadwal['rating']): ?>
                                            <!-- Jika sudah ada rating, tampilkan tombol edit rating -->
                                            <a href="<?= base_url('ratings/edit/' . $jadwal['rating']['rating_id']) ?>">
                                                <button class="btn btn-primary">Edit Rating</button>
                                            </a>
                                        <?php else: ?>
                                            <!-- Jika belum ada rating, tampilkan tombol beri rating -->
                                            <a href="<?= base_url('ratings/create/' . $jadwal['pengajuan_id']) ?>">
                                                <button class="btn btn-primary">Beri Rating</button>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada jadwal kunjungan yang disetujui</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
                          <!-- /.card-body-->

        </div>
                    <!-- /.card -->

    </section>
        <!-- /.content -->

</div>
<!-- /.content-wrapper -->
