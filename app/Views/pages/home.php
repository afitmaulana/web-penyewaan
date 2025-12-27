<?php
/**
 * HOME.PHP
 * Halaman utama / homepage aplikasi rental kostum
 */

$this->extend('layout/layout_main');
$this->section('content');
?>

<div class="row mb-5">
    <div class="col-lg-8 mx-auto text-center">
        <!-- Hero Section -->
        <div class="mb-5 mt-4">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-tshirt text-primary"></i> Selamat Datang di Rental Kostum
            </h1>
            <p class="lead text-muted mb-4">
                Sewa kostum berkualitas untuk berbagai acara dengan harga terjangkau dan pelayanan terbaik.
            </p>

            <!-- Button CTA (Call to Action) -->
            <div class="d-flex gap-3 justify-content-center">
                <a href="#" class="btn btn-primary btn-lg">
                    <i class="fas fa-search"></i> Lihat Katalog Kostum
                </a>
                <a href="<?php echo base_url('login') ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login Akun
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Fitur Utama -->
<div class="row g-4 mb-5">
    <!-- Fitur 1 -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-box-open display-4 text-primary"></i>
                </div>
                <h5 class="card-title">Koleksi Lengkap</h5>
                <p class="card-text text-muted small">
                    Ratusan pilihan kostum untuk berbagai tema dan acara.
                </p>
            </div>
        </div>
    </div>

    <!-- Fitur 2 -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-money-bill-wave display-4 text-success"></i>
                </div>
                <h5 class="card-title">Harga Terjangkau</h5>
                <p class="card-text text-muted small">
                    Harga bersaing dengan sistem pembayaran yang fleksibel.
                </p>
            </div>
        </div>
    </div>

    <!-- Fitur 3 -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-truck display-4 text-info"></i>
                </div>
                <h5 class="card-title">Pengiriman Cepat</h5>
                <p class="card-text text-muted small">
                    Pengiriman ke seluruh kota dengan jaminan tepat waktu.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Kedua -->
<div class="bg-light p-5 rounded mb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3 class="fw-bold mb-2">Belum punya akun?</h3>
            <p class="text-muted mb-0">
                Daftar sekarang dan dapatkan diskon khusus untuk pemesanan pertama Anda!
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="<?php echo base_url('register') ?>" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </a>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
