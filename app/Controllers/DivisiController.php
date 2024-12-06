<?php

namespace App\Controllers;

use App\Models\DivisiModel;
use CodeIgniter\Controller;

class DivisiController extends Controller
{
    protected $divisiModel;

    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
    }

    public function index()
    {
        $data['title'] = 'Daftar Divisi';
        $data['divisis'] = $this->divisiModel->findAll();

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('divisis/index', $data);
        echo view('template/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Divisi';

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('divisis/create');
        echo view('template/footer');
    }

    public function store()
    {
        $this->divisiModel->save([
            'nama_divisi' => $this->request->getPost('nama_divisi'),
        ]);

        return redirect()->to('/divisis');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Divisi';
        $data['divisi'] = $this->divisiModel->find($id);

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('divisis/edit', $data);
        echo view('template/footer');
    }

    public function update($id)
    {
        $this->divisiModel->update($id, [
            'nama_divisi' => $this->request->getPost('nama_divisi'),
        ]);

        return redirect()->to('/divisis');
    }

    public function delete($id)
    {
        $this->divisiModel->delete($id);
        return redirect()->to('/divisis');
    }
}
