<?php
/**
 * FOOTER.PHP
 * Footer yang ditampilkan di semua halaman
 * Berisi informasi, copyright, dan link penting
 */
?>

<footer class="bg-dark text-light mt-5 pt-5 pb-3">
    <div class="container">
        <div class="row mb-4">
            <!-- Kolom Tentang -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">
                    <i class="fas fa-tshirt"></i> Rental Kostum
                </h5>
                <p class="small text-muted">
                    Aplikasi penyewaan kostum online terpercaya. 
                    Sewa kostum impian Anda dengan mudah dan harga terjangkau.
                </p>
            </div>

            <!-- Kolom Menu -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled small">
                    <li><a href="<?php echo base_url('/') ?>" class="text-decoration-none text-muted">Home</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Katalog Kostum</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Kontak</a></li>
                </ul>
            </div>

            <!-- Kolom Help -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Bantuan</h5>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-decoration-none text-muted">FAQ</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-decoration-none text-muted">Cara Sewa</a></li>
                </ul>
            </div>

            <!-- Kolom Kontak -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold">Hubungi Kami</h5>
                <ul class="list-unstyled small">
                    <li>
                        <a href="tel:+62123456789" class="text-decoration-none text-muted">
                            <i class="fas fa-phone"></i> +62 123 456 789
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@rentalkostum.com" class="text-decoration-none text-muted">
                            <i class="fas fa-envelope"></i> info@rentalkostum.com
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none text-muted">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-decoration-none text-muted">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Garis pemisah -->
        <hr class="bg-secondary">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6">
                <p class="small text-muted mb-0">
                    &copy; 2025 Rental Kostum. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="small text-muted mb-0">
                    Dibuat dengan <i class="fas fa-heart text-danger"></i> menggunakan CodeIgniter 4
                </p>
            </div>
        </div>
    </div>
</footer>

    <!-- Bootstrap 5 JS Bundle (termasuk Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo base_url('js/script.js') ?>"></script>
</body>
</html>
