<?php

namespace App\Models;

use CodeIgniter\Model;
class PengajuanModel extends Model
{
    protected $table = 'pengajuans';
    protected $primaryKey = 'pengajuan_id';
    protected $allowedFields = [
        'divisi_id', 'email', 'no_hp', 'nama','nama_perusahaan', 'upload_ktp', 'upload_selfie', 'tanggal', 'jam', 'status', 'keterangan'
    ];

       // Method untuk mengambil data yang statusnya 'Disetujui' atau 'Ditolak'
    public function getApprovedOrCompleted()
    {
        return $this->where('status', 'Disetujui')
                    ->orWhere('status', 'Ditolak')
                    ->findAll();
    }
    

    public function getDivisiWithVisitCount()
    {
        return $this->select('divisis.nama_divisi, COUNT(pengajuans.pengajuan_id) as total')
                    ->join('divisis', 'divisis.divisi_id = pengajuans.divisi_id')
                    ->groupBy('divisis.nama_divisi')
                    ->get()
                    ->getResultArray();
    }

    // Method untuk mendapatkan pengajuan per bulan
public function getPengajuanGroupedByMonth()
{
    $query = $this->db->query("
        SELECT 
            MONTH(tanggal) AS bulan, 
            COUNT(*) AS total 
        FROM pengajuans 
        WHERE status = 'Disetujui' 
        GROUP BY MONTH(tanggal)
    ");
    
    return $query->getResultArray();
}


}
