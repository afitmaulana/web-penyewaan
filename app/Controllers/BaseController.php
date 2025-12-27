<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * CLASS BaseController
 * 
 * Base class untuk semua controller di aplikasi ini.
 * Gunakan untuk:
 * - Mendefinisikan helper yang digunakan di semua halaman
 * - Menginisialisasi session, database, library bersama
 * - Method utility yang digunakan di banyak controller
 *
 * Semua controller HARUS extend class ini:
 *     class Home extends BaseController
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Helper yang dimuat otomatis untuk semua controller yang extends BaseController.
     * Helper ini bisa digunakan di view tanpa perlu load manual.
     *
     * @var array
     */
    protected $helpers = ['url', 'form'];

    /**
     * Instance Session untuk mengakses session data
     */
    protected $session;

    /**
     * INITCONTROLLER
     * Dipanggil saat controller diinstansiasi
     * Gunakan untuk initialize session, library, dll
     * 
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Jangan ubah baris ini
        parent::initController($request, $response, $logger);

        // ===== INITIALIZE SESSION =====
        // Session berguna untuk menyimpan data user (login, notifikasi, dll)
        $this->session = \Config\Services::session();
    }

    /**
     * METHOD: setData
     * Helper method untuk set data yang akan dikirim ke view
     * 
     * @param array $data Data yang akan dikirim ke view
     * @return array
     */
    protected function setData($data = [])
    {
        return $data;
    }
}
