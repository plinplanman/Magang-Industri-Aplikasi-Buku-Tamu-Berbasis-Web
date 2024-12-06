<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table      = 'beritas';
    protected $primaryKey = 'berita_id';
    protected $allowedFields = ['rating_id', 'judul_berita', 'isi_berita'];

    protected $useTimestamps = true; // Menggunakan created dan updated otomatis

    public function getBeritasDenganRating()
    {
        return $this->select('beritas.*, ratings.dokumentasi_foto, ratings.rating_id')
                   ->join('ratings', 'beritas.rating_id = ratings.rating_id') // Pastikan join menggunakan rating_id
                   ->orderBy('beritas.created_at', 'DESC') // Urutkan berdasarkan created_at dari yang terbaru
                   ->findAll();
    }
    
}

