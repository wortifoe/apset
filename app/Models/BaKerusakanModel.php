<?php

namespace App\Models;

use CodeIgniter\Model;

class BaKerusakanModel extends Model
{
    protected $table            = 'ba_kerusakan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
   
    protected $allowedFields    = [
        'id_aset',
        'tanggal',
        'diajukan',
        'diketahui',
        'disetujui',
        'lampiran',
        'status_verifikasi',
        'status_persetujuan'
    ];

    public function getDataBA()
    {
        return $this->select('
                ba_kerusakan.*, 
                aset.merk, 
                unit.kode_barang, 
                (SELECT nama FROM karyawan WHERE karyawan.id = ba_kerusakan.diajukan) AS diajukan,
                (SELECT nama FROM karyawan WHERE karyawan.id = ba_kerusakan.diketahui) AS diketahui,
                (SELECT nama FROM karyawan WHERE karyawan.id = ba_kerusakan.disetujui) AS disetujui
            ')
            ->join('aset', 'aset.id = ba_kerusakan.id_aset')
            ->join('unit', 'unit.id = aset.id_unit')
            ->findAll();
    }
}
