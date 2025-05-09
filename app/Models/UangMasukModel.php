<?php

namespace App\Models;

use CodeIgniter\Model;

class UangMasukModel extends Model
{
    protected $table            = 'uang_masuk';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'jumlah', 'sumber', 'keterangan', 'user_id'];
    protected $useTimestamps    = false;
    protected $createdField     = 'created_at';
}
