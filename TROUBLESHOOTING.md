# 🔧 TROUBLESHOOTING GUIDE - RENTAL KOSTUM

Panduan untuk mengatasi masalah yang mungkin terjadi.

---

## ❌ Common Issues & Solutions

### 1️⃣ Server Tidak Bisa Jalan

#### Masalah: `php spark serve` tidak bekerja
```
[ERROR] Could not open input file: C:\...\spark
```

**Solusi:**
1. Pastikan Anda di folder project yang benar
   ```bash
   cd /web-penyewaan
   ```

2. Cek versi PHP
   ```bash
   php --version
   ```
   (Harus PHP 7.4+)

3. Jalankan ulang dengan absolute path
   ```bash
   C:\xampp\php\php.exe spark serve
   ```

---

### 2️⃣ Database Connection Error

#### Masalah: Error: "SQLSTATE[HY000]"
```
[ERROR] SQLSTATE[HY000]: General error: 2002 No such file or directory
```

**Solusi:**
1. Cek MySQL sedang jalan
   - Windows: Cek XAMPP Control Panel
   - Linux: `sudo systemctl start mysql`

2. Update `.env` dengan credentials yang benar
   ```
   database.default.hostname = localhost
   database.default.database = ci4_rental_kostum
   database.default.username = root
   database.default.password = 
   ```

3. Buat database jika belum ada
   ```bash
   mysql -u root -p
   CREATE DATABASE ci4_rental_kostum;
   ```

---

### 3️⃣ Page Not Found / 404 Error

#### Masalah: Error 404 saat akses halaman
```
The page you are looking for could not be found.
```

**Solusi:**
1. Cek routing di `app/Config/Routes.php`
   - Pastikan route sudah didefinisikan
   - Cek spelling URL

2. Verify routes dengan command
   ```bash
   php spark routes
   ```

3. Cek URL di browser
   ```
   http://localhost:8080/  ← Benar
   http://localhost:8080   ← Salah (tanpa trailing slash)
   ```

---

### 4️⃣ View File Not Found

#### Masalah: Error "Could not find the file..."
```
[ERROR] View file does not exist: /path/to/view.php
```

**Solusi:**
1. Cek file view ada di folder yang benar
   - Harus di: `app/Views/`
   - Cek spelling: Case-sensitive!

2. Cek path di controller
   ```php
   return view('pages/home', $data);  // ✅ Benar
   return view('pages/Home', $data);  // ❌ Salah
   ```

3. Verifikasi struktur folder
   ```
   app/Views/
   ├── layout/
   ├── pages/
   │   ├── home.php
   │   ├── auth/
   │   │   ├── login.php
   │   │   └── register.php
   │   └── dashboard/
   │       └── index.php
   ```

---

### 5️⃣ CSS / JavaScript Tidak Dimuat

#### Masalah: Styling hilang, JS tidak jalan
```
Failed to load resource: the server responded with a status of 404
(Untuk file CSS/JS)
```

**Solusi:**
1. Cek file ada di folder `public/`
   ```
   public/
   ├── css/
   │   └── style.css
   ├── js/
   │   └── script.js
   └── index.php
   ```

2. Cek path di header.php
   ```php
   <link rel="stylesheet" href="<?php echo base_url('css/style.css') ?>">
   <script src="<?php echo base_url('js/script.js') ?>"></script>
   ```

3. Clear browser cache
   - Ctrl + Shift + Delete (Chrome)
   - Atau akses dengan Ctrl + F5

4. Cek permission folder
   ```bash
   chmod 755 public/
   chmod 644 public/css/style.css
   chmod 644 public/js/script.js
   ```

---

### 6️⃣ Layout Tidak Loading

#### Masalah: Layout/header/footer tidak tampil
```
Halaman kosong atau hanya showing content tanpa layout
```

**Solusi:**
1. Cek `layout_main.php`
   ```php
   <?php include 'header.php'; ?>
   <?php include 'navbar.php'; ?>
   <!-- content di sini -->
   <?php include 'footer.php'; ?>
   ```

2. Cek view extend layout dengan benar
   ```php
   <?php $this->extend('layout/layout_main'); ?>
   <?php $this->section('content'); ?>
   ...content...
   <?php $this->endSection(); ?>
   ```

3. Cek path layout di folder
   ```
   app/Views/layout/
   ├── header.php ✓
   ├── navbar.php ✓
   ├── footer.php ✓
   └── layout_main.php ✓
   ```

---

### 7️⃣ Bootstrap Not Working

#### Masalah: Bootstrap styling tidak muncul
```
Tombol terlihat biasa, grid tidak responsive
```

**Solusi:**
1. Cek Bootstrap CDN dimuat di header.php
   ```html
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   ```

2. Cek Bootstrap JS di footer.php
   ```html
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   ```

3. Verify internet connection (CDN needs internet)
   - Coba akses CDN link di browser

4. Jika offline, download Bootstrap secara manual
   - Download dari: https://getbootstrap.com/
   - Extract ke `public/bootstrap/`
   - Update path di header/footer

---

### 8️⃣ "Class BaseController Not Found"

#### Masalah: Error saat include BaseController
```
[ERROR] Class 'App\Controllers\BaseController' not found
```

**Solusi:**
1. Cek file exists
   ```
   app/Controllers/BaseController.php ✓
   ```

2. Cek namespace di file
   ```php
   <?php
   namespace App\Controllers;
   // ✓ Benar
   ```

3. Cek controller extends dengan benar
   ```php
   class Home extends BaseController {
       // ✓ Benar - tidak perlu include/use
   }
   ```

4. Jalankan composer autoload
   ```bash
   composer dump-autoload
   ```

---

### 9️⃣ Session Not Working

#### Masalah: Session data tidak tersimpan
```
$_SESSION data hilang antar page
```

**Solusi:**
1. Cek session di `.env`
   ```
   session.driver = 'DatabaseHandler'
   session.cookieName = 'ci_session'
   ```

2. Cek session dimulai di BaseController
   ```php
   $this->session = \Config\Services::session();
   ```

3. Gunakan session dengan benar
   ```php
   // Set session
   $this->session->set('user_id', 123);
   
   // Get session
   $user_id = $this->session->get('user_id');
   ```

4. Cek writable folder dapat akses
   ```bash
   chmod 755 writable/
   chmod 755 writable/session/
   ```

---

### 🔟 Permission Denied Error

#### Masalah: Error saat write file
```
[ERROR] Permission denied at /writable/logs/...
```

**Solusi - Linux/Mac:**
```bash
chmod -R 755 writable/
chmod -R 644 writable/logs/
chmod -R 644 writable/cache/
```

**Solusi - Windows:**
```bash
# Click folder kanan → Properties → Security
# Edit → Tambah Full Control untuk user
```

**Solusi - XAMPP:**
```
Jalankan XAMPP as Administrator
```

---

## 🔍 Debugging Techniques

### 1. Enable Debug Mode
Edit `.env`:
```
CI_ENVIRONMENT = development
```

### 2. Check Browser Console
```
F12 → Console → Lihat error messages
```

### 3. Check Server Error Log
```bash
# Cek log file
tail -f writable/logs/log-*.log

# atau di Windows
type writable\logs\log-*.log
```

### 4. Use var_dump untuk Debug
```php
// Di controller
var_dump($data);
die();
```

### 5. Check HTML Source
```
Ctrl + U di browser → Lihat HTML yang di-render
```

### 6. Use Browser DevTools
```
F12 → Network tab → Lihat request/response
```

---

## 🛠️ Useful Commands

### Check All Routes
```bash
php spark routes
```

### Generate Controller
```bash
php spark make:controller ControllerName
```

### Generate Model
```bash
php spark make:model ModelName
```

### Clear Cache
```bash
php spark cache:clear
```

### Database Check
```bash
php spark db:create ci4_rental_kostum
```

### Run Tests
```bash
php spark test
```

---

## 📋 Quick Checklist for Troubleshooting

Saat error muncul, cek:

- [ ] PHP version >= 7.4
- [ ] MySQL running
- [ ] `.env` configured correctly
- [ ] Database exists
- [ ] All files in correct folder
- [ ] No typos in file/class names
- [ ] Routes defined
- [ ] Controllers extended BaseController
- [ ] Views using correct extends/section
- [ ] CSS/JS paths using base_url()
- [ ] Bootstrap CDN loaded (if using)
- [ ] Writable folder has permissions
- [ ] No whitespace before `<?php`
- [ ] Semicolons at end of statements

---

## 🚨 Still Having Issues?

Jika error masih terjadi:

1. **Google error message** - Copy-paste error di Google
2. **Check documentation**
   - CodeIgniter 4: https://codeigniter.com/user_guide/
   - Bootstrap 5: https://getbootstrap.com/docs/
3. **Ask for help**
   - Stack Overflow
   - CodeIgniter forums
   - Developer community

---

## 📞 Contact Support

Untuk bantuan lebih lanjut:
- Email: support@rentalkostum.com
- Issues: Buka issue di GitHub repository

---

**Good luck! 🍀**

*Last Updated: 27 Dec 2024*
