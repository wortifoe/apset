<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table            = 'aset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
   
    protected $allowedFields    = [
        'id_unit',
        'merk',
        'jumlah',
        'status',
        'id_penempatan',
        'file',
        'id_karyawan',
        'penanggung_jawab',
        'keterangan'
    ];

    public function getAset()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, 
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->findAll();
    }
   
}
