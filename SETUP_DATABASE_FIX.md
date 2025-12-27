# 🔧 PERBAIKAN ERROR SESSION & SETUP GUIDE

## ✅ Error yang Sudah Diperbaiki

### Error: "Invalid session handler "DatabaseHandler" provided"

**Penyebab:** File `.env` memiliki konfigurasi session handler yang salah:
```
session.driver = 'DatabaseHandler'  ❌ SALAH
```

**Solusi:** Sudah diperbaiki menjadi:
```
session.driver = 'file'  ✅ BENAR
```

---

## 📋 Setup Database - Langkah Demi Langkah

### Step 1: Pastikan MySQL Running

**Windows:**
```bash
# Pastikan MySQL Service running
# Buka Services (services.msc) atau gunakan command:
net start MySQL80
```

**atau gunakan:**
```bash
# Jika pakai XAMPP
xampp_start.exe
```

### Step 2: Verify Database Connection

Test koneksi database dengan:
```bash
# Di folder project
php spark db:info
```

Harusnya menunjukkan:
```
Database Configuration
  Group Name .................... default
  Connection Driver ............. MySQLi
  Hostname ...................... localhost
  Database ...................... ci4_rental_kostum
  Port .......................... 3306
```

### Step 3: Buat Database (jika belum ada)

**Option A - Via MySQL Command:**
```sql
CREATE DATABASE ci4_rental_kostum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Option B - Via PhpMyAdmin:**
- Buka: http://localhost/phpmyadmin
- Klik "New"
- Nama: `ci4_rental_kostum`
- Collation: `utf8mb4_unicode_ci`
- Klik "Create"

### Step 4: Jalankan Migrations

```bash
php spark migrate
```

Expected output:
```
CodeIgniter v4.6.4 Command Line Tool - Server Time: 2025-12-27 ...

Running all new migrations...

Done
```

### Step 5: Jalankan Seeders

```bash
# Seed admin users
php spark db:seed AdminSeeder

# Seed costume categories
php spark db:seed KategoriSeeder

# Seed sample costumes
php spark db:seed KostumSeeder
```

---

## 🧪 Test Authentication

### Test Login

1. **Buka login page:**
   ```
   http://localhost:8080/login
   ```

2. **Gunakan demo credentials:**
   ```
   Email: admin@rentalkosiium.com
   Password: admin123
   ```

3. **Expected result:**
   - Redirect ke `/admin/dashboard`
   - Lihat dashboard admin dengan stats

### Test Register

1. **Buka register page:**
   ```
   http://localhost:8080/register
   ```

2. **Isi form dengan data baru:**
   ```
   Nama: John Doe
   Email: john@example.com
   Phone: 081234567890
   Address: Jl. Merdeka 123
   City: Jakarta
   Province: DKI
   Zip: 12345
   Password: password123
   Confirm: password123
   ```

3. **Expected result:**
   - Success message
   - Redirect ke login
   - Bisa login dengan akun baru

---

## 🔍 Troubleshooting

### Error: "Unable to connect to the database"

**Solutions:**

1. **Check MySQL Service:**
   ```bash
   # Windows - Cek apakah MySQL running
   tasklist | findstr mysql
   
   # Jika tidak ada, start MySQL
   net start MySQL80
   ```

2. **Check .env credentials:**
   ```
   database.default.hostname = localhost
   database.default.database = ci4_rental_kostum
   database.default.username = root
   database.default.password = (biarkan kosong jika tidak ada password)
   ```

3. **Test connection:**
   ```bash
   php spark db:info
   ```

### Error: "Table 'ci4_rental_kostum' doesn't exist"

**Solutions:**

1. **Create database:**
   ```sql
   CREATE DATABASE ci4_rental_kostum CHARACTER SET utf8mb4;
   ```

2. **Run migrations:**
   ```bash
   php spark migrate
   ```

### Error: "Call to undefined method..."

**Solutions:**

1. **Clear cache:**
   ```bash
   php spark cache:clear
   ```

2. **Composer update:**
   ```bash
   composer update
   ```

3. **Clear writable folder:**
   ```bash
   # Hapus semua file di writable/cache dan writable/logs
   ```

---

## ✅ Verification Checklist

- [x] Session driver sudah diperbaiki (file)
- [ ] MySQL service running
- [ ] Database `ci4_rental_kostum` sudah dibuat
- [ ] Migrations sudah dijalankan
- [ ] Seeders sudah dijalankan
- [ ] Bisa akses /login (tanpa error)
- [ ] Bisa login dengan demo credentials
- [ ] Bisa akses /admin/dashboard
- [ ] Bisa register akun baru

---

## 📚 Files Affected

✅ **Fixed:** `.env`
- Changed: `session.driver = 'DatabaseHandler'` → `session.driver = 'file'`

**Not changed:** 
- `app/Config/Session.php` - Already correct
- `app/Controllers/Auth.php` - Already correct
- `app/Filters/*.php` - Already correct

---

## 🚀 Next Steps

1. **Pastikan MySQL running**
2. **Jalankan migrations:** `php spark migrate`
3. **Jalankan seeders:** `php spark db:seed AdminSeeder`
4. **Test login:** `http://localhost:8080/login`
5. **Gunakan demo credentials untuk test**

---

## 💡 Tips

- Selalu pastikan MySQL service running sebelum jalankan spark commands
- Jika ada error "access denied", check username/password di .env
- Jika ada error "unknown database", create database terlebih dahulu
- Untuk production, ubah `CI_ENVIRONMENT` menjadi `production`

---

**Status:** ✅ Session Configuration Fixed
**Next:** Setup database connection

Segera lanjutkan dengan langkah-langkah di atas untuk menyelesaikan setup!
