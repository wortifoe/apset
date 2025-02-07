<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AsetModel;
use App\Models\UnitModel;
use App\Models\KaryawanModel;
use App\Models\PenempatanModel;
class AsetController extends BaseController
{
    protected $unitModel;
    protected $asetModel;
    protected $karyawanModel;
    protected $penempatanModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
        $this->asetModel = new AsetModel();
        $this->karyawanModel = new KaryawanModel();
        $this->penempatanModel = new PenempatanModel();
    }

    public function index()
    {
        $data['aset'] = $this->asetModel->getAset();
        return view('aset/index', $data);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->karyawanModel->findAll(),
            'unit' => $this->unitModel->findAll(),
            'penempatan' => $this->penempatanModel->findAll(),
        ];
        return view('aset/create', $data);
    }

    public function store()
    {
        // Validasi data
        $validationRules = [
            'id_unit' => 'required',
            'merk' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'id_penempatan' => 'required',
            'keterangan' => 'required',
            'file' => 'uploaded[file]|mime_in[file,image/jpeg,image/png]|max_size[file,1024]'
        ];


        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Inisialisasi $namaFile dengan null
        $namaFile = null;
        $file = $this->request->getFile('file');

        // Pastikan file berhasil diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            // Generate nama unik untuk file
            $namaFile = $file->getRandomName();

            // Pindahkan file ke folder yang diinginkan
            $file->move(ROOTPATH . 'public/uploads/file', $namaFile);
        } else {
            // Jika file gagal diunggah, tampilkan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }
        // Data untuk disimpan ke database
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'merk' => $this->request->getPost('merk'),
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status'),
            'id_penempatan' => $this->request->getPost('id_penempatan'),
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        // Jika file diunggah, tambahkan atribut file ke data yang akan disimpan
        if ($namaFile !== null) {
            $data['file'] = $namaFile;
        }

        // Simpan data ke database
        $this->asetModel->insert($data);
        return redirect()->to('/aset');
    }
    public function edit($id)
    {
        $unit = $this->unitModel->findAll();
        $aset = $this->asetModel->find($id);
        $karyawan = $this->karyawanModel->findAll();
        $penempatan = $this->penempatanModel->findAll();
        $data = [
            'unit' => $unit,
            'aset' => $aset,
            'karyawan' => $karyawan,
            'penempatan' => $penempatan
        ];

        return view('aset/edit', $data);
    }

    public function update($id)
    {
        $aset = $this->asetModel->find($id);
        $file = $this->request->getFile('file');
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'merk' => $this->request->getPost('merk'),
            'jumlah' => $this->request->getPost('jumlah'),
            'status' => $this->request->getPost('status'),
            'id_penempatan' => $this->request->getPost('id_penempatan'),
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
    
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($aset['file'])) {
                $oldFilePath = ROOTPATH . 'public/uploads/file/' . $aset['file'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
    
            // Simpan file baru
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/file', $newName);
            $data['file'] = $newName; // Tambahkan nama file ke data
        }
    
        $this->asetModel->update($id, $data);
    
        return redirect()->to('/aset')->with('success', 'Data berhasil diperbarui.');
    }
    

    public function delete($id)
    {
        // Ambil data karyawan berdasarkan ID
        $aset = $this->asetModel->find($id);

        // Pastikan data aset ditemukan
        if ($aset) {
            // Hapus file dari folder uploads jika ada
            if ($aset['file']) {
                $filePath = ROOTPATH . 'public/uploads/file/' . $aset['file'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }

            // Hapus data aset dari database
            $this->asetModel->delete($id);
        }

        // Redirect ke halaman aset setelah berhasil dihapus
        return redirect()->to('/aset');
    }

    public function barangrusak()
    {
        $data['aset'] = $this->asetModel->getAsetRusak();
        return view('laporan/barangrusak', $data);
    }

    public function cetakrusak()
    {
        $jenis = $this->request->getGet('jenis'); // Ambil parameter 'jenis' dari URL

        // Ambil data sesuai dengan jenis aset
        if ($jenis == 'bergerak') {
            $data['aset'] = $this->asetModel->getAsetRusakBergerak();
        } elseif ($jenis == 'non_bergerak') {
            $data['aset'] = $this->asetModel->getAsetRusakNonBergerak();
        } else { // Default: cetak semua data
            $data['aset'] = $this->asetModel->getAsetRusak();;
        }

        return view('cetak/rusak', $data);
    }

    public function layakpakai()
    {
        $data['aset'] = $this->asetModel->getAsetBaik();
        return view('laporan/baranglayak', $data);
    }

    public function cetaklayak()
    {
        $jenis = $this->request->getGet('jenis'); // Ambil parameter 'jenis' dari URL

        // Ambil data sesuai dengan jenis aset
        if ($jenis == 'bergerak') {
            $data['aset'] = $this->asetModel->getAsetBaikBergerak();
        } elseif ($jenis == 'non_bergerak') {
            $data['aset'] = $this->asetModel->getAsetBaikNonBergerak();
        } else { // Default: cetak semua data
            $data['aset'] = $this->asetModel->getAsetBaik();;
        }

        return view('cetak/layakpakai', $data);
    }

    public function penempatan()
    {
        $data['aset'] = $this->asetModel->getAset();
        return view('laporan/penempatan', $data);
    }

    public function cetakpenempatan()
    {
        $jenis = $this->request->getGet('jenis'); // Ambil parameter 'jenis' dari URL

        // Ambil data sesuai dengan jenis aset
        if ($jenis == 'bergerak') {
            $data['aset'] = $this->asetModel->getAsetBergerak();
        } elseif ($jenis == 'non_bergerak') {
            $data['aset'] = $this->asetModel->getAsetNonBergerak();
        } else { // Default: cetak semua data
            $data['aset'] = $this->asetModel->getAset();;
        }

        return view('cetak/penempatan', $data);
    }
}
