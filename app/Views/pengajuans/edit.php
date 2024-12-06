<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Pengajuan</h1>
        </div>
    </section>

    <section class="content">
        <script>
            function confirmUpdate() {
                return confirm('Kamu yakin melakukan  perubahan  ?');
            }
        </script>
        <div class="card">
            <div class="card-body">
                <form action="/pengajuans/update/<?= $pengajuan['pengajuan_id'] ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmUpdate()">
                    <input type="hidden" name="existing_ktp" value="<?= $pengajuan['upload_ktp'] ?>">
                    <input type="hidden" name="existing_selfie" value="<?= $pengajuan['upload_selfie'] ?>">

                    <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <select name="divisi_id" class="form-control" required>
                            <?php foreach ($divisis as $divisi): ?>
                                <option value="<?= $divisi['divisi_id'] ?>" <?= ($divisi['divisi_id'] == $pengajuan['divisi_id']) ? 'selected' : '' ?>><?= $divisi['nama_divisi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $pengajuan['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $pengajuan['no_hp'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $pengajuan['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" value="<?= $pengajuan['nama_perusahaan'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="upload_ktp">Upload KTP</label>
                        <input type="file" name="upload_ktp" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="upload_selfie">Upload Selfie</label>
                        <input type="file" name="upload_selfie" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= isset($pengajuan['tanggal']) ? $pengajuan['tanggal'] : '' ?>" required>
                    </div>

                    <script>
                        // Mendapatkan tanggal hari ini
                        var today = new Date().toISOString().split('T')[0];
                        // Set nilai minimum pada input tanggal
                        document.getElementById("tanggal").setAttribute('min', today);
                    </script>
                    <div class="form-group">
                        <label for="jam">Jam (07:00 - 17:00)</label>
                        <input type="time" name="jam" class="form-control" value="<?= $pengajuan['jam'] ?>" required min="07:00" max="17:00" placeholder="pukul 07:00 - 17;00">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control"><?= $pengajuan['keterangan'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>

</div>