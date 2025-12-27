<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PelangganFilter implements FilterInterface
{
    /**
     * Check if user is pelanggan (customer)
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Check if user is authenticated
        if (!$session->has('user_id')) {
            return redirect()->to('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        // Check if user has pelanggan role
        if ($session->get('role') !== 'pelanggan') {
            return redirect()->to('admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
