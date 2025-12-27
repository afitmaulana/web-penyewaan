# 🏗️ TAHAP 3 - ARCHITECTURE & FLOW DIAGRAMS

## 1. Application Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    USER INTERFACE (Views)                    │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  login.php    │ register.php │ admin/ │ pelanggan/   │   │
│  └──────────────────────────────────────────────────────┘   │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────▼────────────────────────────────┐
│         ROUTING LAYER (Config/Routes.php)                   │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  /login (Public)                                     │   │
│  │  /register (Public)                                  │   │
│  │  /logout (AuthFilter)                                │   │
│  │  /admin/* (AdminFilter)                              │   │
│  │  /pelanggan/* (PelangganFilter)                       │   │
│  └──────────────────────────────────────────────────────┘   │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────▼────────────────────────────────┐
│         FILTER LAYER (app/Filters/)                         │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  AuthFilter      → Check login (user_id exists)     │   │
│  │  AdminFilter     → Check role === 'admin'           │   │
│  │  PelangganFilter → Check role === 'pelanggan'       │   │
│  └──────────────────────────────────────────────────────┘   │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────▼────────────────────────────────┐
│         CONTROLLER LAYER (app/Controllers/)                 │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  Auth::login()          → Show login form            │   │
│  │  Auth::processLogin()   → Process login              │   │
│  │  Auth::register()       → Show register form         │   │
│  │  Auth::processRegister()→ Process registration       │   │
│  │  Auth::logout()         → Logout & destroy session   │   │
│  │  Admin/Dashboard        → Show admin dashboard       │   │
│  │  Pelanggan/Dashboard    → Show pelanggan dashboard   │   │
│  └──────────────────────────────────────────────────────┘   │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────▼────────────────────────────────┐
│         MODEL LAYER (app/Models/)                           │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  UserModel                                           │   │
│  │  - findByEmail()                                     │   │
│  │  - findActiveByEmail()                               │   │
│  │  - register()                                        │   │
│  │  - updateLastLogin()                                 │   │
│  │  - verifyPassword() [static]                         │   │
│  └──────────────────────────────────────────────────────┘   │
└────────────────────────────┬────────────────────────────────┘
                             │
┌────────────────────────────▼────────────────────────────────┐
│         DATABASE LAYER                                       │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  users table (from Tahap 2)                          │   │
│  │  - id, nama_lengkap, email, password, role, ...     │   │
│  │  - ci_sessions table (for session storage)          │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
```

---

## 2. Login Flow Diagram

```
START
  │
  ├─► User visits /login
  │
  ├─► Is user already logged in?
  │   ├─ YES → Redirect to dashboard
  │   └─ NO  → Continue
  │
  ├─► Show login form (GET request)
  │
  ├─► User enters email & password
  │
  ├─► Submit form (POST request)
  │
  ├─► Auth Controller processes login
  │   ├─► Validate email & password fields
  │   │
  │   ├─► Find user by email in database
  │   │   ├─ NOT FOUND → Show error
  │   │   │  └─► Redirect to /login with error
  │   │   │
  │   │   └─ FOUND → Continue
  │   │
  │   ├─► Verify password
  │   │   ├─ INVALID → Show error
  │   │   │  └─► Redirect to /login with error
  │   │   │
  │   │   └─ VALID → Continue
  │   │
  │   ├─► Set session variables
  │   │   ├─ user_id
  │   │   ├─ user_name
  │   │   ├─ user_email
  │   │   └─ role (admin/pelanggan)
  │   │
  │   ├─► Update last_login in database
  │   │
  │   └─► Set success flash message
  │
  ├─► Redirect based on role
  │   ├─ role === 'admin'     → /admin/dashboard
  │   └─ role === 'pelanggan' → /pelanggan/dashboard
  │
  ├─► Display dashboard
  │
  └─ END

ERROR SCENARIOS:
  ├─ Invalid email format → Show validation error
  ├─ Email not registered → Show "Email not found"
  ├─ Wrong password → Show "Invalid password"
  ├─ User not active → Show "Account disabled"
  └─ Database error → Show generic error
```

---

## 3. Registration Flow Diagram

```
START
  │
  ├─► User visits /register
  │
  ├─► Is user already logged in?
  │   ├─ YES → Redirect to dashboard
  │   └─ NO  → Continue
  │
  ├─► Show register form (GET request)
  │
  ├─► User fills all fields
  │   ├─ nama_lengkap
  │   ├─ email
  │   ├─ nomor_hp
  │   ├─ alamat
  │   ├─ kota
  │   ├─ provinsi
  │   ├─ kode_pos
  │   ├─ password
  │   └─ password_confirm
  │
  ├─► Submit form (POST request)
  │
  ├─► Auth Controller processes registration
  │   ├─► Validate all fields
  │   │   ├─ Check required fields
  │   │   ├─ Check field lengths
  │   │   ├─ Check email format
  │   │   ├─ Check password length (min 8)
  │   │   ├─ Check password_confirm matches
  │   │   └─ Check email is unique
  │   │
  │   ├─► If validation fails
  │   │   └─► Redirect back with errors
  │   │
  │   ├─► Hash password with BCRYPT
  │   │
  │   ├─► Set role to 'pelanggan'
  │   │
  │   ├─► Create user in database
  │   │
  │   ├─► Set success flash message
  │   │
  │   └─► Redirect to /login
  │
  ├─► User can now login
  │
  └─ END

ERROR SCENARIOS:
  ├─ Required field missing → Show error
  ├─ Email already registered → Show "Email exists"
  ├─ Password too short → Show "Min 8 characters"
  ├─ Passwords don't match → Show "Passwords don't match"
  ├─ Invalid email format → Show "Invalid email"
  └─ Database error → Show generic error
```

---

## 4. Session & Filter Flow

```
┌─────────────────────────────────────────┐
│        USER REQUEST TO PROTECTED ROUTE  │
│        (e.g., /admin/dashboard)         │
└────────────┬────────────────────────────┘
             │
             ▼
┌─────────────────────────────────────────┐
│   Check if Route has Filters Applied?   │
├─────────────────────────────────────────┤
│                                         │
│  /admin/* → adminFilter                 │
│  /pelanggan/* → pelangganFilter         │
│  /logout → authFilter                   │
│                                         │
└────────────┬────────────────────────────┘
             │
             ▼
      ┌──────────────┐
      │ AuthFilter?  │
      └──┬────────┬──┘
         │        │
        YES      NO
         │        │
         ▼        ▼
    Is user   Go to next
    logged    filter/
    in?       controller
    │
    ├─ NO   → Redirect to /login
    │        (Error: Login required)
    │
    └─ YES  ▼
           ┌──────────────┐
           │ AdminFilter? │
           └──┬────────┬──┘
              │        │
             YES      NO
              │        │
              ▼        ▼
          Is role  Go to next
          admin?   filter/
          │        controller
          ├─ NO   → Redirect to /pelanggan/dashboard
          │        (Error: Admin only)
          │
          └─ YES  ▼
                 ┌──────────────────┐
                 │ PelangganFilter? │
                 └──┬────────┬──────┘
                    │        │
                   YES      NO
                    │        │
                    ▼        ▼
                Is role  Go to
                pelanggan? controller
                │
                ├─ NO   → Redirect to /admin/dashboard
                │        (Error: Pelanggan only)
                │
                └─ YES  ▼
                       ┌──────────────────┐
                       │ ALL FILTERS OK   │
                       │ PROCEED TO       │
                       │ CONTROLLER       │
                       └──────────────────┘

SESSION VARIABLES CHECK:
  ├─ session->get('user_id')
  ├─ session->get('user_name')
  ├─ session->get('user_email')
  └─ session->get('role')
```

---

## 5. Database Query Flow

```
┌─────────────────────────────────────┐
│    Login Form Submission            │
│    Email: user@example.com          │
│    Password: password123            │
└────────────┬────────────────────────┘
             │
             ▼
┌─────────────────────────────────────┐
│   UserModel::findActiveByEmail()    │
│   (find user where email = ?)       │
└────────────┬────────────────────────┘
             │
             ▼
    ┌────────────────────┐
    │   Database Query   │
    │  SELECT * FROM     │
    │  users WHERE       │
    │  email = ?         │
    │  AND is_active = 1 │
    └─┬──────────────────┘
      │
      ├─ NO RECORD FOUND  → Return null
      │                      Redirect: Invalid login
      │
      └─ RECORD FOUND  ▼
        ┌──────────────────────────┐
        │ $user['password'] =      │
        │ bcrypt hash from DB      │
        └──────────┬───────────────┘
                   │
                   ▼
        ┌──────────────────────────┐
        │ UserModel::             │
        │ verifyPassword()        │
        │ password_verify(        │
        │   input_password,       │
        │   user_hash             │
        │ )                       │
        └──┬───────┬──────────────┘
           │       │
         FALSE   TRUE
           │       │
           ▼       ▼
       Error   Set Session
       └─────────┬──────────┘
                 │
                 ▼
        ┌──────────────────────┐
        │ session()->set([     │
        │   'user_id' => int,  │
        │   'user_name' => str,│
        │   'user_email' => str│
        │   'role' => str      │
        │ ])                   │
        └──────┬───────────────┘
               │
               ▼
        ┌──────────────────────┐
        │ Redirect based on    │
        │ role to dashboard    │
        └──────────────────────┘
```

---

## 6. Session State Machine

```
┌─────────────────┐
│   NOT LOGGED IN │◄─────────────────┐
│  (No session)   │                   │
└────────┬────────┘                   │
         │                            │
         │ POST /login                │
         │ (valid credentials)        │
         │                            │
         ▼                            │
┌──────────────────────┐              │
│  LOGGED IN - ADMIN   │──────────────┤
│  session['role']     │              │
│  = 'admin'           │              │
└──────────┬───────────┘              │
           │                          │
           │ POST /logout             │ POST /logout
           │                          │
           ▼                          │
         ┌─────────────────┐          │
         │  NOT LOGGED IN  │◄─────────┤
         │  (session       │          │
         │  destroyed)     │          │
         └─────────────────┘          │
                                      │
         ┌──────────────────────┐     │
         │ LOGGED IN - PELANGGAN│     │
         │ session['role']      │     │
         │ = 'pelanggan'        │     │
         └────┬─────────────────┘     │
              │                       │
              │ POST /logout          │
              │                       │
              └───────────────────────┘
```

---

## 7. Validation Rules Flow

```
REGISTRATION FORM SUBMISSION
│
├─ nama_lengkap
│  ├─ Required
│  ├─ Min length: 3
│  └─ Max length: 100
│
├─ email
│  ├─ Required
│  ├─ Valid email format
│  └─ Must be unique (not in database)
│
├─ nomor_hp
│  ├─ Required
│  ├─ Min length: 10
│  └─ Max length: 15
│
├─ alamat
│  ├─ Required
│  └─ Min length: 10
│
├─ kota
│  ├─ Required
│  └─ Min length: 3
│
├─ provinsi
│  ├─ Required
│  └─ Min length: 3
│
├─ kode_pos
│  ├─ Required
│  ├─ Min length: 5
│  └─ Max length: 10
│
├─ password
│  ├─ Required
│  └─ Min length: 8
│
└─ password_confirm
   ├─ Required
   └─ Must match password field

ALL PASS? → Create user & set role='pelanggan'
ANY FAIL? → Return errors & re-show form
```

---

## 8. Security Layers

```
┌────────────────────────────────────────────────────┐
│         LAYER 1: ROUTE/FILTER LEVEL                │
│  - Check if user logged in (session user_id)       │
│  - Check if user has correct role                  │
│  - Redirect to appropriate page if denied          │
└────────────────┬─────────────────────────────────┘
                 │
┌────────────────▼─────────────────────────────────┐
│      LAYER 2: CONTROLLER/VALIDATION LEVEL         │
│  - Validate form inputs (email, password, etc)    │
│  - Check business logic requirements              │
│  - Verify email uniqueness                        │
│  - Enforce password requirements                  │
└────────────────┬─────────────────────────────────┘
                 │
┌────────────────▼─────────────────────────────────┐
│     LAYER 3: MODEL/DATABASE LEVEL                 │
│  - Use parameterized queries (prevent SQL inject) │
│  - Hash passwords with BCRYPT                     │
│  - Verify password with password_verify()         │
│  - Store sensitive data encrypted                 │
└────────────────┬─────────────────────────────────┘
                 │
┌────────────────▼─────────────────────────────────┐
│       LAYER 4: VIEW/OUTPUT LEVEL                  │
│  - Use esc() for HTML entities (prevent XSS)      │
│  - Escape user input in forms                     │
│  - Display validation errors safely               │
│  - CSRF token in forms                            │
└────────────────────────────────────────────────────┘
```

---

## 9. Role-Based Access Control (RBAC)

```
┌─────────────────────────────────────────────┐
│           USER REQUESTS RESOURCE             │
└────────────────┬────────────────────────────┘
                 │
                 ▼
        ┌────────────────┐
        │ Check Session  │
        │ Role = ?       │
        └────┬────────┬──┘
             │        │
        'admin'  'pelanggan'
             │        │
             ▼        ▼
    ┌───────────┐  ┌────────────┐
    │           │  │            │
    │ CAN       │  │ CAN        │
    │ ACCESS    │  │ ACCESS     │
    │           │  │            │
    │ /admin/*  │  │ /pelanggan/│
    │           │  │ *          │
    │           │  │            │
    │ CANNOT    │  │ CANNOT     │
    │ ACCESS    │  │ ACCESS     │
    │           │  │            │
    │ /pelanggan│  │ /admin/*   │
    │ /*        │  │            │
    │           │  │            │
    │ DENIED:   │  │ DENIED:    │
    │ Redirect  │  │ Redirect   │
    │ to        │  │ to         │
    │ pelanggan │  │ admin      │
    │ dashboard │  │ dashboard  │
    └───────────┘  └────────────┘
```

---

## 10. Complete User Journey

```
NEW USER JOURNEY:

START
  │
  ├─► Visit website: http://localhost:8080
  │
  ├─► See homepage with login/register links
  │
  ├─► Click "Daftar di sini" (register link)
  │
  ├─► Fill registration form
  │   ├─ Name: John Doe
  │   ├─ Email: john@example.com
  │   ├─ Phone: 081234567890
  │   ├─ Address: Jl. Merdeka 123
  │   ├─ City: Jakarta
  │   ├─ Province: DKI Jakarta
  │   ├─ Zip: 12345
  │   ├─ Password: password123
  │   └─ Confirm: password123
  │
  ├─► Submit form
  │
  ├─► System validates all fields
  │
  ├─► System checks email uniqueness
  │
  ├─► System hashes password with BCRYPT
  │
  ├─► System creates user in database
  │   └─ role = 'pelanggan'
  │
  ├─► Redirect to login page
  │
  ├─► See success message
  │
  ├─► Enter email & password
  │
  ├─► Click Login button
  │
  ├─► System validates credentials
  │
  ├─► System verifies password
  │
  ├─► System sets session variables
  │
  ├─► System updates last_login
  │
  ├─► Redirect to /pelanggan/dashboard
  │
  ├─► See customer dashboard
  │
  ├─► Can see:
  │   ├─ Welcome message with name
  │   ├─ Stats (rentals, spending)
  │   ├─ Rental history
  │   ├─ Quick actions
  │   └─ Logout button
  │
  ├─► Click Logout
  │
  ├─► System destroys session
  │
  ├─► Redirect to login page
  │
  └─ END

ADMIN USER JOURNEY:

START
  │
  ├─► Visit: http://localhost:8080/login
  │
  ├─► Enter email: admin@rentalkosiium.com
  │
  ├─► Enter password: admin123
  │
  ├─► Click Login
  │
  ├─► System finds user in database
  │
  ├─► System verifies password
  │
  ├─► Session set with role='admin'
  │
  ├─► Redirect to /admin/dashboard
  │
  ├─► See admin dashboard with:
  │   ├─ Welcome message
  │   ├─ 4 stat cards
  │   ├─ Admin menu
  │   ├─ Statistics
  │   └─ Logout button
  │
  └─ END
```

---

**This document provides visual understanding of TAHAP 3 architecture and flows.**

For detailed implementation, see: [TAHAP_3_AUTHENTICATION_GUIDE.md](TAHAP_3_AUTHENTICATION_GUIDE.md)
