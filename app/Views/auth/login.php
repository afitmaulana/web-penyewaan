<?= $this->extend('layout/layout_main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <!-- Card Login -->
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-2">
                        <i class="fas fa-sign-in-alt text-primary"></i> Login
                    </h2>
                    <p class="text-muted small">Masuk ke akun Anda</p>
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

                <!-- Form Login -->
                <form action="<?= base_url('login') ?>" method="POST">
                    <?= csrf_field() ?>

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
                        <small class="text-muted d-block mt-1">Gunakan email yang terdaftar</small>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input 
                            type="password" 
                            class="form-control form-control-lg <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                            id="password" 
                            name="password"
                            placeholder="Masukkan password Anda"
                            required>
                        <?php if (isset($validation) && $validation->hasError('password')): ?>
                            <div class="invalid-feedback d-block">
                                <?= $validation->getError('password') ?>
                            </div>
                        <?php endif; ?>
                        <small class="text-muted d-block mt-1">Jangan bagikan password Anda</small>
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="remember" 
                                name="remember"
                                value="1">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <!-- Button Login -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        <i class="fas fa-lock"></i> Login
                    </button>
                </form>

                <!-- Divider -->
                <hr class="my-4">

                <!-- Link Lain -->
                <div class="text-center">
                    <p class="small mb-2">
                        <a href="#" class="text-decoration-none">Lupa password?</a>
                    </p>
                    <p class="small text-muted">
                        Belum punya akun?
                        <a href="<?= base_url('register') ?>" class="text-decoration-none fw-bold">
                            Daftar di sini
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Demo Info -->
        <div class="alert alert-warning alert-sm mt-4" role="alert">
            <small>
                <i class="fas fa-info-circle"></i>
                <strong>Demo Credentials:</strong><br>
                Email: admin@rentalkosiium.com<br>
                Password: admin123
            </small>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
