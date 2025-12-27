# 🧪 TAHAP 4: TESTING GUIDE

## ✅ Pre-Test Checklist

Before testing, ensure:

- [ ] PHP server running: `php spark serve`
- [ ] MySQL running (XAMPP)
- [ ] All TAHAP 3 migrations completed
- [ ] Logged in as admin (admin@rentalkosiium.com / admin123)
- [ ] No PHP errors in console

---

## 🎯 Test Suite 1: KATEGORI CRUD

### Test 1.1: View Category List

**Steps:**
1. Navigate to: `http://localhost:8080/admin/kategori`
2. Should see table with columns: #, Nama Kategori, Deskripsi, Aksi
3. Should see existing categories (6 from seeder)

**Expected:** ✅ List displays correctly

---

### Test 1.2: Add New Category

**Steps:**
1. Click "Tambah Kategori" button
2. Enter name: `Test Kategori`
3. Enter description: `Ini adalah kategori test`
4. Click "Simpan"

**Expected:** ✅ Success message shown, new category appears in list

**Verification:**
```sql
SELECT * FROM kategori WHERE nama_kategori = 'Test Kategori';
```

---

### Test 1.3: Edit Category

**Steps:**
1. From kategori list, click edit icon (pencil) on "Test Kategori"
2. Change name to: `Test Kategori Updated`
3. Change description to: `Updated description`
4. Click "Perbarui"

**Expected:** ✅ Success message shown, changes visible in list

**Verification:**
```sql
SELECT * FROM kategori WHERE nama_kategori = 'Test Kategori Updated';
```

---

### Test 1.4: Validation - Empty Name

**Steps:**
1. Click "Tambah Kategori"
2. Leave nama_kategori empty
3. Click "Simpan"

**Expected:** ❌ Error message: "Nama kategori harus diisi"

---

### Test 1.5: Validation - Duplicate Name

**Steps:**
1. Click "Tambah Kategori"
2. Enter name: `Pengantin Pria` (existing category)
3. Click "Simpan"

**Expected:** ❌ Error message: "Nama kategori sudah ada, gunakan nama lain"

---

### Test 1.6: Validation - Min Length

**Steps:**
1. Click "Tambah Kategori"
2. Enter name: `AB` (2 chars)
3. Click "Simpan"

**Expected:** ❌ Error message: "Nama kategori minimal 3 karakter"

---

### Test 1.7: Delete Category (Success)

**Steps:**
1. Find "Test Kategori Updated" in list
2. Click delete button (trash icon)
3. Confirm deletion in popup

**Expected:** ✅ Success message, category removed from list

**Verification:**
```sql
SELECT * FROM kategori WHERE nama_kategori = 'Test Kategori Updated';
-- Should return empty result
```

---

### Test 1.8: Delete Category (Protected)

**Steps:**
1. Click "Tambah Kategori"
2. Add: `Test Kategori 2`
3. Go to Kostum, add costume with this category
4. Go back to Kategori, try to delete "Test Kategori 2"

**Expected:** ❌ Error message: "Kategori masih digunakan oleh kostum, tidak bisa dihapus"

---

## 🎯 Test Suite 2: KOSTUM CRUD

### Test 2.1: View Costume List

**Steps:**
1. Navigate to: `http://localhost:8080/admin/kostum`
2. Should see table with columns: #, Foto, Nama, Kategori, Ukuran, Stok, Harga, Status, Aksi
3. Should see 12 costumes from seeder with photos

**Expected:** ✅ All costumes display with thumbnails (50px)

---

### Test 2.2: Add New Costume (Success)

**Steps:**
1. Click "Tambah Kostum" button
2. Fill form:
   - Nama: `Test Kostum`
   - Kategori: Select any category
   - Ukuran: `M`
   - Stok: `5`
   - Harga: `100000`
   - Deskripsi: `Costume untuk testing`
3. Upload image from computer (JPG/PNG)
4. Click "Simpan"

**Expected:** ✅ Success message, new costume in list with photo thumbnail

**Verification:**
```sql
SELECT * FROM kostum WHERE nama_kostum = 'Test Kostum';
-- Check status = 'Tersedia' (because stok = 5)
-- Check foto has filename
```

---

### Test 2.3: Image Preview on Create

**Steps:**
1. Click "Tambah Kostum"
2. Select image file in "Foto Kostum" input
3. Don't submit yet

**Expected:** ✅ Image preview shows below input

---

### Test 2.4: Edit Costume (Change Stok)

**Steps:**
1. Find "Test Kostum" in list
2. Click edit icon
3. Change stok to `0`
4. Don't change photo
5. Click "Perbarui"

**Expected:** 
- ✅ Success message
- ✅ Status changed to "Habis" (badge now red)
- ✅ Photo unchanged (same as before)

**Verification:**
```sql
SELECT * FROM kostum WHERE nama_kostum = 'Test Kostum';
-- Check status = 'Habis'
-- Check foto still exists
```

---

### Test 2.5: Edit Costume (Replace Photo)

**Steps:**
1. Click edit on "Test Kostum" (stok=0)
2. Change stok back to `5`
3. Upload a DIFFERENT image
4. Click "Perbarui"

**Expected:**
- ✅ Success message
- ✅ Status changed to "Tersedia"
- ✅ New photo displays in thumbnail
- ✅ Old photo deleted from disk

**Verification:**
```bash
# Check old photo removed
dir public/uploads/kostum/ /od
```

---

### Test 2.6: Validation - Missing Required Fields

**Steps:**
1. Click "Tambah Kostum"
2. Leave multiple fields empty (nama_kostum, kategori_id, etc)
3. Don't select photo
4. Click "Simpan"

**Expected:** ❌ Multiple error messages display above form

---

### Test 2.7: Validation - Invalid Ukuran

**Steps:**
1. Click "Tambah Kostum"
2. Use browser dev tools to change ukuran select to invalid value
3. Try to submit

**Expected:** ❌ Error message: "Ukuran tidak valid"

---

### Test 2.8: Validation - Invalid Price Format

**Steps:**
1. Click "Tambah Kostum"
2. Enter negative number in Harga: `-50000`
3. Click "Simpan"

**Expected:** ❌ Error message: "Harga harus lebih dari 0"

---

### Test 2.9: File Upload - Invalid Format

**Steps:**
1. Click "Tambah Kostum"
2. Fill all fields correctly
3. Try to upload: `.txt`, `.pdf`, or other non-image file
4. Click "Simpan"

**Expected:** ❌ Error message: "Foto harus JPG, JPEG, atau PNG"

---

### Test 2.10: File Upload - Too Large

**Steps:**
1. Click "Tambah Kostum"
2. Create or find image > 2MB
3. Try to upload
4. Click "Simpan"

**Expected:** ❌ Error message: "Ukuran foto maksimal 2MB"

---

### Test 2.11: File Upload - Success

**Steps:**
1. Click "Tambah Kostum"
2. Upload valid JPG/PNG < 2MB
3. Fill other fields
4. Click "Simpan"

**Expected:**
- ✅ Success message
- ✅ Photo appears in list
- ✅ File stored in `public/uploads/kostum/`

**Verification:**
```bash
dir public/uploads/kostum/
# Should see new file with random name (e.g., a1b2c3d4e5f6.jpg)
```

---

### Test 2.12: Delete Costume

**Steps:**
1. Find "Test Kostum" in list
2. Click delete button (trash icon)
3. Confirm in popup

**Expected:**
- ✅ Success message
- ✅ Costume removed from list
- ✅ Photo file deleted from disk

**Verification:**
```bash
# Photo should be gone
dir public/uploads/kostum/ /od
```

---

## 🎯 Test Suite 3: UI/UX

### Test 3.1: Responsive Navigation

**Steps:**
1. Go to any admin page
2. Resize browser to mobile width (< 768px)
3. Click hamburger menu
4. Should see menu items

**Expected:** ✅ Navbar collapses, menu accessible

---

### Test 3.2: Error Message Display

**Steps:**
1. Try to add kategori without name
2. Error should show in red below field

**Expected:** ✅ Inline error display with clear message

---

### Test 3.3: Success Message Display

**Steps:**
1. Add valid kategori
2. Success message should show in green

**Expected:** ✅ Success alert with dismiss button

---

### Test 3.4: Form Data Persistence

**Steps:**
1. Fill kostum form partially (don't submit)
2. Leave upload empty intentionally
3. Try submit
4. Validation fails, should show error

**Expected:** ✅ Form keeps all entered data (old values)

---

### Test 3.5: Table Responsiveness

**Steps:**
1. Open kostum list on mobile (< 576px)
2. Scroll horizontally

**Expected:** ✅ Table scrolls, all columns accessible

---

## 🎯 Test Suite 4: Access Control

### Test 4.1: Admin Access

**Steps:**
1. Login as: admin@rentalkosiium.com / admin123
2. Navigate to: `/admin/kategori`

**Expected:** ✅ Access granted, can see list

---

### Test 4.2: Customer Blocked

**Steps:**
1. Login as pelanggan account (create one via register)
2. Try to access: `/admin/kategori`

**Expected:** ❌ Access denied / redirect to pelanggan dashboard

---

### Test 4.3: Not Logged In Blocked

**Steps:**
1. Logout
2. Try to access: `/admin/kategori`

**Expected:** ❌ Redirect to login page

---

## 🎯 Test Suite 5: Database Integrity

### Test 5.1: Foreign Key Constraint

**Steps:**
1. Try to add kostum with kategori_id = 99999 (doesn't exist)

**Expected:** ❌ Database error / validation error

---

### Test 5.2: Unique Constraint

**Steps:**
1. Create kategori: `Unique Test`
2. Try to create another with same name

**Expected:** ❌ Error: already exists

---

### Test 5.3: Auto Status Update

**Steps:**
1. Create kostum with stok = 10 (status should be "Tersedia")
2. Edit, change stok to 0
3. Save

**Expected:** 
- ✅ Verify in DB: status changed to "Habis"
- ✅ Verify in UI: badge now shows red

**Verification:**
```sql
SELECT nama_kostum, stok, status FROM kostum 
WHERE nama_kostum = 'Test Kostum';
```

---

## 📊 Test Results Summary

| Test | Status | Notes |
|------|--------|-------|
| 1.1-1.8 | ✅ | Kategori CRUD working |
| 2.1-2.12 | ✅ | Kostum CRUD working |
| 3.1-3.5 | ✅ | UI responsive & accessible |
| 4.1-4.3 | ✅ | Access control enforced |
| 5.1-5.3 | ✅ | Database integrity maintained |

---

## 🐛 Troubleshooting

### "File not found" error

**Cause:** Template layout incorrect
**Fix:** Check `app/Views/layout/template.php` exists and extends correctly

### "Filter exception" 

**Cause:** AdminFilter not registered
**Fix:** Check `app/Config/Filters.php` has:
```php
'adminFilter' => [Admin\AdminFilter::class],
```

### Photo not uploading

**Cause:** Directory permissions or missing folder
**Fix:** 
```bash
# Create if missing
mkdir public/uploads/kostum

# Ensure writable (Windows doesn't need this, but check)
```

### Validation not showing

**Cause:** `$validation` not passed to view
**Fix:** Check controller passes it:
```php
return view('admin/kategori/create', ['validation' => $this->validation]);
```

### Foreign key error when adding kostum

**Cause:** Selected kategori_id doesn't exist
**Fix:** Reload page, categories may be cached

---

## 📝 Test Documentation

After testing, document:
- Date tested
- Version tested
- Issues found
- Fixes applied
- Sign-off

Example:
```
Date: 2025-12-27
Tester: Developer
Environment: Local (PHP 8.2, MySQL 5.7)
Status: PASS (All 30 tests passed)
Issues: None critical
Sign-off: ✅ Ready for production
```

---

**Testing Duration:** ~1-2 hours for full suite
**Recommended Test Frequency:** After each deployment

