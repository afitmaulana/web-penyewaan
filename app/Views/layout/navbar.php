<?php
/**
 * NAVBAR.PHP
 * Komponen navigasi bar yang ditampilkan di semua halaman
 * Menggunakan Bootstrap 5
 */
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container-fluid">
        <!-- Logo / Brand -->
        <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>">
            <i class="fas fa-tshirt"></i> RENTAL KOSTUM
        </a>

        <!-- Hamburger Menu (Mobile) -->
        <button 
            class="navbar-toggler" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarNav" 
            aria-controls="navbarNav" 
            aria-expanded="false" 
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Menu Halaman Utama -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <!-- Menu Katalog Kostum (nanti) -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-list"></i> Katalog
                    </a>
                </li>

                <!-- Menu Login / Register (Untuk user yang belum login) -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('login') ?>">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('register') ?>">
                        <i class="fas fa-user-plus"></i> Daftar
                    </a>
                </li>

                <!-- Menu Dropdown (Untuk user yang sudah login - nanti) -->
                <!-- 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> Nama User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Pesanan Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </div>
    </div>
</nav>
