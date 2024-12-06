<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use App\Models\DivisiModel; // Import model Divisi
use App\Models\RatingModel; 

class JadwalController extends BaseController
{
    protected $pengajuanModel;
    protected $divisiModel; // Tambahkan property untuk model Divisi
    protected $RatingModel; 

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanModel();
        $this->divisiModel = new DivisiModel(); // Inisialisasi model Divisi
        $this->RatingModel= new RatingModel();
    }

    // Method untuk menampilkan jadwal kunjungan yang hanya disetujui
    public function index()
{
    $data['title'] = 'Jadwal Kunjungan';

    // Ambil data yang statusnya 'Disetujui'
    $data['jadwals'] = $this->pengajuanModel->where('status', 'Disetujui')->findAll();

    // Ambil data dari tabel divisis
    $divisis = $this->divisiModel->findAll();

    // Buat pemetaan divisi_id ke nama_divisi
    $divisiMap = [];
    foreach ($divisis as $divisi) {
        $divisiMap[$divisi['divisi_id']] = $divisi['nama_divisi'];
    }

    // Kirim pemetaan ke view
    $data['divisiMap'] = $divisiMap;

    // Loop melalui jadwal untuk mengecek rating setiap pengajuan
    foreach ($data['jadwals'] as &$jadwal) {
        // Cek apakah sudah ada rating untuk pengajuan_id
        $rating = $this->RatingModel->where('pengajuan_id', $jadwal['pengajuan_id'])->first();
        $jadwal['rating'] = $rating; // Simpan informasi rating, jika ada
    }

    // Render view
    echo view('template/header', $data);
    echo view('template/top_menu');
    echo view('template/side_menu');
    echo view('jadwals/index', $data);
    echo view('template/footer');
}


    public function cari()
{
    $data['title'] = 'Cari Jadwal Kunjungan';
    $pengajuan_id = $this->request->getVar('pengajuan_id');

    if ($pengajuan_id) {
        // Cari pengajuan yang sesuai dengan pengajuan_id dan status disetujui
        $pengajuan = $this->pengajuanModel->where('pengajuan_id', $pengajuan_id)
            ->where('status', 'Disetujui') // Hanya cari yang disetujui
            ->first();

        if ($pengajuan) {
            // Cek apakah sudah ada rating untuk pengajuan_id
            $rating = $this->RatingModel->where('pengajuan_id', $pengajuan_id)->first();
            $data['pengajuan'] = $pengajuan;
            $data['rating'] = $rating; // Simpan informasi rating, jika ada
        }

        $data['pengajuan_id'] = $pengajuan_id;
    }

    // Render view pencarian
    echo view('template/header', $data);
    echo view('jadwals/cari', $data);
    echo view('template/footer');
}

}
