<?php
/**
 * LAYOUT_MAIN.PHP
 * Layout utama aplikasi yang digunakan di semua halaman
 * Menggunakan sistem template section CI4
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Rental Kostum Online - Sewa kostum berkualitas dengan mudah">
    <meta name="keywords" content="rental, kostum, sewa, online">
    
    <!-- Title -->
    <title><?= isset($title) ? $title . ' | ' : '' ?>Rental Kostum</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
</head>
<body class="d-flex flex-column">
    <!-- Navbar / Menu Utama -->
    <?= $this->include('layout/navbar') ?>

    <!-- Main Content Area -->
    <main class="py-4" style="min-height: 100vh;">
        <div class="container">
            <!-- Section Content (diganti-ganti sesuai halaman) -->
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <?= $this->include('layout/footer') ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
