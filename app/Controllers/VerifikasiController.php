<?php

namespace App\Controllers;

use App\Models\PengajuanModel;
use App\Models\DivisiModel;
use CodeIgniter\Email\Email;

class VerifikasiController extends BaseController
{
    protected $pengajuanModel;
    protected $divisiModel;

    public function __construct()
    {
        $this->pengajuanModel = new PengajuanModel();
        $this->divisiModel = new DivisiModel();
    }

    // Method to show the verification form
    public function edit($id)
    {
        $pengajuan = $this->pengajuanModel->find($id);
        $divisi = $this->divisiModel->find($pengajuan['divisi_id']);
        $namaDivisi = $divisi ? $divisi['nama_divisi'] : 'Divisi tidak ditemukan';

        $data = [
            'title' => 'Verifikasi Pengajuan',
            'pengajuan' => $pengajuan,
            'namaDivisi' => $namaDivisi
        ];

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('template/side_menu');
        echo view('verifikasis/verifikasi', $data);
        echo view('template/footer');
    }

    // Method to update only the 'status' field
    public function update($id)
    {
        $status = $this->request->getPost('status');

        // Update only the 'status' field in the database
        $this->pengajuanModel->update($id, ['status' => $status]);

        // Jika status 'Disetujui', kirim email
        if ($status == 'Disetujui') {
            $pengajuan = $this->pengajuanModel->find($id);
            $divisi = $this->divisiModel->find($pengajuan['divisi_id']);
            $namaDivisi = $divisi ? $divisi['nama_divisi'] : 'Divisi tidak ditemukan';

            $emailAddress = $pengajuan['email'] ?? ''; // Tangani kasus email null

            // Cek jika email tidak kosong dan valid
            if (!empty($emailAddress) && filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $email = \Config\Services::email();
                $email->setFrom('paulpogbaBB12345@gmail.com', 'Admin Buku Tamu');
                $email->setTo($emailAddress); // Kirim ke email yang valid

                // Setel subjek dan pesan
                $email->setSubject('Pengajuan Kunjungan Disetujui');
                $message = "
            Halo " . $pengajuan['nama'] . ",<br>
            Pengajuan kunjungan Anda telah disetujui.<br>
            Berikut detail pengajuan:<br><br>
            
            ID: " . $pengajuan['pengajuan_id'] . "<br>
            Nama: " . $pengajuan['nama'] . "<br>
            Divisi: " . $namaDivisi . "<br>
            Tanggal: " . $pengajuan['tanggal'] . "<br>
            Jam: " . $pengajuan['jam'] . "<br>
            Keterangan: " . $pengajuan['keterangan'] . "<br><br>

            Untuk melihat detail kunjungan, kunjungi link berikut:<br>
            <a href='http://localhost:8080/detail/" . $pengajuan['pengajuan_id'] . "'>Detail Kunjungan</a><br><br>
            
            atau untuk memberi rating setelah kunjungan, kunjungi link:<br>
            <a href='http://localhost:8080/jadwals/cari'>Beri Rating</a><br><br>
            
            Terima kasih!
        ";

                $email->setMessage($message);

                // Kirim email
                if (!$email->send()) {
                    return redirect()->to('/pengajuans')->with('error', 'Status diperbarui, tapi email gagal dikirim.');
                }
            } else {
                // Tangani email yang tidak valid atau kosong
                return redirect()->to('/pengajuans')->with('error', 'Status diperbarui, tapi email tidak valid atau kosong.');
            }
        }

        // Jika status 'Ditolak', kirim email
        else if ($status == 'Ditolak') {
            $pengajuan = $this->pengajuanModel->find($id);
            $divisi = $this->divisiModel->find($pengajuan['divisi_id']);
            $namaDivisi = $divisi ? $divisi['nama_divisi'] : 'Divisi tidak ditemukan';

            $emailAddress = $pengajuan['email'] ?? ''; // Tangani kasus email null

            // Cek jika email tidak kosong dan valid
            if (!empty($emailAddress) && filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $email = \Config\Services::email();
                $email->setFrom('paulpogbaBB12345@gmail.com', 'Admin Buku Tamu');
                $email->setTo($emailAddress); // Kirim ke email yang valid

                // Setel subjek dan pesan
                $email->setSubject('Pengajuan Kunjungan Ditolak');
                $message = "
            Halo " . $pengajuan['nama'] . ",<br>
            Pengajuan kunjungan Anda telah ditolak.<br>
            Berikut detail pengajuan:<br><br>
            
            Nama: " . $pengajuan['nama'] . "<br>
            Divisi: " . $namaDivisi . "<br>
            Tanggal: " . $pengajuan['tanggal'] . "<br>
            Jam: " . $pengajuan['jam'] . "<br>
            Keterangan: " . $pengajuan['keterangan'] . "<br><br>
            Catatan Admin: .<br><br>

            Terima kasih!
        ";

                $email->setMessage($message);

                // Kirim email
                if (!$email->send()) {
                    return redirect()->to('/pengajuans')->with('error', 'Status diperbarui, tapi email gagal dikirim.');
                }
            } else {
                // Tangani email yang tidak valid atau kosong
                return redirect()->to('/pengajuans')->with('error', 'Status diperbarui, tapi email tidak valid atau kosong.');
            }
        }


        return redirect()->to('/pengajuans')->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
