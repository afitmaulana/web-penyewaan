<?= $this->extend('layout/layout_main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <!-- Welcome Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h1 class="card-title mb-2">Selamat Datang, <?= esc($user_name) ?> 👋</h1>
                    <p class="card-text text-muted">Anda login sebagai <strong>Pelanggan</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Dashboard Stats -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Penyewaan Aktif</h5>
                    <h2 class="text-primary">3</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-history fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Total Penyewaan</h5>
                    <h2 class="text-info">12</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fas fa-credit-card fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <h2 class="text-success">Rp 2.5M</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- My Rentals Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Penyewaan Aktif Saya</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Kostum</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Superhero Superman</td>
                                    <td>01-01-2025</td>
                                    <td>03-01-2025</td>
                                    <td>Rp 150.000</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Princess Cinderella</td>
                                    <td>05-01-2025</td>
                                    <td>07-01-2025</td>
                                    <td>Rp 200.000</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Pirate Captain Jack</td>
                                    <td>10-01-2025</td>
                                    <td>12-01-2025</td>
                                    <td>Rp 175.000</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-star"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i> Sewa Kostum Baru
                        </a>
                        <a href="#" class="btn btn-info btn-lg">
                            <i class="fas fa-box me-2"></i> Lihat Katalog
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Akun Saya</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-warning btn-lg">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </a>
                        <a href="#" class="btn btn-secondary btn-lg">
                            <i class="fas fa-lock me-2"></i> Ganti Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <form action="<?= base_url('logout') ?>" method="POST" style="display:inline;">
                <?= csrf_field() ?>
                <button type="submit" class="btn btn-danger btn-lg">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
