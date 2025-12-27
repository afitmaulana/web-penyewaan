/**
 * STRUKTUR DATABASE - RENTAL KOSTUM
 * 
 * File ini mendokumentasikan struktur tabel yang akan dibuat di Tahap 2
 * Menggunakan CodeIgniter 4 Migrations
 * 
 * CATATAN: Ini hanya dokumentasi, tabel belum dibuat!
 */

-- ========================================================================
-- TABEL 1: USERS (Pengguna / Pelanggan)
-- ========================================================================
-- Menyimpan data pengguna yang terdaftar di sistem

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Data Dasar
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,      -- Hashed password (bcrypt)
    phone VARCHAR(20) NOT NULL,
    
    -- Alamat
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    province VARCHAR(50) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    
    -- Status
    is_active BOOLEAN DEFAULT true,
    email_verified BOOLEAN DEFAULT false,
    email_verified_at TIMESTAMP NULL,
    
    -- Audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,           -- Soft delete
    
    -- Indexes
    INDEX idx_email (email),
    INDEX idx_phone (phone),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 2: KOSTUM (Katalog Kostum)
-- ========================================================================
-- Menyimpan data kostum yang tersedia untuk disewa

CREATE TABLE kostum (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Data Kostum
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,       -- e.g: tradisional, modern, superhero
    size VARCHAR(10) NOT NULL,           -- S, M, L, XL
    color VARCHAR(30) NOT NULL,
    material VARCHAR(50) NOT NULL,
    
    -- Harga
    daily_price INT NOT NULL,            -- Harga per hari (dalam Rupiah)
    condition VARCHAR(20) NOT NULL DEFAULT 'good',  -- good, fair, new
    
    -- Gambar
    image_url VARCHAR(255) NULL,
    
    -- Ketersediaan
    stock INT NOT NULL DEFAULT 1,        -- Jumlah stok
    is_available BOOLEAN DEFAULT true,
    
    -- Status
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    
    -- Indexes
    INDEX idx_category (category),
    INDEX idx_is_available (is_available),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 3: PESANAN (Rental Orders)
-- ========================================================================
-- Menyimpan data pesanan rental kostum

CREATE TABLE pesanan (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference
    order_number VARCHAR(30) NOT NULL UNIQUE,  -- e.g: ORD-2024-001
    user_id INT UNSIGNED NOT NULL,
    
    -- Tanggal Sewa
    rental_date DATE NOT NULL,           -- Tanggal mulai sewa
    return_date DATE NOT NULL,           -- Tanggal kembali
    days_count INT NOT NULL,             -- Jumlah hari
    
    -- Total Harga
    subtotal INT NOT NULL,               -- Harga sebelum diskon
    discount INT DEFAULT 0,              -- Diskon (dalam Rupiah)
    total_price INT NOT NULL,            -- Harga akhir
    
    -- Status
    status VARCHAR(20) NOT NULL DEFAULT 'pending',  
    -- pending, confirmed, delivered, returned, cancelled
    
    -- Notes
    notes TEXT NULL,
    
    -- Audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    
    -- Foreign Key
    CONSTRAINT fk_pesanan_user FOREIGN KEY (user_id) 
        REFERENCES users(id) ON DELETE RESTRICT,
    
    -- Indexes
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 4: PESANAN_DETAIL (Detail Item Pesanan)
-- ========================================================================
-- Menyimpan detail kostum yang disewa di setiap pesanan

CREATE TABLE pesanan_detail (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference
    pesanan_id INT UNSIGNED NOT NULL,
    kostum_id INT UNSIGNED NOT NULL,
    
    -- Detail Item
    quantity INT NOT NULL DEFAULT 1,     -- Jumlah kostum
    unit_price INT NOT NULL,             -- Harga per unit saat pesanan dibuat
    subtotal INT NOT NULL,               -- quantity * unit_price
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    CONSTRAINT fk_detail_pesanan FOREIGN KEY (pesanan_id) 
        REFERENCES pesanan(id) ON DELETE CASCADE,
    
    CONSTRAINT fk_detail_kostum FOREIGN KEY (kostum_id) 
        REFERENCES kostum(id) ON DELETE RESTRICT,
    
    -- Indexes
    INDEX idx_pesanan_id (pesanan_id),
    INDEX idx_kostum_id (kostum_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 5: PEMBAYARAN (Payment)
-- ========================================================================
-- Menyimpan data pembayaran untuk setiap pesanan

CREATE TABLE pembayaran (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference
    pesanan_id INT UNSIGNED NOT NULL,
    
    -- Pembayaran
    payment_method VARCHAR(20) NOT NULL,  -- bank, credit_card, e_wallet, cash
    payment_status VARCHAR(20) NOT NULL DEFAULT 'pending',
    -- pending, processing, completed, failed, refunded
    
    -- Tanggal
    payment_date TIMESTAMP NULL,
    
    -- Reference Eksternal
    external_id VARCHAR(100) NULL,       -- e.g: Transaction ID dari payment gateway
    
    -- Notes
    notes TEXT NULL,
    
    -- Audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Key
    CONSTRAINT fk_pembayaran_pesanan FOREIGN KEY (pesanan_id) 
        REFERENCES pesanan(id) ON DELETE RESTRICT,
    
    -- Indexes
    INDEX idx_pesanan_id (pesanan_id),
    INDEX idx_payment_status (payment_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 6: REVIEWS (Review/Rating Kostum)
-- ========================================================================
-- Menyimpan review dan rating dari user tentang kostum

CREATE TABLE reviews (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference
    kostum_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    pesanan_id INT UNSIGNED NOT NULL,
    
    -- Review Data
    rating INT NOT NULL,                 -- 1-5 stars
    comment TEXT NULL,
    
    -- Status
    is_verified BOOLEAN DEFAULT false,   -- Hanya review dari pesanan selesai
    
    -- Audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Foreign Keys
    CONSTRAINT fk_review_kostum FOREIGN KEY (kostum_id) 
        REFERENCES kostum(id) ON DELETE CASCADE,
    
    CONSTRAINT fk_review_user FOREIGN KEY (user_id) 
        REFERENCES users(id) ON DELETE CASCADE,
    
    CONSTRAINT fk_review_pesanan FOREIGN KEY (pesanan_id) 
        REFERENCES pesanan(id) ON DELETE CASCADE,
    
    -- Indexes
    INDEX idx_kostum_id (kostum_id),
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 7: ADMIN_USERS (Admin / Staff)
-- ========================================================================
-- Menyimpan data admin/staff yang mengelola aplikasi

CREATE TABLE admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- Data Admin
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    
    -- Role
    role VARCHAR(20) NOT NULL,           -- admin, staff, manager
    
    -- Status
    is_active BOOLEAN DEFAULT true,
    
    -- Audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- TABEL 8: AUDIT_LOG (Audit Trail)
-- ========================================================================
-- Mencatat semua aktivitas penting di aplikasi

CREATE TABLE audit_logs (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    
    -- User Info
    user_id INT UNSIGNED NULL,
    admin_id INT UNSIGNED NULL,
    
    -- Activity
    action VARCHAR(50) NOT NULL,         -- create, update, delete, login, logout
    model VARCHAR(50) NOT NULL,          -- User, Kostum, Pesanan, etc
    model_id INT UNSIGNED NULL,
    
    -- Changes
    old_values JSON NULL,
    new_values JSON NULL,
    
    -- IP & User Agent
    ip_address VARCHAR(45) NOT NULL,
    user_agent VARCHAR(255) NULL,
    
    -- Timestamp
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Indexes
    INDEX idx_user_id (user_id),
    INDEX idx_admin_id (admin_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ========================================================================
-- CONTOH QUERY / OPERATIONS
-- ========================================================================

-- 1. Lihat daftar kostum dengan rating tertinggi
SELECT k.*, AVG(r.rating) as avg_rating
FROM kostum k
LEFT JOIN reviews r ON k.id = r.kostum_id
WHERE k.is_available = true
GROUP BY k.id
ORDER BY avg_rating DESC
LIMIT 10;

-- 2. Lihat pesanan user beserta detail kostum
SELECT 
    p.id as pesanan_id,
    p.order_number,
    p.status,
    k.name as kostum_name,
    pd.quantity,
    pd.unit_price,
    p.rental_date,
    p.return_date
FROM pesanan p
JOIN pesanan_detail pd ON p.id = pd.pesanan_id
JOIN kostum k ON pd.kostum_id = k.id
WHERE p.user_id = 1
ORDER BY p.created_at DESC;

-- 3. Kostum yang sedang disewa (belum dikembalikan)
SELECT 
    k.name,
    COUNT(pd.id) as sedang_disewa
FROM kostum k
JOIN pesanan_detail pd ON k.id = pd.kostum_id
JOIN pesanan p ON pd.pesanan_id = p.id
WHERE p.status != 'returned' AND p.return_date >= CURDATE()
GROUP BY k.id
ORDER BY sedang_disewa DESC;

-- 4. Total revenue per bulan
SELECT 
    DATE_TRUNC(p.created_at, MONTH) as bulan,
    SUM(p.total_price) as total_revenue,
    COUNT(p.id) as jumlah_pesanan
FROM pesanan p
WHERE p.status = 'completed'
GROUP BY MONTH(p.created_at), YEAR(p.created_at)
ORDER BY bulan DESC;


-- ========================================================================
-- NOTES
-- ========================================================================

/*
✅ Ini adalah desain database awal yang akan kita implementasikan di Tahap 2

TAHAP 2 akan fokus pada:
- Buat migrations untuk semua tabel
- Setup relationship (Model) antara tabel
- Buat factories untuk testing data

TAHAP 3 akan fokus pada:
- CRUD untuk Kostum
- Admin panel untuk manage kostum

TAHAP 4 akan fokus pada:
- Order/Rental system
- Shopping cart
- Payment integration

Desain ini dapat disesuaikan sesuai requirement yang berkembang!
*/
