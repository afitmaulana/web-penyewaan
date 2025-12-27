/**
 * SCRIPT.JS
 * File JavaScript custom untuk fitur interaktif
 */

// Siap ketika DOM sudah dimuat
document.addEventListener('DOMContentLoaded', function() {
    console.log('Rental Kostum App - Berhasil dimuat');

    // ================================================================
    // INISIALISASI KOMPONEN BOOTSTRAP
    // ================================================================
    
    // Bootstrap Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Bootstrap Popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // ================================================================
    // FORM VALIDATION
    // ================================================================
    
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // ================================================================
    // UTILITY FUNCTIONS
    // ================================================================

    /**
     * Fungsi untuk menampilkan alert/notifikasi
     * @param {string} message - Pesan yang akan ditampilkan
     * @param {string} type - Tipe alert (success, danger, warning, info)
     */
    window.showAlert = function(message, type = 'info') {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.body.insertBefore(alertDiv, document.body.firstChild);

        // Auto-hide setelah 5 detik
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    };

    /**
     * Fungsi untuk format currency ke Rupiah
     * @param {number} amount - Jumlah uang
     * @returns {string}
     */
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    };

    /**
     * Fungsi untuk format tanggal
     * @param {string} date - Tanggal dalam format ISO (YYYY-MM-DD)
     * @returns {string}
     */
    window.formatDate = function(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date(date));
    };
});

// ================================================================
// LOG INFO
// ================================================================
console.log('%c🎉 Rental Kostum App', 'color: #007bff; font-size: 16px; font-weight: bold;');
console.log('%cVersi: 1.0.0', 'color: #666; font-size: 12px;');
console.log('%cCodeIgniter 4 + Bootstrap 5', 'color: #999; font-size: 11px;');
