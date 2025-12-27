<?php
/**
 * HEADER.PHP
 * Header yang berisi meta tag, title, dan CSS
 * Digunakan di layout utama
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
    <title><?php echo !empty($title) ? $title . ' | ' : '' ?>Rental Kostum</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('css/style.css') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('favicon.ico') ?>">
</head>
<body>
