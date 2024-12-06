<?php

namespace App\Controllers;

use App\Models\RatingModel;

class GaleriController extends BaseController
{
    public function index()
    {
        $ratingModel = new RatingModel();

        // Mengambil data rating beserta detail pengajuans dan divisis
        $data['ratings'] = $ratingModel->getRatingsWithDetails();

        // Menambahkan variabel title
        $data['title'] = 'Galeri Foto';

        // Memuat tampilan dengan template yang diberikan
        echo view('template/header', $data);
        echo view('galeris/index', $data); // Mengarahkan ke view galeri
        echo view('template/footer');
    }
}
