<?php
/**
 * DASHBOARD/INDEX.PHP
 * Halaman dashboard utama - untuk user yang sudah login
 * Menampilkan ringkasan pesanan, dll
 */

$this->extend('layout/layout_main');
$this->section('content');
?>

<div class="row mb-4">
    <div class="col-12">
        <!-- Header Dashboard -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-6 fw-bold">
                    <i class="fas fa-chart-line text-primary"></i> Dashboard
                </h1>
                <p class="text-muted mb-0">Selamat datang kembali! Kelola pesanan dan akun Anda di sini.</p>
            </div>
            <div>
                <a href="#" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle"></i> Pesan Kostum
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Card Stats -->
<div class="row g-4 mb-5">
    <!-- Total Pesanan -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Pesanan</p>
                        <h3 class="fw-bold mb-0">5</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-shopping-cart fs-4 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Aktif -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Pesanan Aktif</p>
                        <h3 class="fw-bold mb-0">2</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-clock fs-4 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Selesai -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Pesanan Selesai</p>
                        <h3 class="fw-bold mb-0">3</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="fas fa-check-circle fs-4 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Pengeluaran</p>
                        <h3 class="fw-bold mb-0">Rp 1,5 Jt</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="fas fa-money-bill-wave fs-4 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pesanan Terbaru -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-list"></i> Pesanan Terbaru
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Kostum</th>
                                <th>Tanggal Sewa</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#P001</strong></td>
                                <td>Kostum Putri Pengantin</td>
                                <td>20 Dec 2024 - 22 Dec 2024</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>Rp 350.000</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#P002</strong></td>
                                <td>Kostum Superhero</td>
                                <td>24 Dec 2024 - 26 Dec 2024</td>
                                <td><span class="badge bg-warning">Pengiriman</span></td>
                                <td>Rp 200.000</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#P003</strong></td>
                                <td>Kostum Pirate</td>
                                <td>27 Dec 2024 - 29 Dec 2024</td>
                                <td><span class="badge bg-info">Dikonfirmasi</span></td>
                                <td>Rp 250.000</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <a href="#" class="text-decoration-none">Lihat semua pesanan →</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <h5 class="fw-bold mb-3">Menu Cepat</h5>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <a href="#" class="card shadow-sm border-0 text-decoration-none text-dark h-100">
            <div class="card-body text-center py-4">
                <i class="fas fa-search fs-3 text-primary mb-3"></i>
                <h6 class="fw-bold">Lihat Katalog</h6>
                <small class="text-muted">Jelajahi koleksi kostum</small>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <a href="#" class="card shadow-sm border-0 text-decoration-none text-dark h-100">
            <div class="card-body text-center py-4">
                <i class="fas fa-user fs-3 text-success mb-3"></i>
                <h6 class="fw-bold">Profil Saya</h6>
                <small class="text-muted">Kelola data diri</small>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <a href="#" class="card shadow-sm border-0 text-decoration-none text-dark h-100">
            <div class="card-body text-center py-4">
                <i class="fas fa-key fs-3 text-warning mb-3"></i>
                <h6 class="fw-bold">Ubah Password</h6>
                <small class="text-muted">Ganti password akun</small>
            </div>
        </a>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <a href="#" class="card shadow-sm border-0 text-decoration-none text-dark h-100">
            <div class="card-body text-center py-4">
                <i class="fas fa-sign-out-alt fs-3 text-danger mb-3"></i>
                <h6 class="fw-bold">Logout</h6>
                <small class="text-muted">Keluar dari akun</small>
            </div>
        </a>
    </div>
</div>

<?php $this->endSection(); ?>
