<?php

namespace App\Models;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table = 'divisis';
    protected $primaryKey = 'divisi_id';
    protected $allowedFields = ['nama_divisi'];

    public function getDivisiWithMostVisits()
{
    return $this->select('divisis.nama_divisi, COUNT(*) as total')
                ->join('pengajuans', 'pengajuans.divisi_id = divisis.divisi_id')
                ->groupBy('divisis.divisi_id')
                ->orderBy('total', 'DESC')
                ->findAll();
}

}
