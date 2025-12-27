<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Check if user is authenticated
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->has('user_id')) {
            return redirect()->to('login')->with('error', 'Silahkan login terlebih dahulu');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
