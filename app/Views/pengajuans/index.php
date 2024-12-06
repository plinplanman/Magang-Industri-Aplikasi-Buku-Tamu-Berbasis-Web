<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pengajuan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengajuan</h3>
                <div class="card-tools">
                    <a href="/pengajuans/create" class="btn btn-primary">Tambah Pengajuan</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Divisi Tujuan</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Nama Perusahaan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengajuans as $pengajuan): ?>
                            <tr>

                                <!-- Casting divisi_id ke tipe int agar sesuai dengan key di $divisiMap -->
                                <td><?= isset($divisiMap[(int)$pengajuan['divisi_id']]) ? $divisiMap[(int)$pengajuan['divisi_id']] : 'Divisi tidak ditemukan'; ?></td>
                                <td><?= $pengajuan['email'] ?></td>
                                <td><?= $pengajuan['nama'] ?></td>
                                <td><?= $pengajuan['nama_perusahaan'] ?></td>

                                <td><?= $pengajuan['tanggal'] ?></td>
                                <td><?= $pengajuan['jam'] ?></td>
                                <td>
                                    <b><?php
                                        // Mengatur warna teks berdasarkan status
                                        $statusClass = '';
                                        if ($pengajuan['status'] == 'Disetujui') {
                                            $statusClass = 'text-success'; // Merah untuk pending
                                        } elseif ($pengajuan['status'] == 'Pending' || $pengajuan['status'] == 'Ditolak') {
                                            $statusClass = 'text-danger'; // Hijau untuk disetujui atau Ditolak
                                        }
                                        ?>
                                        <span class="<?= $statusClass ?>"><?= $pengajuan['status'] ?></span>
                                    </b>
                                </td>
                                <td><a href="<?= base_url('detail/' . $pengajuan['pengajuan_id']) ?>"><button class="btn btn-primary">Detail Kunjungan</button></a></td>

                                <td>
                                    <a href="<?= base_url('verifikasi/edit/' . $pengajuan['pengajuan_id']) ?>" class="btn btn-primary">Verifikasi</a>

                                    <a href="/pengajuans/edit/<?= $pengajuan['pengajuan_id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/pengajuans/delete/<?= $pengajuan['pengajuan_id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Tambahkan Script untuk Alert -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        alert('<?= session()->getFlashdata('success') ?>');
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        alert('<?= session()->getFlashdata('error') ?>');
    </script>
<?php endif; ?>