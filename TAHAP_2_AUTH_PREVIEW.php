<?php
/**
 * AUTH CONTROLLER - PLACEHOLDER FOR TAHAP 2
 * 
 * File ini adalah placeholder/contoh struktur
 * Akan diimplementasikan secara penuh di Tahap 2
 * 
 * CATATAN: File ini hanya untuk referensi!
 * Jangan jalankan atau uncomment code di sini
 */

/*

// ============================================================================
// TAHAP 2 IMPLEMENTATION - AUTH CONTROLLER
// ============================================================================
// 
// File: app/Controllers/Auth.php
// Fungsi: Handle login & registration processing
//
// Methods yang akan dibuat:
// - login()              → Tampilkan form login
// - processLogin()       → Proses login (POST)
// - register()           → Tampilkan form register
// - processRegister()    → Proses register (POST)
// - logout()             → Logout user
// - verifyEmail()        → Verifikasi email
//

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Validation\Validation;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        // Initialize model
        $this->userModel = new UserModel();
    }

    // ====================================================================
    // LOGIN
    // ====================================================================

    /**
     * METHOD: login()
     * Tampilkan halaman form login
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = ['title' => 'Login'];
        return view('pages/auth/login', $data);
    }

    /**
     * METHOD: processLogin()
     * Handle form submission login (POST)
     * - Validate email & password
     * - Check di database
     * - Set session
     * - Redirect ke dashboard
     */
    public function processLogin()
    {
        // Validate input
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get input
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Find user by email
        $user = $this->userModel->where('email', $email)->first();

        // Check if user exists and password correct
        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Email atau password salah!');
        }

        // Check if email verified
        if (!$user['email_verified']) {
            return redirect()->back()->with('warning', 'Silakan verifikasi email Anda terlebih dahulu!');
        }

        // Set session
        $this->session->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'user_email' => $user['email'],
            'logged_in' => true
        ]);

        // Log audit
        // $this->auditLog('login', 'User', $user['id']);

        return redirect()->to(base_url('dashboard'))->with('success', 'Selamat datang, ' . $user['name'] . '!');
    }

    // ====================================================================
    // REGISTER
    // ====================================================================

    /**
     * METHOD: register()
     * Tampilkan halaman form register
     */
    public function register()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = ['title' => 'Daftar Akun Baru'];
        return view('pages/auth/register', $data);
    }

    /**
     * METHOD: processRegister()
     * Handle form submission register (POST)
     * - Validate input
     * - Check email already exists
     * - Hash password
     * - Save ke database
     * - Send verification email
     * - Redirect ke login dengan pesan
     */
    public function processRegister()
    {
        // Validate input
        if (!$this->validate([
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|min_length[10]|max_length[20]',
            'address' => 'required|min_length[10]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'agree' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get input
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'city' => 'TBD', // Akan ditambahkan nanti
            'province' => 'TBD',
            'postal_code' => 'TBD',
            'is_active' => true,
            'email_verified' => false
        ];

        // Insert ke database
        if ($this->userModel->insert($data)) {
            // TODO: Send verification email
            // $this->sendVerificationEmail($data['email']);

            return redirect()->to(base_url('login'))
                ->with('success', 'Registrasi berhasil! Silakan check email untuk verifikasi akun.');
        } else {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi!');
        }
    }

    // ====================================================================
    // LOGOUT
    // ====================================================================

    /**
     * METHOD: logout()
     * Logout user & destroy session
     */
    public function logout()
    {
        // Destroy session
        $this->session->destroy();

        return redirect()->to(base_url('login'))->with('success', 'Anda berhasil logout!');
    }

    // ====================================================================
    // EMAIL VERIFICATION
    // ====================================================================

    /**
     * METHOD: verifyEmail()
     * Verify email user saat klik link di email
     * 
     * @param string $token - Verification token
     */
    public function verifyEmail($token = null)
    {
        // TODO: Implement email verification
        // - Find user dengan token
        // - Update email_verified = true
        // - Delete token
        // - Show success message
    }
}

// ============================================================================
// ROUTES YANG AKAN DITAMBAHKAN DI TAHAP 2
// ============================================================================

/*
// app/Config/Routes.php

// Authentication routes
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Auth public
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::processLogin');
    
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::processRegister');
    
    $routes->get('verify-email/(:any)', 'Auth::verifyEmail/$1', ['as' => 'verify.email']);
    
    // Auth protected
    $routes->post('logout', 'Auth::logout', ['filter' => 'auth', 'as' => 'logout']);
});
*/

// ============================================================================
// DATABASE TABLE - TAHAP 2
// ============================================================================

/*
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    province VARCHAR(50) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    is_active BOOLEAN DEFAULT true,
    email_verified BOOLEAN DEFAULT false,
    email_verified_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
*/

// ============================================================================
// USER MODEL - TAHAP 2
// ============================================================================

/*
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'is_active',
        'email_verified',
        'email_verified_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'phone' => 'required|min_length[10]',
        'address' => 'required'
    ];
}
*/

// ============================================================================
// FILTER AUTH - TAHAP 2
// ============================================================================

/*
// app/Filters/AuthFilter.php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('user_id')) {
            return redirect()->to(base_url('login'))->with('warning', 'Silakan login terlebih dahulu!');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
*/

// ============================================================================
// ENVIRONMENT CONFIG - TAHAP 2
// ============================================================================

/*
# Di .env, tambahkan email configuration untuk verification:

# Email service configuration
email.protocol = smtp
email.SMTPHost = smtp.gmail.com
email.SMTPUser = your-email@gmail.com
email.SMTPPass = your-app-password
email.SMTPPort = 587
email.SMTPCrypto = tls
email.mailType = html
email.charset = utf-8
email.fromEmail = noreply@rentalkostum.com
email.fromName = Rental Kostum
*/

?>
