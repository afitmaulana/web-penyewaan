<?php

namespace App\Controllers;

/**
 * CLASS Dashboard
 * Controller untuk halaman dashboard (user sudah login)
 * 
 * Methods:
 * - index() : Halaman dashboard utama
 */
class Dashboard extends BaseController
{
    /**
     * METHOD: index()
     * Menampilkan halaman dashboard
     * Di sini user bisa melihat ringkasan pesanan, dll
     * 
     * @return string
     */
    public function index(): string
    {
        $data = [
            'title' => 'Dashboard'
        ];
        
        return view('pages/dashboard/index', $data);
    }
}
