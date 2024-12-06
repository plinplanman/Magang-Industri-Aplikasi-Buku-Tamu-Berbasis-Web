<?php

namespace App\Controllers;


use App\Models\PengajuanModel;
use App\Models\DivisiModel;
use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\Email\Email;


class PengajuanController extends Controller
{
    protected $divisiModel;
    protected $pengajuanModel;
    protected $email;

    public function __construct()
    {
        $this->divisiModel = new DivisiModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->email = \Config\Services::email(); // Load layanan email
    }

    public function index()
    {
        // Ambil data pengajuan dan urutkan berdasarkan pengajuan_id secara descending (terbaru di atas)
        $pengajuans = $this->pengajuanModel->orderBy('pengajuan_id', 'DESC')->findAll();

        // Ambil data divisi
        $divisis = $this->divisiModel->findAll();

        // Buat array asosiatif divisi_id => nama_divisi
        $divisiMap = [];
        foreach ($divisis as $divisi) {
            // Pastikan divisi_id disimpan dengan benar
            $divisiMap[(int)$divisi['divisi_id']] = $divisi['nama_divisi'];
        }

        // Kirim data pengajuan dan divisiMap ke view
        $data = [
            'title' => 'Daftar Pengajuan',
            'pengajuans' => $pengajuans,
            'divisiMap' => $divisiMap, // Kirim divisiMap ke view
        ];

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('pengajuans/index', $data);
        echo view('template/footer');
    }



    public function create()
    {
        $data['title'] = 'Tambah Pengajuan';
        $data['divisis'] = $this->divisiModel->findAll();

        echo view('template/header', $data);
        echo view('pengajuans/create', $data);
        echo view('template/footer');
    }

    public function store()
    {
        $fileKTP = $this->request->getFile('upload_ktp');
        $fileSelfie = $this->request->getFile('upload_selfie');

        $data = [
            'divisi_id' => $this->request->getPost('divisi_id'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'nama' => $this->request->getPost('nama'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'status' => 'Pending', // Set default status
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Simpan file KTP dan selfie
        if ($fileKTP && $fileKTP->isValid()) {
            $data['upload_ktp'] = $fileKTP->getName();
            $fileKTP->move('uploads/ktp');
        } else {
            $data['upload_ktp'] = null;
        }

        if ($fileSelfie && $fileSelfie->isValid()) {
            $data['upload_selfie'] = $fileSelfie->getName();
            $fileSelfie->move('uploads/selfie');
        } else {
            $data['upload_selfie'] = null;
        }

        // Simpan data pengajuan dan dapatkan ID yang baru saja disimpan
        $this->pengajuanModel->save($data);
        $pengajuan_id = $this->pengajuanModel->insertID(); // Gunakan insertID() setelah save() untuk mendapatkan ID

        // Kirim email setelah data berhasil disimpan
        $email = \Config\Services::email();
        $email->setTo('paulpogbaBB12345@gmail.com'); // Kirim ke email admin
        $email->setFrom('paulpogbaBB12345@gmail.com', 'Admin Buku Tamu'); // Ganti dengan email dan nama kamu

        // Set subjek dan isi email
        $email->setSubject('Pengajuan Kunjungan');
        $message = "
        Halo Admin,

        Seorang tamu telah mengajukan permohonan kunjungan.<br>
        Mohon untuk memverifikasi dan menyetujui detail pengajuan kunjungan berikut:<br>

        Nama Tamu: " . $this->request->getPost('nama') . "<br>
        Divisi Tujuan: " . $this->divisiModel->find($this->request->getPost('divisi_id'))['nama_divisi'] . "<br>
        Tanggal Kunjungan: " . $this->request->getPost('tanggal') . "<br>
        Jam Kunjungan: " . $this->request->getPost('jam') . "<br>
        Keterangan: " . $this->request->getPost('keterangan') . "<br>

        Silakan segera melakukan verifikasi dan mengambil tindakan lebih lanjut untuk menyetujui atau menolak pengajuan kunjungan ini.<br>

        Untuk melihat detail pengajuan, kunjungi link berikut:
        http://localhost:8080/verifikasi/edit/" . $pengajuan_id . "<br>

        Terima kasih!
    ";
        $email->setMessage($message);

        // Tambahkan lampiran (KTP dan Selfie jika ada)
        if ($fileKTP && $fileKTP->isValid()) {
            $email->attach('uploads/ktp/' . $fileKTP->getName());
        }
        if ($fileSelfie && $fileSelfie->isValid()) {
            $email->attach('uploads/selfie/' . $fileSelfie->getName());
        }

        // Kirim email
        if ($email->send()) {
            return redirect()->to('/pengajuans')
                ->with('success', 'Data telah terkirim ke admin, tunggu verifikasi lebih lanjut. Informasi akan diberitahukan lewat email yang Anda masukkan.');
        } else {
            return redirect()->to('/pengajuans')
                ->with('error', 'Pengajuan berhasil ditambahkan, tetapi email gagal dikirim.');
        }
    }



    public function edit($id)
    {
        $data['title'] = 'Edit Pengajuan';
        $data['pengajuan'] = $this->pengajuanModel->find($id);
        $data['divisis'] = $this->divisiModel->findAll();

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('pengajuans/edit', $data);
        echo view('template/footer');
    }

    public function update($id)
    {
        $fileKTP = $this->request->getFile('upload_ktp');
        $fileSelfie = $this->request->getFile('upload_selfie');

        $data = [
            'divisi_id' => $this->request->getPost('divisi_id'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'nama' => $this->request->getPost('nama'),
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Cek dan simpan file jika ada
        if ($fileKTP && $fileKTP->isValid()) {
            $data['upload_ktp'] = $fileKTP->getName();
            $fileKTP->move('uploads/ktp');
        } else {
            $data['upload_ktp'] = $this->request->getPost('existing_ktp'); // Ambil yang sudah ada jika tidak diupload baru
        }

        if ($fileSelfie && $fileSelfie->isValid()) {
            $data['upload_selfie'] = $fileSelfie->getName();
            $fileSelfie->move('uploads/selfie');
        } else {
            $data['upload_selfie'] = $this->request->getPost('existing_selfie'); // Ambil yang sudah ada jika tidak diupload baru
        }

        $this->pengajuanModel->update($id, $data);
        return redirect()->to('/pengajuans')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->pengajuanModel->delete($id);
        return redirect()->to('/pengajuans')->with('success', 'Pengajuan berhasil dihapus.');
    }
    public function detail($pengajuan_id)
    {
        // Ambil detail data pengajuan berdasarkan pengajuan_id
        $pengajuan = $this->pengajuanModel->find($pengajuan_id);

        // Jika pengajuan tidak ditemukan, tampilkan halaman 404
        if (!$pengajuan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengajuan dengan ID $pengajuan_id tidak ditemukan");
        }

        // Ambil data divisi berdasarkan divisi_id dari pengajuan
        $divisi = $this->divisiModel->find($pengajuan['divisi_id']);

        // Jika divisi tidak ditemukan, buat default pesan
        $namaDivisi = $divisi ? $divisi['nama_divisi'] : 'Divisi tidak ditemukan';

        // Kirim data pengajuan dan divisi ke view
        $data = [
            'title' => 'Detail Pengajuan',
            'pengajuan' => $pengajuan,
            'namaDivisi' => $namaDivisi,
        ];

        // Load view dengan data yang sudah disiapkan
        echo view('template/header', $data);
        echo view('pengajuans/detail', $data);
        echo view('template/footer');
    }
}
