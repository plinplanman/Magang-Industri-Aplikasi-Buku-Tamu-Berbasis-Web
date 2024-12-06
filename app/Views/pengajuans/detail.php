<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pengajuan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pengajuan - ID: <?= $pengajuan['pengajuan_id'] ?></h3>

            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID Pengajuan</th>
                            <td><?= $pengajuan['pengajuan_id'] ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td><?= $pengajuan['nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $pengajuan['email'] ?></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td><?= $pengajuan['no_hp'] ?></td>
                        </tr>
                        <tr>
                            <th>Divisi</th>
                            <td><?= $namaDivisi ?></td>
                        </tr>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <td><?= $pengajuan['nama_perusahaan'] ?></td>
                        </tr>
                        <tr>
                            <th>Foto KTP</th>
                            <td>
                                <img src="/uploads/ktp/<?= $pengajuan['upload_ktp'] ?>" alt="Foto KTP" width="150px">
                            </td>
                        </tr>
                        <tr>
                            <th>Foto Selfie</th>
                            <td>
                                <img src="/uploads/selfie/<?= $pengajuan['upload_selfie'] ?>" alt="Foto Selfie" width="150px">
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= $pengajuan['tanggal'] ?></td>
                        </tr>
                        <tr>
                            <th>Jam</th>
                            <td><?= $pengajuan['jam'] ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <b>
                                    <?php
                                    // Mengatur warna teks berdasarkan status
                                    $statusClass = '';
                                    if ($pengajuan['status'] == 'Disetujui') {
                                        $statusClass = 'text-success'; // Merah untuk pending
                                    } elseif ($pengajuan['status'] == 'Pending' || $pengajuan['status'] == 'Ditolak') {
                                        $statusClass = 'text-danger'; // Hijau untuk disetujui atau Ditolak
                                    }
                                    ?>
                                    <span class="<?= $statusClass ?>"><?= $pengajuan['status'] ?></span>
                                </b><br>
                                </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= $pengajuan['keterangan'] ?></td>
                        </tr>
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
