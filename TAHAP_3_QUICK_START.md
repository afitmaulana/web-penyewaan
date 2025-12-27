# TAHAP 3: QUICK START GUIDE

## ⚡ 5 Menit Setup

### 1. Database Migration
Pastikan Tahap 2 sudah selesai dan database sudah ter-setup:

```bash
php spark migrate
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder
```

### 2. Access Points

| URL | Role | Purpose |
|-----|------|---------|
| `/login` | Public | Login form |
| `/register` | Public | Register form |
| `/admin/dashboard` | Admin | Admin dashboard |
| `/pelanggan/dashboard` | Pelanggan | Customer dashboard |

### 3. Test Credentials

**Admin:**
```
Email: admin@rentalkosiium.com
Password: admin123
```

**Create new account via:** `/register`

### 4. How It Works

```
User Visits /login
        ↓
Enter Email & Password
        ↓
Auth Controller validates
        ↓
Password verified with hash
        ↓
Session created with role
        ↓
Redirect to dashboard (based on role)
```

### 5. Key Files

| File | Purpose |
|------|---------|
| `app/Models/UserModel.php` | Database queries |
| `app/Controllers/Auth.php` | Login/Register/Logout logic |
| `app/Filters/AuthFilter.php` | Login protection |
| `app/Views/auth/login.php` | Login form |
| `app/Views/auth/register.php` | Register form |

---

## 🔐 Security Features

✅ Password hashing dengan BCRYPT
✅ CSRF protection di setiap form
✅ Session-based authentication
✅ Role-based access control
✅ Input validation & sanitization
✅ SQL injection protection (via Model)

---

## ⚠️ Common Issues

**"Email or password invalid"**
- Pastikan database migration sudah jalan
- Check email dan password di database

**"Token mismatch"**
- Pastikan form include `<?= csrf_field() ?>`

**"Access denied"**
- Anda bukan admin/pelanggan sesuai route

**Blank page**
- Check logs di `writable/logs/`

---

## 📚 Full Documentation

Lihat: `TAHAP_3_AUTHENTICATION_GUIDE.md`

---

**Status:** ✅ Ready to use!
