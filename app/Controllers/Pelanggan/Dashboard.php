<?php

namespace App\Controllers\Pelanggan;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Display pelanggan (customer) dashboard
     */
    public function index()
    {
        $data = [
            'title' => 'Pelanggan Dashboard',
            'user_name' => $this->session->get('user_name'),
        ];

        return view('pelanggan/dashboard', $data);
    }
}
