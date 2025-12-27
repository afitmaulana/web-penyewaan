# TAHAP 3: AUTENTIKASI & ROLE MANAGEMENT - PANDUAN LENGKAP

## 📋 Ringkasan Implementasi

TAHAP 3 telah berhasil mengimplementasikan sistem autentikasi lengkap dengan fitur:
- ✅ Login/Register/Logout functionality
- ✅ Role-Based Access Control (Admin & Pelanggan)
- ✅ Session-based authentication
- ✅ Password hashing dengan bcrypt
- ✅ Filter-based route protection
- ✅ Form validation & error handling
- ✅ Flash messages untuk user feedback

---

## 🗂️ Struktur File Baru

```
app/
├── Models/
│   └── UserModel.php ........................ Model untuk user queries
├── Controllers/
│   ├── Auth.php ............................. Controller autentikasi
│   ├── Admin/
│   │   └── Dashboard.php .................... Admin dashboard
│   └── Pelanggan/
│       └── Dashboard.php .................... Customer dashboard
├── Filters/
│   ├── AuthFilter.php ....................... Filter untuk login check
│   ├── AdminFilter.php ...................... Filter untuk admin role
│   └── PelangganFilter.php .................. Filter untuk pelanggan role
├── Views/
│   ├── auth/
│   │   ├── login.php ........................ Updated login form
│   │   └── register.php ..................... Updated register form
│   ├── admin/
│   │   └── dashboard.php .................... Admin dashboard view
│   └── pelanggan/
│       └── dashboard.php .................... Customer dashboard view
└── Config/
    ├── Routes.php ........................... Updated dengan auth routes & groups
    └── Filters.php .......................... Updated dengan filter aliases
```

---

## 🔐 Fitur Autentikasi

### 1. **UserModel** - `app/Models/UserModel.php`

Model untuk mengelola operasi user di database.

**Methods:**
```php
// Mencari user berdasarkan email
findByEmail($email) : array|null

// Mencari active user berdasarkan email
findActiveByEmail($email) : array|null

// Update last login timestamp
updateLastLogin($userId) : boolean

// Register user baru (pelanggan)
register($data) : boolean

// Static: Verify password dengan hash
verifyPassword($rawPassword, $hashedPassword) : boolean
```

**Usage:**
```php
$userModel = new UserModel();

// Find user by email
$user = $userModel->findByEmail('admin@rentalkosiium.com');

// Verify password
if (UserModel::verifyPassword('password123', $user['password'])) {
    // Login berhasil
}
```

---

### 2. **Auth Controller** - `app/Controllers/Auth.php`

Controller utama untuk menangani login, register, dan logout.

**Routes & Methods:**

#### GET/POST `/login`
```php
public function login()
// Menampilkan form login
// Jika sudah login, redirect ke dashboard

public function processLogin()
// Validasi form
// Cek email & password
// Set session
// Update last login
// Redirect based on role
```

**Validation Rules:**
- Email: required, valid_email
- Password: required, min_length[8]

**Session Data yang di-set:**
```php
$session->set([
    'user_id'      => $user['id'],
    'user_name'    => $user['nama_lengkap'],
    'user_email'   => $user['email'],
    'role'         => $user['role']  // 'admin' atau 'pelanggan'
]);
```

#### GET/POST `/register`
```php
public function register()
// Menampilkan form register (pelanggan only)
// Jika sudah login, redirect ke dashboard

public function processRegister()
// Validasi form lengkap
// Hash password
// Create user dengan role 'pelanggan'
// Redirect ke login
```

**Validation Rules:**
- nama_lengkap: required, min_length[3], max_length[100]
- email: required, valid_email, is_unique[users.email]
- nomor_hp: required, min_length[10], max_length[15]
- alamat: required, min_length[10]
- kota: required, min_length[3]
- provinsi: required, min_length[3]
- kode_pos: required, min_length[5], max_length[10]
- password: required, min_length[8]
- password_confirm: required, matches[password]

#### POST `/logout`
```php
public function logout()
// Destroy session
// Redirect ke login dengan success message
```

**Private Methods:**
```php
private function getRedirectUrl()
// Return URL based on user role
// Admin   → 'admin/dashboard'
// Pelanggan → 'pelanggan/dashboard'
```

---

## 🔒 Route Protection dengan Filters

### 1. **AuthFilter** - `app/Filters/AuthFilter.php`

Memastikan user sudah login sebelum mengakses route tertentu.

```php
// Cek: session->get('user_id') exists
// Action: Redirect ke /login jika belum login
```

### 2. **AdminFilter** - `app/Filters/AdminFilter.php`

Memastikan user memiliki role 'admin'.

```php
// Cek 1: User sudah login (session->get('user_id'))
// Cek 2: Role === 'admin'
// Action: Redirect ke /pelanggan/dashboard jika bukan admin
```

### 3. **PelangganFilter** - `app/Filters/PelangganFilter.php`

Memastikan user memiliki role 'pelanggan'.

```php
// Cek 1: User sudah login (session->get('user_id'))
// Cek 2: Role === 'pelanggan'
// Action: Redirect ke /admin/dashboard jika bukan pelanggan
```

---

## 📍 Routes Configuration

### Updated `app/Config/Routes.php`

**Public Routes (No Authentication Required):**
```php
$routes->get('/', 'Home::index');                    // Homepage
$routes->get('login', 'Auth::login');                // Show login form
$routes->post('login', 'Auth::processLogin');        // Process login
$routes->get('register', 'Auth::register');          // Show register form
$routes->post('register', 'Auth::processRegister');  // Process register
```

**Admin Routes (Dengan AdminFilter):**
```php
$routes->group('admin', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
});
```

**Pelanggan Routes (Dengan PelangganFilter):**
```php
$routes->group('pelanggan', ['filter' => 'pelangganFilter'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index');
});
```

**Logout:**
```php
$routes->post('logout', 'Auth::logout');
```

---

## 🎨 Views Update

### Login Form - `app/Views/auth/login.php`

**Features:**
- Bootstrap 5 styling
- Form validation display
- Flash message display (success/error)
- Demo credentials info
- Link ke register form

**Fields:**
- Email (with validation)
- Password (with validation)
- Remember me checkbox

### Register Form - `app/Views/auth/register.php`

**Features:**
- Bootstrap 5 styling
- Comprehensive form validation
- Field validation error display
- Flash message display

**Fields:**
- Nama Lengkap
- Email (unique validation)
- Nomor HP
- Alamat (textarea)
- Kota & Provinsi (side by side)
- Kode Pos
- Password & Confirm Password

### Admin Dashboard - `app/Views/admin/dashboard.php`

**Features:**
- Welcome message dengan user name
- 4 stat cards (Total Pelanggan, Penyewaan Aktif, Total Kostum, Pendapatan)
- Admin menu dengan quick links
- Statistics section
- Logout button

### Pelanggan Dashboard - `app/Views/pelanggan/dashboard.php`

**Features:**
- Welcome message dengan user name
- 3 stat cards (Penyewaan Aktif, Total Penyewaan, Total Pengeluaran)
- Table dengan rental history
- Quick actions section
- Account management buttons
- Logout button

---

## 🧪 Testing & Demo

### Demo Credentials (dari Tahap 2 Seeders)

**Admin Account:**
```
Email: admin@rentalkosiium.com
Password: admin123
Role: admin
```

**Admin Account 2:**
```
Email: admin2@rentalkosiium.com
Password: admin123
Role: admin
```

### Testing Flow

#### 1. Login sebagai Admin
```
1. Go to: http://localhost:8080/login
2. Enter: admin@rentalkosiium.com / admin123
3. Klik: Login
4. Expected: Redirect ke /admin/dashboard
5. Verify: Halaman admin dashboard ditampilkan
```

#### 2. Login sebagai Pelanggan
```
1. Go to: http://localhost:8080/login
2. Enter: pelanggan@example.com / password123
3. Klik: Login
4. Expected: Redirect ke /pelanggan/dashboard
5. Verify: Halaman pelanggan dashboard ditampilkan
```

#### 3. Register Akun Baru
```
1. Go to: http://localhost:8080/register
2. Fill form dengan data:
   - Nama: John Doe
   - Email: john@example.com (harus unique)
   - HP: 081234567890
   - Alamat: Jl. Merdeka No. 123
   - Kota: Jakarta
   - Provinsi: DKI Jakarta
   - Kode Pos: 12345
   - Password: password123
   - Confirm: password123
3. Klik: Daftar Sekarang
4. Expected: Success message & redirect ke /login
5. Verify: Bisa login dengan akun baru
```

#### 4. Logout
```
1. Ketika sudah login, klik tombol: Logout
2. Expected: Session destroyed, redirect ke /login
3. Verify: Tidak bisa akses /admin/dashboard tanpa login
```

#### 5. Route Protection Test
```
1. Try access /admin/dashboard tanpa login
   → Expected: Redirect ke /login
2. Login sebagai pelanggan, try access /admin/dashboard
   → Expected: Redirect ke /pelanggan/dashboard
3. Login sebagai admin, try access /pelanggan/dashboard
   → Expected: Redirect ke /admin/dashboard
```

---

## ⚙️ Konfigurasi Session

Session sudah dikonfigurasi di Tahap 1 (`app/Config/Database.php`):

```php
// Session driver: DatabaseHandler
'sessionHandler' => \CodeIgniter\Session\Handlers\DatabaseHandler::class,

// Session table: ci_sessions
'sessionMatchIP'    => false,
'sessionTimeToUpdate' => 300,
'sessionRegenerateDestroy' => false,
'sessionEncrypt' => true,
```

---

## 🔑 Password Security

### Password Hashing
```php
// Hash password saat register/create
$hashedPassword = password_hash($rawPassword, PASSWORD_BCRYPT);

// Verify password saat login
if (password_verify($rawPassword, $hashedPassword)) {
    // Password valid
}
```

**Algorithm:** BCRYPT (default PHP password_hash)
**Strength:** Highly secure, resistant to brute force attacks

---

## 📊 Database Schema Reference

### Users Table
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama_lengkap VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nomor_hp VARCHAR(20) NOT NULL,
  alamat TEXT NOT NULL,
  kota VARCHAR(100),
  provinsi VARCHAR(100),
  kode_pos VARCHAR(10),
  role ENUM('admin', 'pelanggan') DEFAULT 'pelanggan',
  is_active TINYINT(1) DEFAULT 1,
  last_login TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🚀 Next Steps (Tahap 4+)

Setelah TAHAP 3, implementasi akan dilanjutkan dengan:

1. **Tahap 4:** CRUD Costume Catalog
   - List kostum
   - Detail kostum
   - Add/Edit/Delete kostum (admin only)

2. **Tahap 5:** Order/Rental Management
   - Create penyewaan
   - View penyewaan
   - Update status penyewaan

3. **Tahap 6:** Payment Integration
   - Pembayaran proses
   - Payment verification

4. **Tahap 7:** Admin Panel
   - Advanced admin features
   - Reports & Analytics

5. **Tahap 8:** Additional Features
   - Reviews & ratings
   - Notifications
   - Email notifications

---

## 🐛 Troubleshooting

### Error: "Email sudah terdaftar"
- Email yang digunakan sudah ada di database
- Gunakan email yang berbeda

### Error: "Email atau password tidak valid"
- Email tidak terdaftar atau password salah
- Verify email & password Anda

### Error: "Session not initialized"
- Pastikan session driver sudah konfigurasi di `.env`
- Periksa `app/Config/Database.php` untuk session handler

### Error: "Token mismatch"
- CSRF token invalid
- Pastikan form include `<?= csrf_field() ?>`

### Redirect loop infinite
- Periksa filter configuration di `app/Config/Filters.php`
- Pastikan filter aliases terdaftar dengan benar

---

## 📝 File Checklist

✅ `app/Models/UserModel.php` - User model dengan database queries
✅ `app/Controllers/Auth.php` - Auth controller untuk login/register/logout
✅ `app/Filters/AuthFilter.php` - Filter untuk cek login
✅ `app/Filters/AdminFilter.php` - Filter untuk cek admin role
✅ `app/Filters/PelangganFilter.php` - Filter untuk cek pelanggan role
✅ `app/Controllers/Admin/Dashboard.php` - Admin dashboard controller
✅ `app/Controllers/Pelanggan/Dashboard.php` - Pelanggan dashboard controller
✅ `app/Views/auth/login.php` - Updated login form
✅ `app/Views/auth/register.php` - Updated register form
✅ `app/Views/admin/dashboard.php` - Admin dashboard view
✅ `app/Views/pelanggan/dashboard.php` - Pelanggan dashboard view
✅ `app/Config/Routes.php` - Updated routes dengan groups & filters
✅ `app/Config/Filters.php` - Updated filters aliases

---

## 📞 Quick Reference

**Login Page:** `http://localhost:8080/login`
**Register Page:** `http://localhost:8080/register`
**Admin Dashboard:** `http://localhost:8080/admin/dashboard`
**Pelanggan Dashboard:** `http://localhost:8080/pelanggan/dashboard`

**Session Variables:**
- `$session->get('user_id')`
- `$session->get('user_name')`
- `$session->get('user_email')`
- `$session->get('role')`

---

**Status:** ✅ TAHAP 3 SELESAI
**Total Files Created/Updated:** 13 files
**Documentation:** Comprehensive guide provided
**Ready for:** Tahap 4 Implementation
