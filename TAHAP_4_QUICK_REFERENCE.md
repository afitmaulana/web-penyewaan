# ⚡ TAHAP 4: QUICK REFERENCE

## 📍 Access Points

```
/admin/kategori         → List & manage categories
/admin/kategori/create  → Add new category
/admin/kostum           → List & manage costumes
/admin/kostum/create    → Add new costume
```

**Login Required:** Admin only (role = 'admin')

---

## 🎯 Key Code Snippets

### Get all categories with kostum count

```php
$kategori = $this->kategoriModel->getAllKategori();
// Returns array of categories
```

### Get costume with category name

```php
$kostum = $this->kostumModel->getKostumById($id);
// Returns array with: kostum_id, nama_kostum, kategori_id, 
//                     ukuran, stok, harga_per_hari, foto, 
//                     status, nama_kategori
```

### Check if category is used

```php
if ($this->kategoriModel->isKategoriUsed($kategoriId)) {
    // Category has costumes, cannot delete
}
```

### Upload file handling

```php
$file = $this->request->getFile('foto');
$filename = $this->kostumModel->uploadFoto($file);
// Returns random filename or null on error
```

### Auto-update status by stock

```php
$this->kostumModel->updateStatusByStok($kostumId);
// Updates status: "Tersedia" if stok > 0, "Habis" if stok = 0
```

---

## 📋 Validation Rules

### Kategori

```php
'nama_kategori' => 'required|string|min_length[3]|max_length[100]|is_unique[kategori.nama_kategori]',
'deskripsi'     => 'permit_empty|string|max_length[500]',
```

### Kostum

```php
'nama_kostum'     => 'required|string|min_length[3]|max_length[100]',
'kategori_id'     => 'required|integer|greater_than[0]',
'ukuran'          => 'required|string|in_list[XS,S,M,L,XL,XXL]',
'stok'            => 'required|integer|greater_than_equal_to[0]',
'harga_per_hari'  => 'required|decimal|greater_than[0]',
'deskripsi'       => 'permit_empty|string|max_length[500]',
'foto'            => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
```

---

## 🔗 Route Names

```php
route_to('kategori_index')           // /admin/kategori
route_to('kategori_create')          // /admin/kategori/create
route_to('kategori_edit', $id)       // /admin/kategori/{id}/edit
route_to('kategori_update', $id)     // /admin/kategori/{id}
route_to('kategori_delete', $id)     // /admin/kategori/{id}

route_to('kostum_index')             // /admin/kostum
route_to('kostum_create')            // /admin/kostum/create
route_to('kostum_edit', $id)         // /admin/kostum/{id}/edit
route_to('kostum_update', $id)       // /admin/kostum/{id}
route_to('kostum_delete', $id)       // /admin/kostum/{id}
```

---

## 📸 File Upload Details

```
Directory:   public/uploads/kostum/
Max Size:    2048 KB (2 MB)
Formats:     JPG, JPEG, PNG
Naming:      Automatic random (e.g., a1b2c3d4e5f6.jpg)
Cleanup:     Automatic on delete or replace
URL Format:  <?= base_url('uploads/kostum/' . $filename) ?>
```

---

## 🎨 Form Fields

### Kategori Create/Edit

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| nama_kategori | text | Yes | 3-100 chars, unique |
| deskripsi | textarea | No | Max 500 chars |

### Kostum Create

| Field | Type | Required | Options |
|-------|------|----------|---------|
| nama_kostum | text | Yes | 3-100 chars |
| kategori_id | select | Yes | Dropdown from DB |
| ukuran | select | Yes | XS, S, M, L, XL, XXL |
| stok | number | Yes | 0+ |
| harga_per_hari | number | Yes | Decimal format |
| deskripsi | textarea | No | Max 500 chars |
| foto | file | Yes | JPG/PNG, max 2MB |

### Kostum Edit (same as create, but foto optional)

---

## 💾 Database Schema Quick Look

```sql
-- Kategori
CREATE TABLE kategori (
    kategori_id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(100) UNIQUE NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

-- Kostum
CREATE TABLE kostum (
    kostum_id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kostum VARCHAR(100) NOT NULL,
    kategori_id INT NOT NULL,
    ukuran ENUM('XS','S','M','L','XL','XXL'),
    stok INT DEFAULT 0,
    harga_per_hari DECIMAL(10,2),
    deskripsi TEXT,
    foto VARCHAR(255),
    status VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(kategori_id)
);
```

---

## 🧪 Quick Test Commands

```bash
# Navigate to project
cd d:/web-penyewaan/web-penyewaan

# Start server
php spark serve

# Access pages
http://localhost:8080/admin/kategori
http://localhost:8080/admin/kostum

# Login as admin
Email: admin@rentalkosiium.com
Password: admin123
```

---

## 🔍 Common Methods

### KategoriModel

```php
getAllKategori()              // Get all categories, ordered by name
getKategoriById($id)          // Get single category by ID
isKategoriUsed($id)           // Check if category has costumes
insert($data)                 // Create new (auto-validates)
update($id, $data)            // Update existing (auto-validates)
delete($id)                   // Delete category
```

### KostumModel

```php
getAllKostum()                // Get all with category names joined
getKostumById($id)            // Get single with category name
getKostumByKategori($id)      // Get all by category ID
uploadFoto($file)             // Handle file upload, return filename
deleteFoto($filename)         // Delete file from disk
updateStatusByStok($id)       // Auto-update status based on stok
getUpdateValidationRules()    // Get rules for update (foto optional)
insert($data)                 // Create new (auto-validates)
update($id, $data)            // Update existing (auto-validates)
delete($id)                   // Delete costume
```

### KategoriController & KostumController

All follow standard CRUD pattern:

```php
index()      // GET /admin/kategori → List all
create()     // GET /admin/kategori/create → Show form
store()      // POST /admin/kategori → Save new
edit($id)    // GET /admin/kategori/:id/edit → Show form
update($id)  // POST /admin/kategori/:id → Save update
delete($id)  // DELETE /admin/kategori/:id → Remove
```

---

## 📱 Responsive Design

- ✅ Mobile-friendly Bootstrap 5
- ✅ Collapsible navbar
- ✅ Responsive tables (scroll on mobile)
- ✅ Touch-friendly buttons
- ✅ Image thumbnails (50px for lists)

---

## ⚠️ Important Notes

1. **Delete Protection**: Categories with costumes cannot be deleted
2. **Auto Status**: Costume status updates automatically when stok changes
3. **File Upload**: Old photos automatically deleted when replaced
4. **Validation**: Happens server-side (Model), client-side errors shown inline
5. **Security**: All access protected by adminFilter
6. **Image Display**: Check file exists before showing in template

---

## 🐛 Debug Mode

Enable in `.env`:
```
CI_ENVIRONMENT = development
```

View errors in `writable/logs/`

---

**Quick Links:**
- [Full Documentation](TAHAP_4_DOCUMENTATION.md)
- [TAHAP 3 Reference](TAHAP_3_QUICK_START.md)
- [Testing Guide](TAHAP_4_TESTING_GUIDE.md)
