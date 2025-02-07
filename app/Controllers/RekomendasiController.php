<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KaryawanModel;
use App\Models\AsetModel;
use App\Models\RekomendasiModel;

class RekomendasiController extends BaseController
{
    protected $asetModel;
    protected $karyawanModel;
    protected $rekomendasiModel;
    public function __construct()
    {
        $this->asetModel = new AsetModel();
        $this->karyawanModel = new KaryawanModel();
        $this->rekomendasiModel = new RekomendasiModel();
    }

    public function index()
    {
        $data['rekomendasi'] = $this->rekomendasiModel->getRekomendasi();
        return view('rekomendasi/index', $data);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->karyawanModel->findAll(),
            'aset' => $this->asetModel
                ->select('aset.id, aset.merk, unit.kode_barang')
                ->join('unit', 'unit.id = aset.id_unit')
                ->where('aset.status', 'rusak')
                ->findAll(),
        ];
        return view('rekomendasi/create', $data);
    }

    public function store()
    {
        // Validasi data
        $validationRules = [
            'nomor_surat'  => 'required',
            'instansi_tujuan' => 'required',
            'id_aset' => 'required',
            'tanggal_pemeriksaan' => 'required',
            'deskripsi_kerusakan' => 'required',
            'tgl_surat' => 'required',
            'dibuat' => 'required',
            'diverifikasi' => 'required',
            'disetujui' => 'required',
            'file' => 'uploaded[file]|mime_in[file,image/jpeg,image/png]|max_size[file,1024]',

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
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'instansi_tujuan' => $this->request->getPost('instansi_tujuan'),
            'id_aset' => $this->request->getPost('id_aset'),
            'tanggal_pemeriksaan' => $this->request->getPost('tanggal_pemeriksaan'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'tgl_surat' => $this->request->getPost('tgl_surat'),
            'dibuat' => $this->request->getPost('dibuat'),
            'diverifikasi' => $this->request->getPost('diverifikasi'),
            'disetujui' => $this->request->getPost('disetujui'),
        ];

        // Jika file diunggah, tambahkan atribut file ke data yang akan disimpan
        if ($namaFile !== null) {
            $data['file'] = $namaFile;
        }

        // Simpan data ke database
        $this->rekomendasiModel->insert($data);
        return redirect()->to('/rekomendasi');
    }


    public function edit($id)
    {
        $data = [
            'karyawan' => $this->karyawanModel->findAll(),
            'aset' => $this->asetModel
                ->select('aset.id, aset.merk, unit.kode_barang')
                ->join('unit', 'unit.id = aset.id_unit')
                ->where('aset.status', 'rusak')
                ->findAll(),
            'rekomendasi' =>$this->rekomendasiModel->find($id)
        ];

        return view('rekomendasi/edit', $data);
    }

    public function update($id)
    {
        $rekomendasi = $this->rekomendasiModel->find($id);
        $file = $this->request->getFile('file');
        $data = [
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'instansi_tujuan' => $this->request->getPost('instansi_tujuan'),
            'id_aset' => $this->request->getPost('id_aset'),
            'tanggal_pemeriksaan' => $this->request->getPost('tanggal_pemeriksaan'),
            'deskripsi_kerusakan' => $this->request->getPost('deskripsi_kerusakan'),
            'tgl_surat' => $this->request->getPost('tgl_surat'),
            'dibuat' => $this->request->getPost('dibuat'),
            'diverifikasi' => $this->request->getPost('diverifikasi'),
            'disetujui' => $this->request->getPost('disetujui'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($rekomendasi['file'])) {
                $oldFilePath = ROOTPATH . 'public/uploads/file/' .  $rekomendasi['file'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan file baru
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/file', $newName);
            $data['file'] = $newName; // Tambahkan nama file ke data
        }

        $this->rekomendasiModel->update($id, $data);

        return redirect()->to('/rekomendasi')->with('success', 'Data berhasil diperbarui.');
    }


    public function delete($id)
    {
        // Ambil data karyawan berdasarkan ID
        $rekomendasi = $this->rekomendasiModel->find($id);

        // Pastikan data aset ditemukan
        if ($rekomendasi) {
            // Hapus file dari folder uploads jika ada
            if ($rekomendasi['file']) {
                $filePath = ROOTPATH . 'public/uploads/file/' . $rekomendasi['file'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }

            // Hapus data bake$rekomendasi dari database
            $this->rekomendasiModel->delete($id);
        }

        // Redirect ke halaman aset setelah berhasil dihapus
        return redirect()->to('/rekomendasi');
    }

    public function cetak($id)
    {
        $rekomendasi = $this->rekomendasiModel->getRekomendasiByID($id);
        $dibuat = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $rekomendasi['dibuat'])
            ->first();

        $diverifikasi = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $rekomendasi['diverifikasi'])
            ->first();

        $disetujui = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $rekomendasi['disetujui'])
            ->first();

        $data = [
            'rekomendasi' => $rekomendasi,
            'dibuat'  => $dibuat,
            'diverifikasi'  => $diverifikasi,
            'disetujui'  => $disetujui,
        ];

        return view('cetak/rekomendasi', $data);
    }

    public function setujuikadep()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->rekomendasiModel->update($id, ['status_verifikasi' => 'disetujui']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function tolakkadep()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->rekomendasiModel->update($id, ['status_verifikasi' => 'ditolak']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function setujuikadis()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->rekomendasiModel->update($id, ['status_persetujuan' => 'disetujui']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function tolakkadis()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->rekomendasiModel->update($id, ['status_persetujuan' => 'ditolak']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }
}
