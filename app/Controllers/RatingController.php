<?php

namespace App\Controllers;

use App\Models\RatingModel;
use App\Models\PengajuanModel;
use CodeIgniter\Controller;

class RatingController extends BaseController
{
    protected $ratingModel;
    protected $pengajuanModel;

    public function __construct()
    {
        $this->ratingModel = new RatingModel();
        $this->pengajuanModel = new PengajuanModel();
    }

    // Method index
    public function index()
    {
        $data['title'] = 'Daftar Rating'; // Judul halaman
        $data['ratings'] = $this->ratingModel->findAll();

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('ratings/index', $data); // Halaman utama rating
        echo view('template/footer');
    }

    // Method untuk create rating
    public function create($pengajuan_id)
    {
        $data['title'] = 'Beri Rating Kunjungan'; // Judul halaman
        $data['pengajuan'] = $this->pengajuanModel->find($pengajuan_id);
        $data['pengajuan_id'] = $pengajuan_id;

        echo view('template/header', $data);
        echo view('ratings/create', $data); // Form untuk memberi rating
        echo view('template/footer');
    }

    public function store()
    {
        $file = $this->request->getFile('dokumentasi_foto');
        $fileName = null;

        // Pastikan folder tujuan ada
        if (!is_dir(FCPATH . 'uploads/dokumentasi_foto')) {
            mkdir(FCPATH . 'uploads/dokumentasi_foto', 0777, true);
        }

        // Periksa apakah file sudah di-upload
        if ($file && !$file->hasMoved()) {
            // Generate nama file acak
            $fileName = $file->getRandomName();
            // Pindahkan file ke folder public/uploads/dokumentasi_foto/
            $file->move(FCPATH . 'uploads/dokumentasi_foto/', $fileName);
        }

        // Simpan data ke database
        $this->ratingModel->save([
            'pengajuan_id'    => $this->request->getPost('pengajuan_id'),
            'dokumentasi_foto' => $fileName,
            'rating_bintang'  => $this->request->getPost('rating_bintang'),
            'catatan_masukan' => $this->request->getPost('catatan_masukan')
        ]);

        return redirect()->to('/galeris')->with('message', 'Rating berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['rating'] = $this->ratingModel->find($id);
        $data['title'] = 'Edit Rating';

        echo view('template/header', $data);
        echo view('ratings/edit', $data);
        echo view('template/footer');
    }

    public function update($id)
    {
        $rating = $this->ratingModel->find($id);

        // Handle file upload
        $fileFoto = $this->request->getFile('dokumentasi_foto');
        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            // Beri nama unik untuk file yang diupload agar tidak tertimpa
            $newName = $fileFoto->getRandomName();
            // Pindahkan file ke folder uploads
            $fileFoto->move('uploads/dokumentasi_foto', $newName);

            // Hapus foto lama jika ada
            if (!empty($rating['dokumentasi_foto'])) {
                if (file_exists('uploads/dokumentasi_foto/' . $rating['dokumentasi_foto'])) {
                    unlink('uploads/dokumentasi_foto/' . $rating['dokumentasi_foto']);
                }
            }
        } else {
            // Jika tidak ada file yang diupload, gunakan foto lama
            $newName = $rating['dokumentasi_foto'];
        }

        // Update data rating
        $this->ratingModel->update($id, [
            'pengajuan_id'    => $this->request->getVar('pengajuan_id'),
            'dokumentasi_foto' => $newName, // Gunakan nama file baru atau lama
            'rating_bintang'  => $this->request->getVar('rating_bintang'),
            'catatan_masukan' => $this->request->getVar('catatan_masukan')
        ]);

        return redirect()->to('/galeris');
    }


    public function delete($rating_id)
    {
        // Logic to delete the rating by ID
        if ($this->ratingModel->delete($rating_id)) {
            return redirect()->to('/ratings')->with('success', 'Rating deleted successfully.');
        } else {
            return redirect()->to('/ratings')->with('error', 'Failed to delete rating.');
        }
    }

    
}
