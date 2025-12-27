# 🎭 APLIKASI WEB RENTAL KOSTUM - CodeIgniter 4

Aplikasi web untuk mengelola sistem penyewaan kostum secara online.

---

## 📖 Daftar Isi

- [Fitur](#-fitur)
- [Tech Stack](#-tech-stack)
- [Instalasi](#-instalasi)
- [Struktur Project](#-struktur-project)
- [Dokumentasi](#-dokumentasi)
- [Roadmap](#-roadmap)
- [License](#-license)

---

## ✨ Fitur

### ✅ Tahap 1: Setup Dasar (SELESAI)
- [x] Konfigurasi project CodeIgniter 4
- [x] Layout template dengan Bootstrap 5
- [x] Halaman publik (Home, Login, Register, Dashboard)
- [x] Responsive design
- [x] Navbar dan footer
- [x] Basic JavaScript utilities

### 📋 Tahap 2: Database & Authentication (COMING SOON)
- [ ] Buat database schema dengan migrations
- [ ] User registration & email verification
- [ ] Login dengan session management
- [ ] Password hashing (bcrypt)
- [ ] Admin panel setup
- [ ] Role & permission system

### 🛍️ Tahap 3: CRUD Kostum (COMING SOON)
- [ ] List kostum dengan filter & search
- [ ] Detail kostum dengan galeri gambar
- [ ] Admin: Tambah/edit/hapus kostum
- [ ] Kategori kostum
- [ ] Stock management
- [ ] Upload gambar costum

### 📦 Tahap 4: Sistem Pesanan (COMING SOON)
- [ ] Shopping cart
- [ ] Checkout process
- [ ] Order management
- [ ] Payment gateway integration
- [ ] Invoice generation
- [ ] Email notifications
- [ ] Order tracking

### ⭐ Tahap 5: Fitur Lanjutan (COMING SOON)
- [ ] Review & rating system
- [ ] Wishlist
- [ ] Promo & coupon
- [ ] Analytics dashboard
- [ ] SMS notifications
- [ ] Mobile app API

---

## 🛠️ Tech Stack

### Backend
- **Framework:** CodeIgniter 4.4+
- **Language:** PHP 7.4+
- **Database:** MySQL 5.7+
- **Server:** Apache/Nginx

### Frontend
- **CSS Framework:** Bootstrap 5
- **Icons:** Font Awesome 6
- **JavaScript:** Vanilla JS + Bootstrap JS
- **Responsive:** Mobile-first design

### Tools & Libraries
- **Composer** - PHP package manager
- **PHPUnit** - Testing framework
- **Spark CLI** - CodeIgniter command line

---

## 📦 Instalasi

### Prerequisites
- PHP 7.4+ (dengan extensions: intl, sqlite3, mbstring)
- MySQL 5.7+
- Composer
- Git

### Step 1: Clone Repository
```bash
git clone https://github.com/yourusername/rental-kostum.git
cd rental-kostum/web-penyewaan
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Konfigurasi Environment
```bash
cp .env.example .env
```

Edit `.env`:
```dotenv
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = ci4_rental_kostum
database.default.username = root
database.default.password = 
```

### Step 4: Buat Database
```bash
mysql -u root -p
CREATE DATABASE ci4_rental_kostum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 5: Jalankan Server
```bash
php spark serve
```

Akses aplikasi di **http://localhost:8080**

---

## 📁 Struktur Project

```
rental-kostum/
│
├── web-penyewaan/              # Root project
│   │
│   ├── app/
│   │   ├── Config/
│   │   │   ├── Routes.php      # Konfigurasi routing
│   │   │   ├── Database.php    # Konfigurasi database
│   │   │   └── ...
│   │   │
│   │   ├── Controllers/
│   │   │   ├── BaseController.php
│   │   │   ├── Home.php
│   │   │   ├── Dashboard.php
│   │   │   └── ...
│   │   │
│   │   ├── Models/             # (akan diimplementasi di Tahap 2)
│   │   │
│   │   ├── Views/
│   │   │   ├── layout/         # Layout template
│   │   │   └── pages/          # Halaman-halaman
│   │   │
│   │   ├── Database/
│   │   │   └── Migrations/     # (akan diimplementasi di Tahap 2)
│   │   │
│   │   └── Filters/            # (akan diimplementasi di Tahap 2)
│   │
│   ├── public/
│   │   ├── css/
│   │   │   └── style.css       # Custom CSS
│   │   ├── js/
│   │   │   └── script.js       # Custom JavaScript
│   │   ├── images/
│   │   └── index.php           # Entry point
│   │
│   ├── vendor/                 # Composer packages
│   ├── writable/               # Cache, logs, uploads
│   ├── tests/                  # Unit tests
│   │
│   ├── .env                    # Environment configuration
│   ├── .gitignore
│   ├── composer.json
│   ├── spark                   # CLI tool
│   │
│   ├── TAHAP_1_DOKUMENTASI.md
│   ├── QUICK_START.md
│   ├── DATABASE_DESIGN.sql
│   └── README.md               # File ini
│
└── docs/                       # Additional documentation
```

---

## 📚 Dokumentasi

Dokumentasi lengkap tersedia dalam file-file berikut:

### 📖 [TAHAP_1_DOKUMENTASI.md](TAHAP_1_DOKUMENTASI.md)
Dokumentasi lengkap Tahap 1 setup:
- Penjelasan file `.env`
- Routes configuration
- Controllers & Views
- Layout template system
- Konvensi penulisan kode
- Tips debugging

### 🚀 [QUICK_START.md](QUICK_START.md)
Panduan cepat untuk mulai:
- Setup checklist
- Struktur folder
- Routes reference
- Contoh kode
- Bootstrap 5 cheatsheet
- Debugging tips

### 📊 [DATABASE_DESIGN.sql](DATABASE_DESIGN.sql)
Design database untuk Tahap 2:
- Schema semua tabel
- Relationship diagrams
- Sample queries
- Dokumentasi field

---

## 🚀 Cara Menggunakan

### Menjalankan Development Server
```bash
php spark serve
```

### Membuat Controller Baru
```bash
php spark make:controller NamaController
```

### Membuat Model Baru
```bash
php spark make:model NamaModel
```

### Membuat Migration
```bash
php spark make:migration CreateTableName
```

### Menjalankan Tests
```bash
php spark test
```

### Cek Routes
```bash
php spark routes
```

---

## 📝 Contoh Implementasi

### Membuat Halaman Baru

#### 1. Buat View: `app/Views/pages/tentang.php`
```php
<?php
$this->extend('layout/layout_main');
$this->section('content');
?>

<h1><?php echo $title; ?></h1>
<p><?php echo $description; ?></p>

<?php $this->endSection(); ?>
```

#### 2. Buat Route: `app/Config/Routes.php`
```php
$routes->get('tentang', 'Home::tentang', ['as' => 'tentang']);
```

#### 3. Buat Method di Controller: `app/Controllers/Home.php`
```php
public function tentang()
{
    $data = [
        'title' => 'Tentang Kami',
        'description' => 'Halaman tentang kami...'
    ];
    return view('pages/tentang', $data);
}
```

#### 4. Akses: `http://localhost:8080/tentang`

---

## 🐛 Debugging

### Enable Debug Mode
Edit `.env`:
```
CI_ENVIRONMENT = development
```

### Cek Browser Console
Buka `F12` → Tab `Console` → Lihat error messages

### Cek Server Logs
```bash
# Terminal tempat spark serve jalan

# atau lihat file logs
tail -f writable/logs/log-*.log
```

### Gunakan Spark Commands
```bash
php spark routes          # Lihat semua routes
php spark db:seed         # Run seeders
php spark migrate         # Run migrations
```

---

## 📋 Roadmap

### Q1 2025: Tahap 1-2 ✅
- ✅ Setup project & layout (Tahap 1)
- 🔄 Database & Authentication (Tahap 2)

### Q1 2025: Tahap 3-4
- 📋 CRUD Kostum & Katalog (Tahap 3)
- 📦 Order & Payment System (Tahap 4)

### Q2 2025: Tahap 5+
- ⭐ Advanced Features
- 📱 Mobile API
- 📊 Analytics Dashboard

---

## 🤝 Contributing

Kontribusi sangat diterima! Silakan:

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

---

## 📧 Support & Contact

Jika ada pertanyaan atau menemukan bug:

- **Email:** support@rentalkostum.com
- **Issues:** Buka issue di repository ini
- **Documentation:** Lihat dokumentasi di folder ini

---

## 📜 License

Project ini dilisensikan di bawah MIT License. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

## 👨‍💻 Authors

- **Your Name** - *Senior PHP Developer*

---

## 🙏 Acknowledgments

- CodeIgniter 4 framework
- Bootstrap 5
- Font Awesome icons
- PHP community

---

## 📞 Changelog

### Version 1.0.0 (27 Dec 2024) - Tahap 1
- ✅ Initial project setup
- ✅ Layout template with Bootstrap 5
- ✅ Basic routing & controllers
- ✅ Public pages (Home, Login, Register, Dashboard)
- ✅ Responsive design
- ✅ CSS & JavaScript utilities

---

**Happy Coding! 🎉**

Jika ada pertanyaan, jangan ragu untuk bertanya. Dokumentasi lengkap tersedia di file-file di atas.

---

*Last Updated: 27 Dec 2024*  
*Project: Rental Kostum - CodeIgniter 4*  
*Version: 1.0.0 (Tahap 1 - Setup Dasar)*
