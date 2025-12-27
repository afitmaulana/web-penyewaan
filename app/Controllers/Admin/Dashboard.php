<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'user_name' => $this->session->get('user_name'),
        ];

        return view('admin/dashboard', $data);
    }
}
