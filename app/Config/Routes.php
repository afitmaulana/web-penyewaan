<?php

use CodeIgniter\Router\RouteCollection;

/**
 * ROUTES.PHP
 * File untuk mengatur rute/URL aplikasi
 * 
 * @var RouteCollection $routes
 */

// ============================================================================
// ROUTING HALAMAN PUBLIK (BELUM LOGIN)
// ============================================================================

// Halaman utama / homepage
$routes->get('/', 'Home::index', ['as' => 'home']);

// Halaman login
$routes->get('login', 'Auth::login', ['as' => 'login']);
$routes->post('login', 'Auth::processLogin');

// Halaman register / daftar akun baru
$routes->get('register', 'Auth::register', ['as' => 'register']);
$routes->post('register', 'Auth::processRegister');

// Logout
$routes->post('logout', 'Auth::logout', ['as' => 'logout']);

// ============================================================================
// ROUTING ADMIN DASHBOARD (ADMIN ONLY)
// ============================================================================
$routes->group('admin', ['filter' => 'adminFilter'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index', ['as' => 'admin_dashboard']);
    
    // CRUD KATEGORI
    $routes->get('kategori', 'Admin\KategoriController::index', ['as' => 'kategori_index']);
    $routes->get('kategori/create', 'Admin\KategoriController::create', ['as' => 'kategori_create']);
    $routes->post('kategori', 'Admin\KategoriController::store', ['as' => 'kategori_store']);
    $routes->get('kategori/(:num)/edit', 'Admin\KategoriController::edit/$1', ['as' => 'kategori_edit']);
    $routes->post('kategori/(:num)', 'Admin\KategoriController::update/$1', ['as' => 'kategori_update']);
    $routes->delete('kategori/(:num)', 'Admin\KategoriController::delete/$1', ['as' => 'kategori_delete']);
    
    // CRUD KOSTUM
    $routes->get('kostum', 'Admin\KostumController::index', ['as' => 'kostum_index']);
    $routes->get('kostum/create', 'Admin\KostumController::create', ['as' => 'kostum_create']);
    $routes->post('kostum', 'Admin\KostumController::store', ['as' => 'kostum_store']);
    $routes->get('kostum/(:num)/edit', 'Admin\KostumController::edit/$1', ['as' => 'kostum_edit']);
    $routes->post('kostum/(:num)', 'Admin\KostumController::update/$1', ['as' => 'kostum_update']);
    $routes->delete('kostum/(:num)', 'Admin\KostumController::delete/$1', ['as' => 'kostum_delete']);
});

// ============================================================================
// ROUTING PELANGGAN DASHBOARD (PELANGGAN ONLY)
// ============================================================================
$routes->group('pelanggan', ['filter' => 'pelangganFilter'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index', ['as' => 'pelanggan_dashboard']);
});

// ============================================================================
// ROUTING HALAMAN DASHBOARD (SUDAH LOGIN - LEGACY)
// ============================================================================
// Untuk backward compatibility
$routes->get('dashboard', 'Dashboard::index', ['as' => 'dashboard']);

// ============================================================================
// ROUTING LAINNYA
// ============================================================================
// 404 - halaman tidak ditemukan (auto-handled oleh CI4)


