<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RatingModel;
use App\Models\DivisiModel;
use App\Models\PengajuanModel;

class DashboardController extends BaseController
{
    protected $ratingModel;

    public function __construct()
    {
        // Inisialisasi RatingModel untuk mengambil data dari tabel ratings
        $this->ratingModel = new RatingModel();
    }

    public function index()
{
    $pengajuanModel = new PengajuanModel();
    $divisiModel = new DivisiModel(); // Tambahkan model divisi untuk data divisi

    // Ambil data rating yang dikelompokkan berdasarkan rating bintang
    $ratings = $this->ratingModel->getRatingsGroupedByStars();

    // Ambil data divisi dan jumlah kunjungan
    $divisiData = $pengajuanModel->getDivisiWithVisitCount();

    // Ambil data kunjungan berdasarkan bulan
    $pengajuanPerBulan = $pengajuanModel->getPengajuanGroupedByMonth();

    // Inisialisasi label dan data untuk chart rating
    $ratingLabels = [];
    $ratingData = [];

    foreach ($ratings as $rating) {
        $ratingLabels[] = $rating['rating_bintang'] . ' Bintang'; // Atur label rating
        $ratingData[] = $rating['total']; // Atur data jumlah rating
    }

    // Inisialisasi label dan data untuk chart divisi
    $divisiLabels = [];
    $divisiCounts = [];

    foreach ($divisiData as $divisi) {
        $divisiLabels[] = $divisi['nama_divisi'];
        $divisiCounts[] = $divisi['total'];
    }

    // Siapkan labels dan data untuk kunjungan per bulan
    $kunjunganperbulanLabels = [];
    $kunjunganperbulanData = [];

    // Array nama bulan
    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    foreach ($pengajuanPerBulan as $row) {
        // Menggunakan nama bulan sesuai dengan index
        $bulan = (int)$row['bulan']; // Pastikan bulan adalah integer
        $kunjunganperbulanLabels[] = $namaBulan[$bulan]; // Menambahkan label bulan
        $kunjunganperbulanData[] = (int)$row['total']; // Menambahkan total kunjungan
    }

    // Kirim data ke view
    $data = [
        'title' => 'Dashboard',
        'labels1' => json_encode($ratingLabels), // Rating labels
        'data1' => json_encode($ratingData), // Rating data
        'labels2' => json_encode($divisiLabels), // Divisi labels
        'data2' => json_encode($divisiCounts), // Divisi data
        'labels3' => json_encode($kunjunganperbulanLabels), // Kunjungan per bulan labels
        'data3' => json_encode($kunjunganperbulanData), // Kunjungan per bulan data
    ];

    // Render view
    echo view('template/header', $data);
    echo view('template/top_menu');
    echo view('template/side_menu');
    echo view('dashboard', $data);
    echo view('template/footer');
}

    
}
