<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'karyawan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'nama',
        'nip',
        'jabatan',
        'kategori_pegawai',
        'file',
        'norek',
        'keterangan'
    ];
}
