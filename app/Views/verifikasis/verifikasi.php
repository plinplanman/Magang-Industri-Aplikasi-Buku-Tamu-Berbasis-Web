<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Verifikasi Pengajuan</h1>
        </div>
    </section>

    <section class="content">
        <script>
            function confirmUpdate() {
                return confirm('Kamu yakin akan mengubah status dan mengirim email pemberitahuan ke pendaftar?');
            }
        </script>
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('verifikasi/update/' . $pengajuan['pengajuan_id']) ?>" method="post" onsubmit="return confirmUpdate()">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                    <label for="status">Ubah Status Menjadi 'Disetujui' atau 'Ditolak' untuk memverifikasi pengajuan dan mengirim email ke pendaftar </label>
                    <select name="status" class="form-control" required>
                        
                            <option value="Pending" <?= $pengajuan['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Disetujui" <?= $pengajuan['status'] == 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                            <option value="Ditolak" <?= $pengajuan['status'] == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/pengajuans" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </section>
</div>
