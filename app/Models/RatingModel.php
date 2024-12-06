<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'ratings'; // Nama tabel di database
    protected $primaryKey = 'rating_id';
    protected $allowedFields = [
        'pengajuan_id',
        'rating_bintang',
        'catatan_masukan',
        'dokumentasi_foto'
    ]; // Kolom yang diizinkan untuk diinsert

    // Optional validation rules
    protected $validationRules = [
        'pengajuan_id'    => 'required|integer',
        'rating_bintang'  => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
        'catatan_masukan' => 'permit_empty',
        'dokumentasi_foto' => 'permit_empty|string'
    ];

    public function ratingExists($pengajuan_id)
    {
        return $this->where('pengajuan_id', $pengajuan_id)->countAllResults() > 0;
    }

    // Method untuk mengambil data ratings beserta informasi dari pengajuans dan divisis
    public function getRatingsWithDetails()
    {
        return $this->select('ratings.rating_id, ratings.pengajuan_id, ratings.rating_bintang, ratings.catatan_masukan, ratings.dokumentasi_foto,
                             pengajuans.nama, pengajuans.tanggal, pengajuans.jam, pengajuans.keterangan, pengajuans.nama_perusahaan,
                             divisis.nama_divisi')
            ->join('pengajuans', 'pengajuans.pengajuan_id = ratings.pengajuan_id', 'left') // Join dengan tabel pengajuans
            ->join('divisis', 'divisis.divisi_id = pengajuans.divisi_id', 'left') // Join dengan tabel divisis
            ->findAll(); // Mengambil semua data
    }

    public function getRatingsGroupedByStars()
    {
        // Query untuk mengelompokkan rating_bintang dan menghitung jumlahnya
        return $this->select('rating_bintang, COUNT(*) as total')
                    ->groupBy('rating_bintang')
                    ->orderBy('rating_bintang', 'ASC')
                    ->findAll();
    }


}
