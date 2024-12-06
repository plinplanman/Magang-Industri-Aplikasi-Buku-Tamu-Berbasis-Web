<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Home extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        // Inisialisasi model BeritaModel
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        // Ambil 3 berita terbaru, urutkan berdasarkan waktu dibuat (created_at)
        $data = [
            'title' => 'Home',
            'beritas' => $this->beritaModel->orderBy('created_at', 'DESC')->findAll(3) // Mengambil 3 berita terbaru
            
        ];
        $data['beritas'] = $this->beritaModel->getBeritasDenganRating();


        // Load views dengan data yang sesuai
        echo view('template/header', $data);
        echo view('Home', $data); // Pastikan data dikirim ke view 'Home'
        echo view('template/footer');
    }
}
