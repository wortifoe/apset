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
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, penempatan.alamat,
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->findAll();
    }
   
    public function getAsetbyID($id)
    {
        return $this->select('aset.*, 
                             unit.nama_barang, 
                             unit.kode_barang, 
                             penempatan.lokasi AS penempatan, 
                             IF(aset.id_karyawan = 0, aset.penanggung_jawab, 
                                (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab,
                             IF(aset.id_karyawan = 0, NULL, 
                                (SELECT jabatan FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS jabatan_pj')
            ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
            ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
            ->join('karyawan', 'karyawan.id = aset.id_karyawan', 'left') // Join dengan tabel karyawan untuk ambil nama dan jabatan
            ->where('aset.id', $id)
            ->first();
    }

    public function getAsetRusak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','rusak')
        ->findAll();
    }

    public function getAsetRusakBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','rusak')
        ->where('unit.status','bergerak')
        ->findAll();
    }
    
    
    public function getAsetRusakNonBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','rusak')
        ->where('unit.status','non_bergerak')
        ->findAll();
    }

     public function getAsetBaik()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','baik')
        ->findAll();
    }

    public function getAsetBaikBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','baik')
        ->where('unit.status','bergerak')
        ->findAll();
    }
    
    
    public function getAsetBaikNonBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, 
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('aset.status','baik')
        ->where('unit.status','non_bergerak')
        ->findAll();
    }

    public function getAsetNonBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, penempatan.alamat,
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('unit.status','non_bergerak')
        ->findAll();
    }

    public function getAsetBergerak()
    {
        return $this->select('aset.*, unit.nama_barang, unit.kode_barang, unit.status AS jenis,
            penempatan.lokasi AS penempatan, penempatan.alamat,
            IF(aset.id_karyawan = 0, aset.penanggung_jawab, (SELECT nama FROM karyawan WHERE karyawan.id = aset.id_karyawan)) AS penanggung_jawab')
        ->join('unit', 'unit.id = aset.id_unit', 'left') // Join dengan tabel unit
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Join dengan tabel penempatan
        ->where('unit.status','bergerak')
        ->findAll();
    }
   
   
}
