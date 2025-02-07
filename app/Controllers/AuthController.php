<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    // Menampilkan halaman login
    public function index()
    {
        $title = 'Login Pengguna';
        return view('auth/login', compact('title'));
    }

    public function login()
    {
        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
            // 'tahun' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $userData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'level_user' => $user['level_user'],
                'logged_in' => TRUE
            ];

            session()->set($userData);
            // dd($userData);
            if ($user['level_user'] == 1) {
                return redirect()->to('/user'); // Redirect ke halaman user jika level_user = 1 (Admin)
            } else {
                return redirect()->to('/aset'); // Redirect ke halaman aset jika level_user ≠ 1 (Kadep/Kadis)
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
        }
    }


    // Logout
    public function logout()
    {
        // Clear all session data
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/');
    }
}
