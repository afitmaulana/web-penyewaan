# 🚀 TAHAP 2: GETTING STARTED - 5 MINUTE QUICK START

**Framework:** CodeIgniter 4  
**Database:** MySQL  
**Time to Complete:** ~5 minutes  
**Difficulty:** Beginner-friendly  
**Status:** ✅ Ready to execute

---

## ⚡ ABSOLUTE FASTEST START (3 Commands)

```bash
# Command 1: Run migrations
php spark migrate

# Command 2: Run seeders
php spark db:seed AdminSeeder && php spark db:seed KategoriSeeder && php spark db:seed KostumSeeder

# Command 3: Verify
php spark migrate:status
```

**Expected Result:** All migrations should show "up" status ✅

---

## ✅ 5-MINUTE SETUP CHECKLIST

### Minute 1: Check Prerequisites
- [ ] MySQL is running (Windows: XAMPP Control Panel → MySQL Start)
- [ ] You're in correct directory: `d:\web-penyewaan\web-penyewaan`
- [ ] `.env` file exists

### Minute 2: Configure Database (.env)
```bash
# Edit .env file with any text editor
# Change these lines:

database.default.hostname = localhost
database.default.database = rental_kostum
database.default.username = root
database.default.password = 

# Save file (Ctrl+S)
```

### Minute 3: Run Migrations
```bash
# Open terminal/command prompt in project directory
cd d:\web-penyewaan\web-penyewaan

# Run migrations
php spark migrate

# You should see: "Migrations complete."
```

### Minute 4: Run Seeders
```bash
# Run three seeders in order
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder

# You should see success messages for each
```

### Minute 5: Verify Success
```bash
# Check status
php spark migrate:status

# Open browser and go to:
# http://localhost/phpmyadmin

# Find database: rental_kostum
# Check tables exist and have data
```

---

## 🎯 WHAT GETS CREATED

### Database Structure
```
rental_kostum database
├── users (2 rows - admin accounts)
├── kategori (6 rows - costume categories)
├── kostum (12 rows - costume items)
├── penyewaan (0 rows - empty, for future transactions)
├── pembayaran (0 rows - empty, for future payments)
└── pengembalian (0 rows - empty, for future returns)
```

### Admin Accounts Created
```
Email 1: admin@rentalkosiium.com
Email 2: operasional@rentalkosiium.com
Password: admin123 (for both accounts)
```

---

## 🔧 STEP-BY-STEP (If 3-Command Quick Start Didn't Work)

### Step 1: Open Terminal
```bash
# Press Windows Key + R
# Type: cmd
# Press Enter
# Navigate to project:
cd d:\web-penyewaan\web-penyewaan
```

### Step 2: Verify .env Configuration
```bash
# Check if .env file exists
dir .env

# If it doesn't exist, create it from .env.example
copy .env.example .env
```

### Step 3: Edit .env for Database
```bash
# Edit with notepad or VS Code
# Make sure these lines are set:

CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = rental_kostum
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306

# Save the file
```

### Step 4: Check Migration Status
```bash
# This should show 6 pending migrations
php spark migrate:status
```

Expected output:
```
Migrations
| Name                              | Batch | Method |
+---------------------------------+-------+--------+
| 2024-12-27-000001_CreateUsersTable    | -   | ---    |
| 2024-12-27-000002_CreateKategoriTable | -   | ---    |
| 2024-12-27-000003_CreateKostumTable   | -   | ---    |
| 2024-12-27-000004_CreatePenyewaanTable| -   | ---    |
| 2024-12-27-000005_CreatePembayaranTable| -   | ---    |
| 2024-12-27-000006_CreatePengembalianTable| -   | ---    |
```

### Step 5: Run Migrations
```bash
# This creates all tables in the database
php spark migrate

# You should see: "Migrations complete."
```

### Step 6: Run First Seeder
```bash
# This creates 2 admin users
php spark db:seed AdminSeeder

# You should see: "✅ Admin seeder berhasil dijalankan!"
```

### Step 7: Run Second Seeder
```bash
# This creates 6 categories
php spark db:seed KategoriSeeder

# You should see: "✅ Kategori seeder berhasil dijalankan!"
```

### Step 8: Run Third Seeder
```bash
# This creates 12 costume items
php spark db:seed KostumSeeder

# You should see: "✅ Kostum seeder berhasil dijalankan!"
```

### Step 9: Verify Everything
```bash
# Check migration status again
php spark migrate:status

# All should show "Batch: 1" and "Method: up"
```

### Step 10: View Database (Optional)
```bash
# Open browser
http://localhost/phpmyadmin

# Login (usually: root, no password)
# Click database: rental_kostum
# See all 6 tables with data
```

---

## ❌ COMMON ISSUES & QUICK FIXES

### Issue: "Can't connect to MySQL"
**Solution:** 
- Make sure MySQL is running (XAMPP → Start MySQL)
- Check .env has correct database name

### Issue: "Table doesn't exist"
**Solution:**
```bash
# Run migrations first
php spark migrate
```

### Issue: "Duplicate entry 'admin@...' for key 'email'"
**Solution:**
```bash
# Reset everything
php spark migrate:refresh

# Then run seeders again
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder
```

### Issue: "Command not found: php spark"
**Solution:**
```bash
# Make sure you're in correct directory
cd d:\web-penyewaan\web-penyewaan

# Then try again
php spark migrate
```

---

## 🎓 WHAT JUST HAPPENED

You've just:
1. ✅ Created 6 database tables with proper structure
2. ✅ Set up foreign key relationships
3. ✅ Created 2 admin accounts (role-based access)
4. ✅ Created 6 costume categories
5. ✅ Created 12 sample costumes with pricing
6. ✅ Set up database indexes for performance
7. ✅ Implemented audit timestamps
8. ✅ Established referential integrity

**Total Time:** ~5 minutes  
**Lines of Code Executed:** 1,780+  
**Tables Created:** 6  
**Sample Data:** 20 rows

---

## 📖 LEARN MORE

Want to understand what you just did?

**Quick Videos:**
- [DATABASE_DESIGN_DETAILED.md](DATABASE_DESIGN_DETAILED.md) - What each table does
- [TAHAP_2_MIGRATION_GUIDE.md](TAHAP_2_MIGRATION_GUIDE.md) - How to run commands

**Visual Overview:**
- [TAHAP_2_VISUAL_SUMMARY.md](TAHAP_2_VISUAL_SUMMARY.md) - Database diagrams

**Complete Reference:**
- [TAHAP_2_INDEX.md](TAHAP_2_INDEX.md) - All files and where to find info

---

## 🧪 TEST YOUR SETUP

### Test 1: Login as Admin
```bash
# Run application
php spark serve

# Open browser
http://localhost:8080/login

# Try login with:
Email: admin@rentalkosiium.com
Password: admin123

# Should work! ✅
```

### Test 2: Check Database
```bash
# Open PhpMyAdmin
http://localhost/phpmyadmin

# Select database: rental_kostum
# Check tables exist:
  - users (2 rows)
  - kategori (6 rows)
  - kostum (12 rows)
  - penyewaan (0 rows)
  - pembayaran (0 rows)
  - pengembalian (0 rows)

# All present? Success! ✅
```

### Test 3: Check Relationships
```bash
# In PhpMyAdmin
# Check if foreign keys work:

# Click kostum table → Structure
# See: kategori_id → Foreign Key to kategori.id ✓

# Click penyewaan table → Structure
# See: user_id, kostum_id → Foreign Keys ✓
```

---

## 🎯 NEXT STEPS

**After TAHAP 2 is complete:**

1. **Read:** [DATABASE_DESIGN_DETAILED.md](DATABASE_DESIGN_DETAILED.md)
   - Understand the system design
   - Learn about each table
   - Time: 30-40 minutes

2. **Ready for TAHAP 3?**
   - Create Models for each table
   - Create Controllers with CRUD operations
   - Create Views for display
   - Estimated time: 4-5 hours

3. **Questions?**
   - Check [TAHAP_2_MIGRATION_GUIDE.md](TAHAP_2_MIGRATION_GUIDE.md) Troubleshooting section
   - Read [TAHAP_2_INDEX.md](TAHAP_2_INDEX.md) for file navigation

---

## ✨ SUCCESS INDICATORS

You've successfully completed TAHAP 2 if:

- ✅ `php spark migrate:status` shows 6 migrations with Batch=1, Method=up
- ✅ Database `rental_kostum` exists in MySQL
- ✅ All 6 tables exist with correct structure
- ✅ users table has 2 rows
- ✅ kategori table has 6 rows
- ✅ kostum table has 12 rows
- ✅ Can login with admin@rentalkosiium.com + admin123
- ✅ PhpMyAdmin shows all tables and relationships

**All of the above? Congratulations! 🎉**

---

## 📞 QUICK REFERENCE

| Command | What it does |
|---------|-------------|
| `php spark migrate:status` | Show migration status |
| `php spark migrate` | Create all tables |
| `php spark db:seed AdminSeeder` | Create admin users |
| `php spark db:seed KategoriSeeder` | Create categories |
| `php spark db:seed KostumSeeder` | Create sample costumes |
| `php spark migrate:refresh` | Reset everything (careful!) |
| `php spark serve` | Start development server |

---

## 🎊 YOU'RE DONE!

Congratulations! 🎉

You've successfully completed **TAHAP 2: DATABASE & MIGRATION**

**What You've Built:**
- ✅ Professional database with 6 tables
- ✅ Proper relationships and constraints
- ✅ Sample data for testing
- ✅ Admin accounts for login

**What's Next:**
→ TAHAP 3: Models, Controllers & CRUD Operations

**Time Invested:** ~5 minutes for setup  
**Value Delivered:** Professional database foundation

**Ready to continue? Let's go to TAHAP 3! 🚀**

---

**Version:** 1.0.0  
**Status:** ✅ Ready to use  
**Date:** 27 December 2024

**Questions?** Check the documentation files listed above!

