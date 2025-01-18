<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['user'] = $this->userModel->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level_user' => $this->request->getPost('level_user'),
            
        ];

        $this->userModel->insert($data);

        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        $data = [
            'user' => $user
        ];

        return view('user/edit',$data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found');
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'level_user' => $this->request->getPost('level_user'),
            'email' => $this->request->getPost('email'),
        ];

        $this->userModel->update($id, $data);

        return redirect()->to('/user');
    }


    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found');
        }

        $this->userModel->delete($id);

        session()->setFlashdata('success', 'User deleted successfully');

        return redirect()->to('/user');
    }
}
