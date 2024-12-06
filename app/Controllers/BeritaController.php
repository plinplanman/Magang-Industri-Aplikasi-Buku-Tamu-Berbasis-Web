<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\RatingModel;
use CodeIgniter\Controller;

class BeritaController extends Controller
{
    protected $beritaModel;
    protected $ratingModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->ratingModel = new RatingModel(); // Assuming RatingModel exists
    }

    public function index()
    {
        $data['beritas'] = $this->beritaModel->findAll();
        $data['ratings'] = $this->ratingModel
        ->select('ratings.rating_id, pengajuans.nama, pengajuans.tanggal, pengajuans.jam, divisis.nama_divisi')
        ->join('pengajuans', 'ratings.pengajuan_id = pengajuans.pengajuan_id')
        ->join('divisis', 'pengajuans.divisi_id = divisis.divisi_id') // Mengambil nama_divisi dari tabel divisis
        ->findAll();
        $data['title'] = ('Berita');

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('beritas/index', $data);
        echo view('template/footer');
    }

    public function create()
    {
        $data['ratings'] = $this->ratingModel
        ->select('ratings.rating_id, pengajuans.nama, pengajuans.tanggal, pengajuans.jam, divisis.nama_divisi')
        ->join('pengajuans', 'ratings.pengajuan_id = pengajuans.pengajuan_id')
        ->join('divisis', 'pengajuans.divisi_id = divisis.divisi_id') // Mengambil nama_divisi dari tabel divisis
        ->findAll();
    
        $data['title'] = ('Berita');


        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('beritas/create', $data);
        echo view('template/footer');
    }

    public function store()
    {
        $this->beritaModel->save([
            'rating_id' => $this->request->getVar('rating_id'),
            'judul_berita' => $this->request->getVar('judul_berita'),
            'isi_berita' => $this->request->getVar('isi_berita'),
        ]);

        return redirect()->to('/beritas');
    }

    public function edit($id)
    {
        $data['berita'] = $this->beritaModel->find($id);
        $data['ratings'] = $this->ratingModel
        ->select('ratings.rating_id, pengajuans.nama, pengajuans.tanggal, pengajuans.jam, divisis.nama_divisi')
        ->join('pengajuans', 'ratings.pengajuan_id = pengajuans.pengajuan_id')
        ->join('divisis', 'pengajuans.divisi_id = divisis.divisi_id') // Mengambil nama_divisi dari tabel divisis
        ->findAll();
    
        $data['title'] = ('Berita');


        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('beritas/edit', $data);
        echo view('template/footer');
    }

    public function update($id)
    {
        $this->beritaModel->update($id, [
            'rating_id' => $this->request->getVar('rating_id'),
            'judul_berita' => $this->request->getVar('judul_berita'),
            'isi_berita' => $this->request->getVar('isi_berita'),
        ]);

        return redirect()->to('/beritas');
    }

    // Metode untuk menampilkan berita di halaman portal
    public function halamanberita()
    {
        // Mengambil semua berita dengan rating yang terkait dari database
        $data['beritas'] = $this->beritaModel->getBeritasDenganRating();
        $data['title'] = 'Halaman Berita';
    
        // Memuat view untuk halaman berita
        echo view('template/header', $data);
        echo view('beritas/halamanberita', $data); // View yang akan ditampilkan
        echo view('template/footer');
    }
    

    public function delete($id)
    {
        $this->beritaModel->delete($id);

        return redirect()->to('/beritas');
    }
}
