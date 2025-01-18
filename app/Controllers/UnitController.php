<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UnitModel;
class UnitController extends BaseController
{
    protected $unitModel;

    public function __construct()
    {
        $this->unitModel = new UnitModel();
    }

    public function index()
    {
        $data['unit'] = $this->unitModel->findAll();
        return view('unit/index', $data);
    }

    public function create()
    {
        return view('unit/create');
    }

    public function store()
    {
        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan'),
            'status' => $this->request->getPost('status'),
            
        ];

        $this->unitModel->insert($data);

        return redirect()->to('/unit');
    }

    public function edit($id)
    {
        $unit = $this->unitModel->find($id);

        $data = [
            'unit' => $unit
        ];

        return view('unit/edit',$data);
    }

    public function update($id)
    {
        $unit = $this->unitModel->find($id);
        if (!$unit) {
            return redirect()->to('/unit')->with('error', 'unit not found');
        }

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan'),
            'status' => $this->request->getPost('status'),
            
        ];

        $this->unitModel->update($id, $data);

        return redirect()->to('/unit');
    }


    public function delete($id)
    {
        $unit = $this->unitModel->find($id);

        if (!$unit) {
            return redirect()->to('/unit')->with('error', 'unit not found');
        }

        $this->unitModel->delete($id);

        session()->setFlashdata('success', 'unit deleted successfully');

        return redirect()->to('/unit');
    }
}
