<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Rating Kunjungan</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulir Edit Rating Kunjungan</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('ratings/update/' . esc($rating['rating_id'])) ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="pengajuan_id" value="<?= esc($rating['pengajuan_id']) ?>">
                    <input type="hidden" name="rating_bintang" id="rating_bintang" value="<?= esc($rating['rating_bintang']) ?>" required>

                    <div class="form-group">
                        <label>Rating (Bintang 1-5)</label>
                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="star fas fa-star <?= $rating['rating_bintang'] >= $i ? 'text-warning' : 'text-secondary' ?>" data-value="<?= $i ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span id="selected-rating" class="d-none">Rating Terpilih: <span id="display-rating"><?= esc($rating['rating_bintang']) ?></span></span>
                    </div>

                    <div class="form-group">
                        <label for="catatan_masukan">Catatan Masukan (Opsional)</label>
                        <textarea name="catatan_masukan" id="catatan_masukan" class="form-control" rows="4"><?= esc($rating['catatan_masukan']) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="dokumentasi_foto">Dokumentasi Foto </label>
                        <input type="file" name="dokumentasi_foto" id="dokumentasi_foto" class="form-control">
                        <?php if ($rating['dokumentasi_foto']): ?>
                            <p>Foto saat ini: <img src="/uploads/<?= esc($rating['dokumentasi_foto']) ?>" alt="Dokumentasi" width="100"></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Update Rating</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    // Menangani klik pada bintang untuk memilih rating
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating_bintang');
    const displayRating = document.getElementById('display-rating');
    const selectedRating = document.getElementById('selected-rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('data-value');
            ratingInput.value = value; // Set nilai ke input hidden
            displayRating.textContent = value; // Tampilkan rating yang dipilih

            stars.forEach(s => {
                s.classList.toggle('text-warning', s.getAttribute('data-value') <= value); // Set bintang yang dipilih
                s.classList.toggle('text-secondary', s.getAttribute('data-value') > value); // Set bintang yang tidak dipilih
            });

            selectedRating.classList.remove('d-none'); // Tampilkan rating yang dipilih
        });
    });
</script>
