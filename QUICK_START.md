# 🚀 QUICK START - RENTAL KOSTUM PROJECT

Panduan cepat untuk mulai menggunakan aplikasi Rental Kostum.

---

## 1️⃣ SETUP PROJECT

### Step 1: Konfigurasi `.env`

Edit file `/web-penyewaan/.env`:

```dotenv
#--------------------------------------------------------------------
# ENVIRONMENT SETUP
#--------------------------------------------------------------------
CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP INFO
#--------------------------------------------------------------------
app.baseURL = 'http://localhost:8080/'
app.appTimezone = 'Asia/Jakarta'
app.forceGlobalSecureRequests = false

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = ci4_rental_kostum
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------
session.driver = 'DatabaseHandler'
session.cookieName = 'ci_session'
session.expiration = 7200
```

### Step 2: Buat Database MySQL

```sql
CREATE DATABASE ci4_rental_kostum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 3: Jalankan Development Server

```bash
cd /web-penyewaan
php spark serve
```

Output:
```
CodeIgniter v4.x.x Command Line Tool - Server Time: 2024-12-27 10:00:00 UTC+7

 [CLI] Spark will serve the app on http://127.0.0.1:8080
 [CLI] Press Control + C to stop running.
```

### Step 4: Akses Aplikasi

Buka browser dan ke: **http://localhost:8080**

---

## 2️⃣ STRUKTUR FOLDER PROJECT

```
web-penyewaan/
│
├── app/
│   ├── Config/               # Konfigurasi aplikasi
│   │   ├── Routes.php       # ✅ Rute aplikasi
│   │   ├── Database.php     # Konfigurasi database
│   │   ├── Services.php     # Services
│   │   └── ...
│   │
│   ├── Controllers/          # Controllers
│   │   ├── BaseController.php    # ✅ Base class untuk semua controller
│   │   ├── Home.php             # ✅ Homepage, login, register
│   │   ├── Dashboard.php        # ✅ Dashboard user
│   │   └── ...
│   │
│   ├── Models/              # Models (database)
│   │   └── (akan dibuat di Tahap 2)
│   │
│   └── Views/               # Template/View
│       ├── layout/          # Layout template
│       │   ├── header.php       # ✅ Meta tag, CSS
│       │   ├── navbar.php       # ✅ Navigation bar
│       │   ├── footer.php       # ✅ Footer, JS
│       │   └── layout_main.php  # ✅ Layout utama
│       │
│       └── pages/           # Halaman-halaman
│           ├── home.php         # ✅ Homepage
│           ├── auth/
│           │   ├── login.php    # ✅ Form login
│           │   └── register.php # ✅ Form register
│           └── dashboard/
│               └── index.php    # ✅ Dashboard
│
├── public/                  # Public assets
│   ├── css/
│   │   └── style.css        # ✅ Custom CSS
│   ├── js/
│   │   └── script.js        # ✅ Custom JavaScript
│   ├── images/              # Gambar
│   └── index.php            # Entry point
│
├── .env                     # ✅ Konfigurasi environment
├── spark                    # CLI tool CodeIgniter
├── composer.json            # PHP dependencies
└── ...
```

---

## 3️⃣ ROUTES / URL YANG TERSEDIA

| Method | URL | Controller::Method | Deskripsi |
|--------|-----|-------------------|-----------|
| GET | `/` | Home::index() | Homepage |
| GET | `/login` | Home::login() | Form login |
| POST | `/login` | Auth::processLogin() | Proses login *(belum ada)* |
| GET | `/register` | Home::register() | Form register |
| POST | `/register` | Auth::processRegister() | Proses register *(belum ada)* |
| GET | `/dashboard` | Dashboard::index() | Dashboard user |

---

## 4️⃣ CONTOH KODE PENTING

### ✅ Membuat Controller Baru

File: `app/Controllers/KatalogKostum.php`

```php
<?php

namespace App\Controllers;

/**
 * CLASS KatalogKostum
 * Controller untuk mengelola katalog kostum
 */
class KatalogKostum extends BaseController
{
    /**
     * METHOD: index()
     * Tampilkan semua katalog kostum
     */
    public function index()
    {
        $data = [
            'title' => 'Katalog Kostum'
        ];
        
        return view('pages/katalog/index', $data);
    }

    /**
     * METHOD: detail()
     * Tampilkan detail kostum tertentu
     */
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Kostum',
            'id' => $id
        ];
        
        return view('pages/katalog/detail', $data);
    }
}
```

### ✅ Membuat View dengan Layout

File: `app/Views/pages/katalog/index.php`

```php
<?php
/**
 * KATALOG/INDEX.PHP
 * Halaman list katalog kostum
 */

$this->extend('layout/layout_main');
$this->section('content');
?>

<h1 class="display-6 fw-bold mb-4">
    <i class="fas fa-list"></i> Katalog Kostum
</h1>

<div class="row g-4">
    <!-- Card Kostum 1 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Kostum Putri">
            <div class="card-body">
                <h5 class="card-title">Kostum Putri Pengantin</h5>
                <p class="text-muted small">Kostum pengantin tradisional</p>
                <h6 class="text-primary fw-bold">Rp 350.000 / hari</h6>
                <a href="#" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Card Kostum 2 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="https://via.placeholder.com/300" class="card-img-top" alt="Kostum Superhero">
            <div class="card-body">
                <h5 class="card-title">Kostum Superhero</h5>
                <p class="text-muted small">Kostum superhero populer</p>
                <h6 class="text-primary fw-bold">Rp 200.000 / hari</h6>
                <a href="#" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
```

### ✅ Menambah Route

File: `app/Config/Routes.php`

```php
// Route untuk katalog
$routes->get('katalog', 'KatalogKostum::index', ['as' => 'katalog']);
$routes->get('katalog/(:num)', 'KatalogKostum::detail/$1', ['as' => 'katalog.detail']);
```

### ✅ Menggunakan Helper di View

```php
<!-- URL helper -->
<a href="<?php echo base_url('login') ?>">Login</a>
<a href="<?php echo base_url('katalog') ?>">Katalog</a>

<!-- Form helper -->
<?php echo form_open('/login', ['method' => 'post']) ?>
    <?php echo form_label('Email', 'email') ?>
    <?php echo form_input('email') ?>
    <?php echo form_submit('submit', 'Login') ?>
<?php echo form_close() ?>
```

---

## 5️⃣ UTILITY JAVASCRIPT

File: `public/js/script.js` sudah provide beberapa fungsi:

### Menampilkan Alert

```javascript
// Success alert
showAlert('Data berhasil disimpan!', 'success');

// Error alert
showAlert('Terjadi kesalahan!', 'danger');

// Info alert
showAlert('Silakan login terlebih dahulu', 'info');
```

### Format Currency (Rupiah)

```javascript
let harga = 350000;
console.log(formatCurrency(harga));
// Output: Rp 350.000,00
```

### Format Date

```javascript
let tanggal = '2024-12-27';
console.log(formatDate(tanggal));
// Output: 27 Desember 2024
```

---

## 6️⃣ BOOTSTRAP 5 CHEATSHEET

### Button

```html
<!-- Tipe button -->
<button class="btn btn-primary">Primary</button>
<button class="btn btn-success">Success</button>
<button class="btn btn-danger">Danger</button>
<button class="btn btn-outline-primary">Outline</button>

<!-- Ukuran -->
<button class="btn btn-primary btn-lg">Large</button>
<button class="btn btn-primary btn-sm">Small</button>

<!-- Disabled -->
<button class="btn btn-primary" disabled>Disabled</button>
```

### Card

```html
<div class="card">
    <img src="..." class="card-img-top" alt="">
    <div class="card-body">
        <h5 class="card-title">Title</h5>
        <p class="card-text">Description</p>
        <a href="#" class="btn btn-primary">Link</a>
    </div>
</div>
```

### Form

```html
<form>
    <!-- Text input -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email">
    </div>

    <!-- Textarea -->
    <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" rows="3"></textarea>
    </div>

    <!-- Select -->
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-select" id="kategori">
            <option>Pilih...</option>
            <option>Kategori 1</option>
        </select>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

### Grid Layout

```html
<!-- Container -->
<div class="container">
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6">Kolom 6</div>
        <div class="col-md-6">Kolom 6</div>
    </div>

    <!-- Row responsive -->
    <div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3">Responsive</div>
    </div>
</div>
```

### Alert

```html
<div class="alert alert-success">Success!</div>
<div class="alert alert-danger">Error!</div>
<div class="alert alert-warning">Warning!</div>
<div class="alert alert-info">Info</div>

<!-- Dismissible -->
<div class="alert alert-info alert-dismissible fade show">
    Info
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
```

---

## 7️⃣ DEBUGGING TIPS

### Cek Route Mana yang Ada

```bash
php spark routes
```

Output:
```
+-----------+----+-------+--------+----+
| Method    | Route | Name | Handler | ... |
+-----------+----+-------+--------+----+
| GET       | /     | home | Home::index |
| GET|HEAD  | /login | login | Home::login |
+-----------+----+-------+--------+----+
```

### Cek Error di Browser

1. Buka `F12` → Tab `Console`
2. Lihat error messages di sana
3. Check terminal tempat `php spark serve` jalan

### Enable Debugging

Edit `.env`:
```
CI_ENVIRONMENT = development
```

Kemudian cek `/writable/logs/` untuk error logs.

---

## 🎯 TIPS & BEST PRACTICES

1. **Selalu extend BaseController**
   ```php
   class Home extends BaseController { }
   ```

2. **Gunakan Named Routes**
   ```php
   // Di Routes.php
   $routes->get('/', 'Home::index', ['as' => 'home']);
   
   // Di View
   <a href="<?php echo base_url('home') ?>">Home</a>
   ```

3. **Pisahkan Concerns**
   - Controller untuk logic
   - Model untuk database
   - View untuk template

4. **Use Data Passing**
   ```php
   $data = ['title' => 'Home', 'items' => []];
   return view('pages/home', $data);
   ```

5. **Validate Form Input**
   ```php
   // Di tahap 2 akan dijelaskan lebih detail
   $this->validate([
       'email' => 'required|valid_email',
       'password' => 'required|min_length[8]'
   ]);
   ```

---

## 📞 Kontakt & Support

Jika ada pertanyaan atau butuh bantuan, silakan tanyakan!

---

**Version:** 1.0.0  
**Last Updated:** 27 Dec 2024  
**Framework:** CodeIgniter 4 + Bootstrap 5
