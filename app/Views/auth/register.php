<?= $this->extend('layout/layout_main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-7 col-lg-6">
        <!-- Card Register -->
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-2">
                        <i class="fas fa-user-plus text-success"></i> Daftar Akun Baru
                    </h2>
                    <p class="text-muted small">Buat akun Anda sebagai pelanggan</p>
                </div>

                <!-- Success Message -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Error Message -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?= esc(session()->getFlashdata('error')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Form Register -->
                <form action="<?= base_url('register') ?>" method="POST">
                    <?= csrf_field() ?>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('nama_lengkap')) ? 'is-invalid' : '' ?>" 
                            id="nama_lengkap" 
                            name="nama_lengkap"
                            placeholder="Masukkan nama lengkap Anda"
                            value="<?= old('nama_lengkap') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('nama_lengkap')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('nama_lengkap') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input 
                            type="email" 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                            id="email" 
                            name="email"
                            placeholder="Masukkan email Anda"
                            value="<?= old('email') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('email')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('email') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Nomor HP -->
                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label fw-bold">Nomor HP</label>
                        <input 
                            type="tel" 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('nomor_hp')) ? 'is-invalid' : '' ?>" 
                            id="nomor_hp" 
                            name="nomor_hp"
                            placeholder="Contoh: 081234567890"
                            value="<?= old('nomor_hp') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('nomor_hp')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('nomor_hp') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-bold">Alamat</label>
                        <textarea 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('alamat')) ? 'is-invalid' : '' ?>" 
                            id="alamat" 
                            name="alamat"
                            rows="3"
                            placeholder="Masukkan alamat lengkap Anda"
                            required><?= old('alamat') ?></textarea>
                        <?php if (isset($validation) && $validation->hasError('alamat')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('alamat') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Kota & Provinsi Row -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kota" class="form-label fw-bold">Kota</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('kota')) ? 'is-invalid' : '' ?>" 
                                id="kota" 
                                name="kota"
                                placeholder="Masukkan kota Anda"
                                value="<?= old('kota') ?>"
                                required>
                            <?php if (isset($validation) && $validation->hasError('kota')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('kota') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="provinsi" class="form-label fw-bold">Provinsi</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('provinsi')) ? 'is-invalid' : '' ?>" 
                                id="provinsi" 
                                name="provinsi"
                                placeholder="Masukkan provinsi Anda"
                                value="<?= old('provinsi') ?>"
                                required>
                            <?php if (isset($validation) && $validation->hasError('provinsi')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('provinsi') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Kode Pos -->
                    <div class="mb-3">
                        <label for="kode_pos" class="form-label fw-bold">Kode Pos</label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('kode_pos')) ? 'is-invalid' : '' ?>" 
                            id="kode_pos" 
                            name="kode_pos"
                            placeholder="Contoh: 12345"
                            value="<?= old('kode_pos') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('kode_pos')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('kode_pos') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Password & Confirm Password Row -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input 
                                type="password" 
                                class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                                id="password" 
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required>
                            <?php if (isset($validation) && $validation->hasError('password')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('password') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirm" class="form-label fw-bold">Konfirmasi Password</label>
                            <input 
                                type="password" 
                                class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('password_confirm')) ? 'is-invalid' : '' ?>" 
                                id="password_confirm" 
                                name="password_confirm"
                                placeholder="Ulangi password Anda"
                                required>
                            <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
                                <div class="invalid-feedback d-block">
                                    <?= $validation->getError('password_confirm') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Button Daftar -->
                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold mt-3">
                        <i class="fas fa-user-check"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Link Login -->
                <div class="text-center">
                    <p class="small text-muted">
                        Sudah punya akun?
                        <a href="<?= base_url('login') ?>" class="text-decoration-none fw-bold">
                            Login di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
