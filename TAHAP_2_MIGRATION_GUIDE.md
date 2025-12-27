# 📚 TAHAP 2: PANDUAN MIGRATION & SEEDER

**Framework:** CodeIgniter 4  
**Database:** MySQL  
**Created:** 27 December 2024  
**Status:** ✅ Migration & Seeder Ready

---

## 🎯 DAFTAR ISI

1. [Quick Start](#quick-start)
2. [Prasyarat](#prasyarat)
3. [Step-by-Step Running Migration](#step-by-step-running-migration)
4. [Step-by-Step Running Seeder](#step-by-step-running-seeder)
5. [Troubleshooting](#troubleshooting)
6. [Verify Database](#verify-database)
7. [Rollback & Reset](#rollback--reset)
8. [Best Practices](#best-practices)

---

## ⚡ QUICK START

Jika Anda sudah familiar dengan CodeIgniter 4, berikut command quick start:

```bash
# 1. Pastikan MySQL server running
# 2. Update file .env dengan database credentials

# 3. Run semua migrations
php spark migrate

# 4. Run semua seeders
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder

# 5. Verify database
# Lihat section "Verify Database" di bawah
```

**Done! Database siap digunakan.** ✅

---

## ✅ PRASYARAT

Sebelum menjalankan migration dan seeder, pastikan:

### 1. MySQL Server Running
```bash
# Windows (jika menggunakan XAMPP)
# Buka XAMPP Control Panel dan klik "Start" untuk MySQL

# Linux
sudo service mysql start

# macOS (jika menggunakan Homebrew)
brew services start mysql
```

### 2. Database Created
```bash
# Masuk ke MySQL
mysql -u root -p

# Buat database (jika belum ada)
CREATE DATABASE rental_kostum;

# Exit
EXIT;
```

### 3. File .env Sudah Dikonfigurasi
Pastikan `.env` file sudah benar:

```ini
# .env file
CI_ENVIRONMENT = development

# Database Configuration
database.default.hostname = localhost
database.default.database = rental_kostum
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
database.default.port = 3306

# Contoh jika ada password database
# database.default.password = your_password
```

### 4. Migration & Seeder Files Sudah Ada
Pastikan files berikut sudah dibuat:

**Migration Files:**
- ✅ `app/Database/Migrations/2024-12-27-000001_CreateUsersTable.php`
- ✅ `app/Database/Migrations/2024-12-27-000002_CreateKategoriTable.php`
- ✅ `app/Database/Migrations/2024-12-27-000003_CreateKostumTable.php`
- ✅ `app/Database/Migrations/2024-12-27-000004_CreatePenyewaanTable.php`
- ✅ `app/Database/Migrations/2024-12-27-000005_CreatePembayaranTable.php`
- ✅ `app/Database/Migrations/2024-12-27-000006_CreatePengembalianTable.php`

**Seeder Files:**
- ✅ `app/Database/Seeds/AdminSeeder.php`
- ✅ `app/Database/Seeds/KategoriSeeder.php`
- ✅ `app/Database/Seeds/KostumSeeder.php`

---

## 📋 STEP-BY-STEP RUNNING MIGRATION

### Step 1: Buka Terminal/Command Prompt
```bash
# Navigate ke project directory
cd d:\web-penyewaan\web-penyewaan
```

### Step 2: Check Migration Status
Lihat status migration sebelum menjalankan:
```bash
php spark migrate:status
```

**Expected Output:**
```
Migrations
| Name                              | Batch | Method | Time                |
+---------------------------------+---------+---------+------------------+
| 2024-12-27-000001_CreateUsersTable    | -   | ---    | -                  |
| 2024-12-27-000002_CreateKategoriTable | -   | ---    | -                  |
| 2024-12-27-000003_CreateKostumTable   | -   | ---    | -                  |
| 2024-12-27-000004_CreatePenyewaanTable| -   | ---    | -                  |
| 2024-12-27-000005_CreatePembayaranTable| -   | ---    | -                  |
| 2024-12-27-000006_CreatePengembalianTable| -   | ---    | -                  |
```

Jika semua file belum di-migrate (batch = -), lanjut ke step 3.

### Step 3: Run All Migrations
```bash
php spark migrate
```

**Expected Output:**
```
Migrations complete.
```

Jika berhasil, semua tabel sudah dibuat di database.

### Step 4: Verify Migration Status
```bash
php spark migrate:status
```

**Expected Output:**
```
Migrations
| Name                              | Batch | Method | Time                |
+---------------------------------+-------+--------+------------------+
| 2024-12-27-000001_CreateUsersTable    | 1   | up     | 2024-12-27 10:15:30|
| 2024-12-27-000002_CreateKategoriTable | 1   | up     | 2024-12-27 10:15:31|
| 2024-12-27-000003_CreateKostumTable   | 1   | up     | 2024-12-27 10:15:32|
| 2024-12-27-000004_CreatePenyewaanTable| 1   | up     | 2024-12-27 10:15:33|
| 2024-12-27-000005_CreatePembayaranTable| 1   | up     | 2024-12-27 10:15:34|
| 2024-12-27-000006_CreatePengembalianTable| 1   | up     | 2024-12-27 10:15:35|
```

Jika batch semua = 1 dan method = up, migration berhasil! ✅

---

## 🌱 STEP-BY-STEP RUNNING SEEDER

### Step 1: Run Admin Seeder
```bash
php spark db:seed AdminSeeder
```

**Expected Output:**
```
✅ Admin seeder berhasil dijalankan!
Email: admin@rentalkosiium.com
Email: operasional@rentalkosiium.com
Password: admin123
```

### Step 2: Run Kategori Seeder
```bash
php spark db:seed KategoriSeeder
```

**Expected Output:**
```
✅ Kategori seeder berhasil dijalankan!
Total kategori yang ditambahkan: 6
```

### Step 3: Run Kostum Seeder
```bash
php spark db:seed KostumSeeder
```

**Expected Output:**
```
✅ Kostum seeder berhasil dijalankan!
Total kostum yang ditambahkan: 12
```

### Step 4: Verify Seeders
Jika semua seeders berhasil dijalankan, Anda sudah punya:
- ✅ 2 Admin users
- ✅ 6 Kategori kostum
- ✅ 12 Kostum dengan stok

---

## 🔍 VERIFY DATABASE

### Cara 1: Menggunakan PHPMyAdmin (Recommended)

**Jika menggunakan XAMPP:**
1. Buka browser
2. Kunjungi `http://localhost/phpmyadmin`
3. Login dengan credentials Anda
4. Lihat database `rental_kostum`

**Expected Structure:**
```
rental_kostum
├── users (2 rows)
├── kategori (6 rows)
├── kostum (12 rows)
├── penyewaan (0 rows)
├── pembayaran (0 rows)
└── pengembalian (0 rows)
```

### Cara 2: Menggunakan Command Line

```bash
# Login ke MySQL
mysql -u root -p rental_kostum

# Lihat semua tabel
SHOW TABLES;

# Lihat struktur tabel users
DESCRIBE users;

# Lihat data users
SELECT * FROM users;

# Lihat data kategori
SELECT * FROM kategori;

# Lihat data kostum
SELECT * FROM kostum;

# Exit
EXIT;
```

**Expected Output:**
```
mysql> SHOW TABLES;
+------------------------+
| Tables_in_rental_kostum |
+------------------------+
| kategori               |
| kostum                 |
| migrations             |
| pembayaran             |
| pengembalian           |
| penyewaan              |
| users                  |
+------------------------+
7 rows in set (0.00 sec)
```

### Cara 3: Verify Admin Login

```bash
# Jalankan aplikasi
php spark serve

# Buka browser
# http://localhost:8080/login

# Coba login dengan credentials admin
Email: admin@rentalkosiium.com
Password: admin123
```

Jika bisa login, semuanya sudah bekerja dengan baik! ✅

---

## ❌ TROUBLESHOOTING

### Problem 1: "SQLSTATE[HY000]: General error: 1030 Got error... from storage engine"

**Cause:** Database credentials di `.env` salah atau MySQL tidak running

**Solution:**
```bash
# 1. Pastikan MySQL running
# 2. Check `.env` file
# 3. Verify credentials
# 4. Try again: php spark migrate
```

### Problem 2: "Class 'CodeIgniter\Database\Migration' not found"

**Cause:** CodeIgniter 4 tidak ter-install dengan benar

**Solution:**
```bash
# Update composer
composer update

# Atau install ulang
composer install
```

### Problem 3: "Table 'rental_kostum.kategori' doesn't exist"

**Cause:** Migration belum dijalankan

**Solution:**
```bash
# Run migration dulu
php spark migrate

# Verify status
php spark migrate:status
```

### Problem 4: "Duplicate entry 'admin@rentalkosiium.com' for key 'email'"

**Cause:** Seeder sudah dijalankan sebelumnya (data already exists)

**Solution:**
```bash
# Option 1: Rollback semua migrations
php spark migrate:refresh

# Option 2: Delete data manual di PHPMyAdmin, lalu re-seed
# Lebih aman jika tidak ingin drop semua tabel

# Option 3: Run seeder dengan fresh option
php spark migrate:fresh --seed
```

### Problem 5: "Foreign key constraint is incorrectly formed"

**Cause:** Tabel yang di-reference belum ada atau nama field salah

**Solution:**
```bash
# Pastikan migration dijalankan urut
php spark migrate:status

# Jika ada yang gagal, coba refresh
php spark migrate:refresh
```

### Problem 6: ENUM Field Tidak Bekerja

**Cause:** MySQL version tidak support ENUM atau konfigurasi salah

**Solution:**
```bash
# Check MySQL version
mysql --version

# Pastikan MySQL 5.7+
# ENUM sudah support dari MySQL 5.0
```

---

## 🔄 ROLLBACK & RESET

### Rollback Last Migration Batch
```bash
php spark migrate:rollback
```

**Effect:** Semua tabel yang dibuat di batch terakhir akan di-drop

### Rollback to Specific Batch
```bash
php spark migrate:rollback --batch=1
```

### Rollback All & Re-run
```bash
php spark migrate:refresh
```

**Effect:** Drop all tables dan re-create dari awal

### Rollback All & Re-run with Seeding
```bash
php spark migrate:refresh --seed
```

**Effect:** Drop all tables, re-create, dan re-seed data

### Fresh Start (Nuclear Option)
```bash
# Drop database completely
mysql -u root -p -e "DROP DATABASE rental_kostum;"

# Create database baru
mysql -u root -p -e "CREATE DATABASE rental_kostum;"

# Run migrations
php spark migrate

# Run seeders
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder
```

---

## 📝 BEST PRACTICES

### 1. Database Backup Sebelum Rollback
```bash
# Backup database
mysqldump -u root -p rental_kostum > backup_rental_kostum.sql

# Restore if needed
mysql -u root -p rental_kostum < backup_rental_kostum.sql
```

### 2. Test Migration di Development Dulu
- Jangan langsung run di production
- Test di local development environment terlebih dahulu
- Verify data integrity setelah migration

### 3. Version Control untuk Migration Files
- Selalu commit migration files ke git
- Jangan modify migration yang sudah di-run
- Untuk modifikasi, buat migration baru

### 4. Seeder untuk Development Data Only
- Seeder hanya untuk development/testing
- Untuk production, gunakan manual insert atau import
- Jangan include password real admin di seeder

### 5. Check Migration Status Regularly
```bash
# Sebelum production deployment
php spark migrate:status

# Pastikan semua migration sudah up
# dan tidak ada yang failed
```

---

## 📊 TABEL STRUCTURE REFERENCE

### Users Table
```sql
DESCRIBE users;

+-------------------+--------------+------+-----+---------+----------------+
| Field             | Type         | Null | Key | Default | Extra          |
+-------------------+--------------+------+-----+---------+----------------+
| id                | int(11)      | NO   | PRI | NULL    | auto_increment |
| nama_lengkap      | varchar(100) | NO   |     | NULL    |                |
| email             | varchar(100) | NO   | UNI | NULL    |                |
| password          | varchar(255) | NO   |     | NULL    |                |
| nomor_hp          | varchar(15)  | YES  |     | NULL    |                |
| alamat            | text         | YES  |     | NULL    |                |
| kota              | varchar(50)  | YES  |     | NULL    |                |
| provinsi          | varchar(50)  | YES  |     | NULL    |                |
| kode_pos          | varchar(10)  | YES  |     | NULL    |                |
| role              | enum(...)    | NO   |     | pelang  |                |
| is_active         | tinyint(4)   | NO   |     | 1       |                |
| last_login        | timestamp    | YES  |     | NULL    |                |
| created_at        | timestamp    | YES  |     | NULL    |                |
| updated_at        | timestamp    | YES  |     | NULL    |                |
+-------------------+--------------+------+-----+---------+----------------+
```

### Kategori Table
```sql
DESCRIBE kategori;

+----------------+--------------+------+-----+---------+----------------+
| Field          | Type         | Null | Key | Default | Extra          |
+----------------+--------------+------+-----+---------+----------------+
| id             | int(11)      | NO   | PRI | NULL    | auto_increment |
| nama_kategori  | varchar(100) | NO   |     | NULL    |                |
| deskripsi      | text         | YES  |     | NULL    |                |
| is_active      | tinyint(4)   | NO   |     | 1       |                |
| created_at     | timestamp    | YES  |     | NULL    |                |
| updated_at     | timestamp    | YES  |     | NULL    |                |
+----------------+--------------+------+-----+---------+----------------+
```

### Kostum Table
```sql
DESCRIBE kostum;

+------------------------+--------------+------+-----+---------+----------------+
| Field                  | Type         | Null | Key | Default | Extra          |
+------------------------+--------------+------+-----+---------+----------------+
| id                     | int(11)      | NO   | PRI | NULL    | auto_increment |
| kategori_id            | int(11)      | NO   | FK  | NULL    |                |
| nama_kostum            | varchar(100) | NO   |     | NULL    |                |
| deskripsi              | text         | YES  |     | NULL    |                |
| ukuran                 | varchar(20)  | NO   |     | NULL    |                |
| warna                  | varchar(50)  | NO   |     | NULL    |                |
| harga_sewa_per_hari    | decimal(10,2)| NO   |     | NULL    |                |
| harga_sewa_per_minggu  | decimal(10,2)| YES  |     | NULL    |                |
| stok_tersedia          | int(11)      | NO   |     | 0       |                |
| stok_total             | int(11)      | NO   |     | 0       |                |
| foto_url               | varchar(255) | YES  |     | NULL    |                |
| is_active              | tinyint(4)   | NO   |     | 1       |                |
| created_at             | timestamp    | YES  |     | NULL    |                |
| updated_at             | timestamp    | YES  |     | NULL    |                |
+------------------------+--------------+------+-----+---------+----------------+
```

---

## 🚀 NEXT STEPS

Setelah migration & seeder berhasil:

1. **Verify Data** - Pastikan semua data sudah masuk dengan benar
2. **Test Relasi** - Test foreign key relationships
3. **Create Models** - Buat Models untuk setiap tabel (Tahap 3)
4. **Create Controllers** - Buat Controllers untuk CRUD operations (Tahap 3)
5. **Create Views** - Buat Views untuk tampilan data (Tahap 3)

---

## 📞 QUICK REFERENCE

| Command | Function |
|---------|----------|
| `php spark migrate` | Run all pending migrations |
| `php spark migrate:status` | Check migration status |
| `php spark migrate:rollback` | Rollback last batch |
| `php spark migrate:refresh` | Refresh (rollback + migrate) |
| `php spark db:seed AdminSeeder` | Run AdminSeeder |
| `php spark db:seed KategoriSeeder` | Run KategoriSeeder |
| `php spark db:seed KostumSeeder` | Run KostumSeeder |
| `php spark migrate:fresh --seed` | Fresh start with seeding |

---

## ✅ SUCCESS CHECKLIST

Jika semua ini berhasil, migration & seeder complete! ✅

- [ ] MySQL server running
- [ ] Database `rental_kostum` created
- [ ] `.env` configured correctly
- [ ] All migration files created
- [ ] `php spark migrate` executed successfully
- [ ] All seeders executed successfully
- [ ] Can view tables in PHPMyAdmin
- [ ] Admin can login with credentials
- [ ] Database relations working correctly
- [ ] Ready for Tahap 3 (Models & Controllers)

---

**Status:** ✅ TAHAP 2 Complete  
**Version:** 1.0.0  
**Last Updated:** 27 December 2024

Next: TAHAP 3 - Models, Controllers & CRUD Operations

