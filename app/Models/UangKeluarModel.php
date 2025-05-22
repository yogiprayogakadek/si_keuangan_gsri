<?php

namespace App\Models;

use CodeIgniter\Model;

class UangKeluarModel extends Model
{
    protected $table            = 'uang_keluar';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'jumlah', 'tujuan', 'keterangan', 'user_id'];
    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';

    public function getUangKeluar($start, $end)
    {
        return $this->db->table('uang_keluar')
        ->select('tanggal, SUM(jumlah) as jumlah')
        ->where('tanggal >=', $start)
        ->where('tanggal <=', $end)
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'ASC')
        ->get()
        ->getResultArray();
    }
}
