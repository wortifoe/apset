<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DepartemenModel;
class DepartemenController extends BaseController
{
    protected $departemenModel;

    public function __construct()
    {
        $this->departemenModel = new DepartemenModel();
    }

    public function index()
    {
        $data['departemen'] = $this->departemenModel->findAll();
        return view('departemen/index', $data);
    }

    public function create()
    {
        return view('departemen/create');
    }

    public function store()
    {
        $data = [
            'kode_departemen' => $this->request->getPost('kode_departemen'),
            'nama' => $this->request->getPost('nama'),
            'kepala_departemen' => $this->request->getPost('kepala_departemen'),
            
        ];

        $this->departemenModel->insert($data);

        return redirect()->to('/departemen');
    }

    public function edit($id)
    {
        $departemen = $this->departemenModel->find($id);

        $data = [
            'departemen' => $departemen
        ];

        return view('departemen/edit',$data);
    }

    public function update($id)
    {
        $departemen = $this->departemenModel->find($id);
        if (!$departemen) {
            return redirect()->to('/departemen')->with('error', 'departemen not found');
        }

        $data = [
            'kode_departemen' => $this->request->getPost('kode_departemen'),
            'nama' => $this->request->getPost('nama'),
            'kepala_departemen' => $this->request->getPost('kepala_departemen'),
            
        ];

        $this->departemenModel->update($id, $data);

        return redirect()->to('/departemen');
    }


    public function delete($id)
    {
        $departemen = $this->departemenModel->find($id);

        if (!$departemen) {
            return redirect()->to('/departemen')->with('error', 'departemen not found');
        }

        $this->departemenModel->delete($id);

        session()->setFlashdata('success', 'departemen deleted successfully');

        return redirect()->to('/departemen');
    }
}
