# 📚 DOKUMENTASI TAHAP 1 - SETUP DASAR PROJECT RENTAL KOSTUM

## 🎯 Ringkasan Tahap 1

Tahap 1 ini fokus pada **Setup Dasar Project** - mempersiapkan fondasi aplikasi yang rapi, terstruktur, dan siap untuk pengembangan fitur lebih lanjut.

---

## 📋 File yang Telah Dibuat/Updated

### 1️⃣ **Konfigurasi Project**

#### `.env` (File Konfigurasi Environment)
**Lokasi:** `/web-penyewaan/.env`

**Fungsi:** Menyimpan konfigurasi sensitif seperti database credentials, base URL, dll.

**Poin Penting:**
```
CI_ENVIRONMENT = development          # Mode development (bukan production)
app.baseURL = 'http://localhost:8080/'  # Sesuaikan dengan server lokal Anda
database.default.database = ci4_rental_kostum  # Nama database
database.default.username = root       # Username MySQL (default)
database.default.password =            # Password MySQL (kosong untuk localhost)
```

**⚠️ PENTING:** 
- Jangan commit `.env` ke Git (sudah di .gitignore)
- Ubah `app.baseURL` sesuai dengan server Anda
- Untuk production, ubah `CI_ENVIRONMENT = production`

---

### 2️⃣ **Routing**

#### `app/Config/Routes.php`
**Fungsi:** Mendefinisikan semua rute/URL aplikasi

**Routes yang Tersedia:**
```php
GET  /                → Home::index()      // Homepage
GET  /login           → Auth::login()      // Form login
POST /login           → Auth::processLogin // Proses login (belum ada)
GET  /register        → Auth::register()   // Form register
POST /register        → Auth::processRegister // Proses register (belum ada)
GET  /dashboard       → Dashboard::index() // Dashboard user
```

**💡 Tips:**
- Gunakan named routes: `base_url('home')` alih-alih `base_url('/')`
- Route lebih mudah di-refactor dengan named routes
- Fitur autentikasi dan CRUD akan ditambahkan di tahap berikutnya

---

### 3️⃣ **Controllers**

#### `app/Controllers/BaseController.php`
**Fungsi:** Base class untuk semua controller - berfungsi untuk initialize global setup

**Fitur:**
- ✅ Helpers yang dimuat otomatis (url, form)
- ✅ Session management
- ✅ Method utility `setData()`

**Cara Menggunakan:**
```php
class Home extends BaseController {
    public function index() {
        // $this->session sudah tersedia
        // Helper url, form sudah tersedia
    }
}
```

#### `app/Controllers/Home.php`
**Fungsi:** Controller untuk halaman publik (homepage, login, register)

**Methods:**
- `index()` - Tampilkan homepage
- `login()` - Tampilkan form login
- `register()` - Tampilkan form register

#### `app/Controllers/Dashboard.php`
**Fungsi:** Controller untuk halaman dashboard (user sudah login)

**Methods:**
- `index()` - Tampilkan dashboard utama

---

### 4️⃣ **Views / Template**

#### Layout Structure
```
app/Views/
├── layout/
│   ├── header.php          # Meta tag, CSS, DOCTYPE
│   ├── navbar.php          # Navigation bar
│   ├── footer.php          # Footer, JS, closing tags
│   └── layout_main.php     # Layout utama (extends handler)
├── pages/
│   ├── home.php            # Homepage
│   ├── auth/
│   │   ├── login.php       # Form login
│   │   └── register.php    # Form register
│   └── dashboard/
│       └── index.php       # Dashboard utama
```

#### `app/Views/layout/layout_main.php`
**Sistem Template CI4:**
```php
// Di controller, return view dengan layout:
return view('pages/home', $data);

// Di halaman (home.php):
<?php $this->extend('layout/layout_main'); ?>
<?php $this->section('content'); ?>
  ... konten halaman ...
<?php $this->endSection(); ?>
```

**🔄 Cara Kerja:**
1. `layout_main.php` include header, navbar, footer
2. Content halaman dirender di section `content`
3. Header dan footer digunakan di semua halaman

#### Views yang Tersedia:
- **`pages/home.php`** - Homepage dengan hero section dan fitur
- **`pages/auth/login.php`** - Form login yang rapi
- **`pages/auth/register.php`** - Form register dengan validasi
- **`pages/dashboard/index.php`** - Dashboard dengan stats dan tabel pesanan

---

### 5️⃣ **Frontend Assets**

#### `public/css/style.css`
**Fitur:**
- Custom styling di atas Bootstrap 5
- Responsive design
- Hover effects
- Custom colors dan typography

#### `public/js/script.js`
**Fitur:**
- Bootstrap components initialization
- Form validation
- Utility functions:
  - `showAlert()` - Tampilkan notifikasi
  - `formatCurrency()` - Format Rupiah
  - `formatDate()` - Format tanggal ke bahasa Indonesia

---

## 📦 Dependencies

Semua yang Anda butuhkan sudah include melalui CDN:

```html
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Font Awesome 6 (Icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
```

---

## 🚀 Cara Menjalankan Aplikasi

### 1. Persiapkan Database MySQL

```sql
-- Buat database
CREATE DATABASE ci4_rental_kostum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Atau gunakan CLI CodeIgniter (nanti di tahap migrations)
```

### 2. Update File `.env`

Edit `/web-penyewaan/.env`:
```
app.baseURL = 'http://localhost:8080/'  # Sesuaikan dengan server
database.default.hostname = localhost    # Host MySQL
database.default.database = ci4_rental_kostum  # Nama DB
database.default.username = root         # Username
database.default.password =              # Password (kosong jika localhost)
```

### 3. Jalankan Development Server

```bash
# Di root project directory
php spark serve

# Server akan jalan di http://localhost:8080
```

### 4. Akses Aplikasi

- **Homepage:** http://localhost:8080/
- **Login:** http://localhost:8080/login
- **Register:** http://localhost:8080/register
- **Dashboard:** http://localhost:8080/dashboard

---

## 🎨 Design System / Styling

### Colors
- **Primary:** `#007bff` (Blue) - untuk button, link
- **Success:** `#28a745` (Green) - untuk notifikasi sukses
- **Danger:** `#dc3545` (Red) - untuk error
- **Warning:** `#ffc107` (Yellow) - untuk warning
- **Info:** `#17a2b8` (Cyan) - untuk informasi

### Bootstrap 5 Utilities
```php
<!-- Container -->
<div class="container">...</div>
<div class="container-fluid">...</div>

<!-- Grid -->
<div class="row">
  <div class="col-md-6">...</div>
</div>

<!-- Buttons -->
<button class="btn btn-primary btn-lg">...</button>

<!-- Cards -->
<div class="card">
  <div class="card-body">...</div>
</div>
```

---

## 📝 Konvensi Penulisan Kode

### Controllers
```php
<?php
namespace App\Controllers;

class ControllerName extends BaseController {
    /**
     * METHOD: methodName()
     * Penjelasan singkat tentang method ini
     * 
     * @return string|array
     */
    public function methodName() {
        $data = [
            'title' => 'Page Title'
        ];
        return view('view_path', $data);
    }
}
```

### Views
```php
<?php
/**
 * FILE: view_name.php
 * Penjelasan view ini
 */

$this->extend('layout/layout_main');
$this->section('content');
?>

<!-- HTML Content -->

<?php $this->endSection(); ?>
```

### Comments
```php
// ============================================
// SECTION TITLE
// ============================================

// Single line comment
$variable = 'value';

/**
 * Multi-line comment
 * Untuk method, class, dll
 */
```

---

## 🛠️ Debugging & Development Tips

### 1. Enable Debug Mode
Edit `.env`:
```
CI_ENVIRONMENT = development
```

### 2. Check Errors
- Browser console: `F12` → Console tab
- Server errors: Cek terminal tempat `php spark serve` jalan
- Aplikasi logs: `/writable/logs/`

### 3. Useful Spark Commands
```bash
# List semua routes
php spark routes

# Generate controller
php spark make:controller ControllerName

# Generate model
php spark make:model ModelName

# Run migrations
php spark migrate

# Create migration
php spark make:migration CreateTableName
```

---

## 📋 Checklist Tahap 1

- ✅ `.env` dikonfigurasi dengan database
- ✅ Routes dasar sudah dibuat
- ✅ BaseController setup
- ✅ Layout template dengan Bootstrap 5
- ✅ Halaman: Home, Login, Register, Dashboard
- ✅ CSS dan JavaScript dasar
- ✅ Responsive design

---

## ✨ Tahap Berikutnya (Tahap 2 - Coming Soon)

Setelah Tahap 1 selesai, kita akan lanjut ke:

### 📌 Tahap 2: Database & Authentication
- [ ] Buat tabel users (migrations)
- [ ] Buat tabel roles & permissions
- [ ] Implement login & register processing
- [ ] Password hashing dengan bcrypt
- [ ] Session management
- [ ] Auth filter untuk halaman protected

### 📌 Tahap 3: CRUD Kostum
- [ ] Tabel kostum di database
- [ ] Upload gambar kostum
- [ ] CRUD operasi (Create, Read, Update, Delete)
- [ ] List & detail kostum

### 📌 Tahap 4: Sistem Pesanan
- [ ] Tabel pesanan
- [ ] Shopping cart
- [ ] Proses checkout
- [ ] Status pesanan
- [ ] Invoice & payment

---

## 📚 Referensi & Resource

- **CodeIgniter 4 Doc:** https://codeigniter.com/user_guide/
- **Bootstrap 5 Doc:** https://getbootstrap.com/docs/5.0/
- **Font Awesome:** https://fontawesome.com/
- **PHP Manual:** https://www.php.net/manual/

---

**🎉 Selamat! Tahap 1 sudah selesai!**

Struktur project Anda sekarang rapi, terorganisir, dan siap untuk pengembangan fitur lebih lanjut.

Pertanyaan atau butuh bantuan? Silakan tanyakan! 😊

---

*Last Updated: 27 Dec 2024*
*Project: Rental Kostum - CodeIgniter 4*
