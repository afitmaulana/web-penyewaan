# TAHAP 3 - QUICK REFERENCE

## 🔑 Demo Credentials

### Admin Accounts
```
Email:    admin@rentalkosiium.com
Password: admin123
Role:     admin

Email:    operasional@rentalkosiium.com
Password: admin123
Role:     admin
```

### Test Customer Account
```
Email:    customer@example.com
Password: customer123
Role:     pelanggan
```
*(Create via registration form)*

---

## 🗂️ Key Files

| File | Purpose | Lines |
|------|---------|-------|
| `app/Controllers/Auth.php` | Login/Register/Logout | 166 |
| `app/Models/UserModel.php` | User database operations | ~80 |
| `app/Filters/AuthFilter.php` | Protect login requirement | 30 |
| `app/Filters/AdminFilter.php` | Restrict to admin | 35 |
| `app/Filters/PelangganFilter.php` | Restrict to customer | 35 |
| `app/Views/auth/login.php` | Login form | 129 |
| `app/Views/auth/register.php` | Registration form | 223 |
| `app/Config/Routes.php` | URL routing | 56 |
| `app/Config/Filters.php` | Filter configuration | ~50 |

---

## 🌐 URL Routes

### Public Routes
```
GET  /              → Homepage
GET  /login         → Login form
POST /login         → Process login
GET  /register      → Register form  
POST /register      → Process registration
POST /logout        → Logout
```

### Admin Routes (Requires role='admin')
```
GET  /admin/dashboard    → Admin dashboard
```

### Customer Routes (Requires role='pelanggan')
```
GET  /pelanggan/dashboard    → Customer dashboard
```

---

## 🔐 Authentication Flow

```
1. User → /login
2. Submit form with email & password
3. Auth controller validates credentials
4. Password verified using password_verify()
5. Session created: user_id, user_name, user_email, role
6. Redirect to /admin or /pelanggan based on role
```

---

## 💾 Database Schema

### Users Table
```sql
users (
  id (int, PK),
  nama_lengkap (varchar),
  email (varchar, unique),
  password (varchar),
  nomor_hp (varchar),
  alamat (text),
  kota (varchar),
  provinsi (varchar),
  kode_pos (varchar),
  role (enum: admin, pelanggan),
  status (enum: aktif, nonaktif),
  last_login (datetime),
  created_at (datetime),
  updated_at (datetime)
)
```

---

## 🧪 Quick Test Commands

```bash
# 1. Start server
php spark serve

# 2. Test login (should see form)
curl http://localhost:8080/login

# 3. Test admin dashboard (should redirect if not logged in)
curl http://localhost:8080/admin/dashboard

# 4. Check session files created
ls writable/session/
```

---

## 🛡️ Security Features

- ✅ Password hashing (password_hash / password_verify)
- ✅ CSRF tokens in forms
- ✅ Input validation & sanitization
- ✅ Role-based access control
- ✅ Session-based authentication
- ✅ File-based session storage
- ✅ SQL injection protection via Models

---

## ⚙️ Configuration Files

### `.env` (Database)
```
database.default.hostname = localhost
database.default.database = penyewaan
database.default.username = root
database.default.password = (empty)
```

### `app/Config/Session.php`
```
handler = FileHandler::class
savePath = WRITEPATH . 'session'
expiration = 1800 (30 minutes)
```

### `app/Config/Routes.php`
```
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::processLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::processRegister');
$routes->post('logout', 'Auth::logout');

$routes->group('admin', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
});

$routes->group('pelanggan', ['filter' => 'pelangganFilter'], function ($routes) {
    $routes->get('dashboard', 'Pelanggan\Dashboard::index');
});
```

---

## 🔧 Common Methods

### UserModel Methods
```php
// Find user by email
$user = $this->userModel->findActiveByEmail($email);

// Register new user
$this->userModel->register($data);

// Verify password
UserModel::verifyPassword($password, $hashedPassword);

// Update last login
$this->userModel->updateLastLogin($userId);
```

### Session Methods (in Controllers & Views)
```php
// Set session
$this->session->set(['user_id' => 123]);

// Get session
$userId = $this->session->get('user_id');

// Set flash data
$this->session->setFlashdata('success', 'Login berhasil');

// Get flash data (in views)
session()->getFlashdata('success');
```

---

## 📝 Form Validation Rules

### Login Validation
```
email: required|valid_email
password: required|min_length[8]
```

### Register Validation
```
nama_lengkap: required|min_length[3]|max_length[100]
email: required|valid_email|is_unique[users.email]
nomor_hp: required|min_length[10]|max_length[15]
alamat: required|min_length[10]
kota: required|min_length[3]
provinsi: required|min_length[3]
kode_pos: required|min_length[5]|max_length[10]
password: required|min_length[8]
password_confirm: required|matches[password]
```

---

## 🚀 Next Phase (TAHAP 4)

When starting TAHAP 4, you'll have:
- ✅ User authentication ready
- ✅ Role-based access working
- ✅ Session management setup
- ✅ User data in database
- ✅ Login/logout functionality

Ready to build:
- [ ] Costume listing
- [ ] Search & filter
- [ ] View details
- [ ] Add to cart
- [ ] Checkout process

---

## 📞 Troubleshooting

**Can't login?**
- Check database connection in .env
- Verify user exists in database
- Check password hashing in seeder

**Blank pages?**
- Check layout_main.php syntax
- Verify views exist in correct folders
- Check browser console for errors

**No redirect after login?**
- Verify getRedirectUrl() in Auth.php
- Check role value in database
- Verify filters are registered

**Session not working?**
- Check writable/session folder permissions
- Verify Session.php configuration
- Check .env session settings

---

**Status:** ✅ TAHAP 3 COMPLETE

Ready for TAHAP 4: CRUD Katalog Kostum

Last Updated: 2025-12-27
