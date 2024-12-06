<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1><b>Tambah Pengajuan Kunjungan</b></h1>
            <h5>Masukkan Data Diri</h5>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="/pengajuans/store" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="divisi_id">Pilih Divisi</label>
                        <select name="divisi_id" class="form-control" required>
                            <?php foreach ($divisis as $divisi): ?>
                                <option value="<?= $divisi['divisi_id'] ?>"><?= $divisi['nama_divisi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="number" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" class="form-control" placeholder="kosongkan jika pribadi">
                    </div>
                    <div class="form-group">
                        <label for="upload_ktp">Upload KTP</label>
                        <input type="file" name="upload_ktp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="upload_selfie">Upload Selfie</label>
                        <input type="file" name="upload_selfie" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                    </div>

                    <script>
                        // Mendapatkan tanggal hari ini
                        var today = new Date().toISOString().split('T')[0];
                        // Set nilai minimum pada input tanggal
                        document.getElementById("tanggal").setAttribute('min', today);
                    </script>

                    <div class="form-group">
                        <label for="jam">Jam (07:00 - 17;00)</label>
                        <input type="time" name="jam" class="form-control" required min="07:00" max="17:00" placeholder="pukul 07:00 - 17;00">
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder='tulis keperluan kunjungan'></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </section>
</div>