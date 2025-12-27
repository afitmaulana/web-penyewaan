<?php

namespace App\Controllers;

/**
 * CLASS Home
 * Controller untuk halaman publik (belum login)
 * 
 * Methods:
 * - index()    : Halaman utama/homepage
 * - login()    : Halaman form login
 * - register() : Halaman form register
 */
class Home extends BaseController
{
    /**
     * METHOD: index()
     * Menampilkan halaman utama / homepage
     * 
     * @return string
     */
    public function index(): string
    {
        $data = [
            'title' => 'Home'
        ];
        
        return view('pages/home', $data);
    }

    /**
     * METHOD: login()
     * Menampilkan halaman form login
     * 
     * @return string
     */
    public function login(): string
    {
        $data = [
            'title' => 'Login'
        ];
        
        return view('pages/auth/login', $data);
    }

    /**
     * METHOD: register()
     * Menampilkan halaman form register
     * 
     * @return string
     */
    public function register(): string
    {
        $data = [
            'title' => 'Daftar Akun Baru'
        ];
        
        return view('pages/auth/register', $data);
    }
}

