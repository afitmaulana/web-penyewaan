<?= $this->extend('layout/layout_main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <!-- Welcome Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h1 class="card-title mb-2">Selamat Datang, <?= esc($user_name) ?> 👋</h1>
                    <p class="card-text text-muted">Anda login sebagai <strong>Administrator</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="row mb-5">
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Total Pelanggan</h5>
                    <h2 class="text-primary">150</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Penyewaan Aktif</h5>
                    <h2 class="text-success">45</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-box fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Total Kostum</h5>
                    <h2 class="text-warning">250</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-credit-card fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Pendapatan</h5>
                    <h2 class="text-info">Rp 25M</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Features -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-cog"></i> Menu Admin</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="<?= route_to('admin_dashboard') ?>#pelanggan" class="list-group-item list-group-item-action" title="Fitur belum tersedia - TAHAP 5">
                            <i class="fas fa-users me-2"></i> Kelola Pelanggan
                            <span class="badge bg-secondary float-end">Coming</span>
                        </a>
                        <a href="<?= route_to('kostum_index') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-box me-2"></i> Kelola Kostum
                            <span class="badge bg-success float-end">✓</span>
                        </a>
                        <a href="<?= route_to('kategori_index') ?>" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2"></i> Kategori Kostum
                            <span class="badge bg-success float-end">✓</span>
                        </a>
                        <a href="<?= route_to('admin_dashboard') ?>#penyewaan" class="list-group-item list-group-item-action" title="Fitur belum tersedia - TAHAP 5">
                            <i class="fas fa-receipt me-2"></i> Kelola Penyewaan
                            <span class="badge bg-secondary float-end">Coming</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Statistik</h5>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <strong>Penyewaan Hari Ini:</strong> <span class="badge bg-primary">12</span>
                    </p>
                    <p class="mb-3">
                        <strong>Pembayaran Pending:</strong> <span class="badge bg-warning">8</span>
                    </p>
                    <p class="mb-3">
                        <strong>Pengembalian Terlambat:</strong> <span class="badge bg-danger">3</span>
                    </p>
                    <p class="mb-0">
                        <strong>Rating Rata-rata:</strong> <span class="badge bg-info">4.8/5</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <form action="<?= base_url('logout') ?>" method="POST" style="display:inline;">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
