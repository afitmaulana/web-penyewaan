<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Show login form
     */
    public function login()
    {
        // If already logged in, redirect based on role
        if ($this->session->has('user_id')) {
            return redirect()->to($this->getRedirectUrl());
        }

        return view('auth/login');
    }

    /**
     * Process login
     */
    public function processLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', [
                'validation' => $this->validation
            ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find user by email
        $user = $this->userModel->findActiveByEmail($email);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password tidak valid');
        }

        // Verify password
        if (!UserModel::verifyPassword($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email atau password tidak valid');
        }

        // Set session
        $this->session->set([
            'user_id'      => $user['id'],
            'user_name'    => $user['nama_lengkap'],
            'user_email'   => $user['email'],
            'role'         => $user['role']
        ]);

        // Update last login
        $this->userModel->updateLastLogin($user['id']);

        // Set success message
        $this->session->setFlashdata('success', 'Selamat datang ' . $user['nama_lengkap']);

        // Redirect based on role
        return redirect()->to($this->getRedirectUrl());
    }

    /**
     * Show register form (pelanggan only)
     */
    public function register()
    {
        // If already logged in, redirect based on role
        if ($this->session->has('user_id')) {
            return redirect()->to($this->getRedirectUrl());
        }

        return view('auth/register');
    }

    /**
     * Process registration
     */
    public function processRegister()
    {
        $rules = [
            'nama_lengkap'     => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'nomor_hp'         => 'required|min_length[10]|max_length[15]',
            'alamat'           => 'required|min_length[10]',
            'kota'             => 'required|min_length[3]',
            'provinsi'         => 'required|min_length[3]',
            'kode_pos'         => 'required|min_length[5]|max_length[10]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validation
            ]);
        }

        // Prepare data
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'nomor_hp'     => $this->request->getPost('nomor_hp'),
            'alamat'       => $this->request->getPost('alamat'),
            'kota'         => $this->request->getPost('kota'),
            'provinsi'     => $this->request->getPost('provinsi'),
            'kode_pos'     => $this->request->getPost('kode_pos'),
            'password'     => $this->request->getPost('password'),
        ];

        // Register user
        if ($this->userModel->register($data)) {
            $this->session->setFlashdata('success', 'Pendaftaran berhasil. Silahkan login.');
            return redirect()->to('login');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Pendaftaran gagal. Silahkan coba lagi.');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login')->with('success', 'Anda telah logout');
    }

    /**
     * Get redirect URL based on user role
     */
    private function getRedirectUrl()
    {
        $role = $this->session->get('role');
        
        if ($role === 'admin') {
            return 'admin/dashboard';
        } else {
            return 'pelanggan/dashboard';
        }
    }
}
