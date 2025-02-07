<?php

namespace App\Models;

use CodeIgniter\Model;

class RekomendasiModel extends Model
{
    protected $table            = 'rekomendasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields    = [
        'nomor_surat',
        'instansi_tujuan',
        'id_aset',
        'tanggal_pemeriksaan',
        'deskripsi_kerusakan',
        'tgl_surat',
        'dibuat',
        'diverifikasi',
        'disetujui',
        'file',
        'status_verifikasi',
        'status_persetujuan'
    ];


    public function getRekomendasi()
    {
        return $this->select('
        rekomendasi.*, 
        aset.merk, 
        unit.nama_barang, unit.kode_barang,
        (SELECT nama FROM karyawan WHERE karyawan.id = rekomendasi.dibuat) AS dibuat,
        (SELECT nama FROM karyawan WHERE karyawan.id = rekomendasi.diverifikasi) AS diverifikasi,
        (SELECT nama FROM karyawan WHERE karyawan.id = rekomendasi.disetujui) AS disetujui
    ')
    ->join('aset', 'aset.id = rekomendasi.id_aset')
    ->join('unit', 'unit.id = aset.id_unit')
    ->where('aset.status','rusak')
    ->findAll();
    }

    public function getRekomendasiByID($id)
    {
        return $this->select('
            rekomendasi.*, 
            aset.merk, 
            unit.nama_barang, unit.kode_barang,
            penempatan.lokasi
        ')
        ->join('aset', 'aset.id = rekomendasi.id_aset')
        ->join('unit', 'unit.id = aset.id_unit')
        ->join('penempatan', 'penempatan.id = aset.id_penempatan', 'left') // Tambahkan join ke penempatan
        ->where('rekomendasi.id', $id)
        ->first();
    }
    
}
