<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AsetModel;
use App\Models\KaryawanModel;
use App\Models\BaKerusakanModel;

class BaKerusakanController extends BaseController
{
    protected $asetModel;
    protected $karyawanModel;
    protected $baKerusakanModel;
    public function __construct()
    {
        $this->asetModel = new AsetModel();
        $this->karyawanModel = new KaryawanModel();
        $this->baKerusakanModel = new BaKerusakanModel();
    }

    public function index()
    {
        $data['bakerusakan'] = $this->baKerusakanModel->getDataBA();
        return view('bakerusakan/index', $data);
    }

    public function create()
    {
        $data = [
            'karyawan' => $this->karyawanModel->findAll(),
            'aset' => $this->asetModel
                ->select('aset.id, aset.merk, unit.kode_barang')
                ->join('unit', 'unit.id = aset.id_unit')
                ->findAll(),
        ];
        return view('bakerusakan/create', $data);
    }

    public function store()
    {
        // Validasi data
        $validationRules = [
            'id_aset' => 'required',
            'tanggal' => 'required',
            'diajukan' => 'required',
            'diketahui' => 'required',
            'disetujui' => 'required',
            'lampiran' => 'uploaded[lampiran]|mime_in[lampiran,image/jpeg,image/png]|max_size[lampiran,1024]'

        ];


        // Jalankan validasi
        if (!$this->validate($validationRules)) {
            // Jika validasi gagal, kembalikan ke halaman create dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Inisialisasi $namaFile dengan null
        $namaFile = null;
        $file = $this->request->getFile('lampiran');

        // Pastikan file berhasil diunggah
        if ($file->isValid() && !$file->hasMoved()) {
            // Generate nama unik untuk file
            $namaFile = $file->getRandomName();

            // Pindahkan file ke folder yang diinginkan
            $file->move(ROOTPATH . 'public/uploads/lampiran', $namaFile);
        } else {
            // Jika file gagal diunggah, tampilkan pesan error
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }
        // Data untuk disimpan ke database
        $data = [
            'id_aset' => $this->request->getPost('id_aset'),
            'tanggal' => $this->request->getPost('tanggal'),
            'diajukan' => $this->request->getPost('diajukan'),
            'diketahui' => $this->request->getPost('diketahui'),
            'disetujui' => $this->request->getPost('disetujui'),
        ];

        // Jika file diunggah, tambahkan atribut file ke data yang akan disimpan
        if ($namaFile !== null) {
            $data['lampiran'] = $namaFile;
        }

        // Simpan data ke database
        $this->baKerusakanModel->insert($data);
        return redirect()->to('/bakerusakan');
    }


    public function edit($id)
    {
        $data = [
            'karyawan' => $this->karyawanModel->findAll(),
            'aset' => $this->asetModel
                ->select('aset.id, aset.merk, unit.kode_barang')
                ->join('unit', 'unit.id = aset.id_unit')
                ->findAll(),
            'bakerusakan' => $this->baKerusakanModel->find($id)
        ];

        return view('bakerusakan/edit', $data);
    }

    public function update($id)
    {
        $bakerusakan = $this->baKerusakanModel->find($id);
        $file = $this->request->getFile('lampiran');
        $data = [
            'id_aset' => $this->request->getPost('id_aset'),
            'tanggal' => $this->request->getPost('tanggal'),
            'diajukan' => $this->request->getPost('diajukan'),
            'diketahui' => $this->request->getPost('diketahui'),
            'disetujui' => $this->request->getPost('disetujui'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($bakerusakan['lampiran'])) {
                $oldFilePath = ROOTPATH . 'public/uploads/lampiran/' .  $bakerusakan['lampiran'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Simpan file baru
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/lampiran', $newName);
            $data['lampiran'] = $newName; // Tambahkan nama file ke data
        }

        $this->baKerusakanModel->update($id, $data);

        return redirect()->to('/bakerusakan')->with('success', 'Data berhasil diperbarui.');
    }


    public function delete($id)
    {
        // Ambil data karyawan berdasarkan ID
        $bakerusakan = $this->baKerusakanModel->find($id);

        // Pastikan data aset ditemukan
        if ($bakerusakan) {
            // Hapus file dari folder uploads jika ada
            if ($bakerusakan['lampiran']) {
                $filePath = ROOTPATH . 'public/uploads/lampiran/' . $bakerusakan['lampiran'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }

            // Hapus data bake$bakerusakan dari database
            $this->baKerusakanModel->delete($id);
        }

        // Redirect ke halaman aset setelah berhasil dihapus
        return redirect()->to('/bakerusakan');
    }

    public function cetak($id)
    {
        $bakerusakan = $this->baKerusakanModel->find($id);
        $aset = $this->asetModel->getAsetbyID($bakerusakan['id_aset']);
        $diajukan = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $bakerusakan['diajukan'])
            ->first();

        $diketahui = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $bakerusakan['diketahui'])
            ->first();

        $disetujui = $this->karyawanModel
            ->select('nama, nip')
            ->where('id', $bakerusakan['disetujui'])
            ->first();

        $data = [
            'bakerusakan' => $bakerusakan,
            'aset'  => $aset,
            'diajukan'  => $diajukan,
            'diketahui'  => $diketahui,
            'disetujui'  => $disetujui,
        ];

        return view('cetak/bakerusakan', $data);
    }

    public function setujuikadep()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->baKerusakanModel->update($id, ['status_verifikasi' => 'disetujui']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function tolakkadep()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->baKerusakanModel->update($id, ['status_verifikasi' => 'ditolak']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function setujuikadis()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->baKerusakanModel->update($id, ['status_persetujuan' => 'disetujui']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }

    public function tolakkadis()
    {
        $id = $this->request->getPost('id');
        if ($id) {
            $this->baKerusakanModel->update($id, ['status_persetujuan' => 'ditolak']);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false]);
    }
}
