<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenempatanModel;
use CodeIgniter\HTTP\ResponseInterface;

class PenempatanController extends BaseController
{
    protected $penempatanModel;

    public function __construct()
    {
        $this->penempatanModel = new PenempatanModel();
    }

    public function index()
    {
        $data['penempatan'] = $this->penempatanModel->findAll();
        return view('penempatan/index', $data);
    }

    public function create()
    {
        return view('penempatan/create');
    }

    public function store()
    {
        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $this->penempatanModel->insert($data);

        return redirect()->to('/penempatan');
    }

    public function edit($id)
    {
        $penempatan = $this->penempatanModel->find($id);

        $data = [
            'penempatan' => $penempatan
        ];

        return view('penempatan/edit',$data);
    }

    public function update($id)
    {
        $penempatan = $this->penempatanModel->find($id);
        if (!$penempatan) {
            return redirect()->to('/penempatan')->with('error', 'penempatan not found');
        }

        $data = [
            'lokasi' => $this->request->getPost('lokasi'),
            'alamat' => $this->request->getPost('alamat'),
        ];


        $this->penempatanModel->update($id, $data);

        return redirect()->to('/penempatan');
    }


    public function delete($id)
    {
        $penempatan = $this->penempatanModel->find($id);

        if (!$penempatan) {
            return redirect()->to('/penempatan')->with('error', 'penempatan not found');
        }

        $this->penempatanModel->delete($id);

        session()->setFlashdata('success', 'penempatan deleted successfully');

        return redirect()->to('/penempatan');
    }
}
