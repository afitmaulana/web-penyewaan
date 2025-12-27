# 📊 TAHAP 2: DESAIN DATABASE & MIGRATION

**Aplikasi:** Rental Kostum  
**Framework:** CodeIgniter 4  
**Database:** MySQL 5.7+  
**Created:** 27 December 2024  
**Status:** ✅ Database Design Complete

---

## 📋 DAFTAR ISI

1. [Database Design Overview](#database-design-overview)
2. [Tabel: Users](#tabel-users)
3. [Tabel: Kategori](#tabel-kategori)
4. [Tabel: Kostum](#tabel-kostum)
5. [Tabel: Penyewaan](#tabel-penyewaan)
6. [Tabel: Pembayaran](#tabel-pembayaran)
7. [Tabel: Pengembalian](#tabel-pengembalian)
8. [Entity Relationship Diagram](#entity-relationship-diagram)
9. [Relasi Antar Tabel](#relasi-antar-tabel)
10. [Migration CodeIgniter 4](#migration-codeigniter-4)
11. [Seeder CodeIgniter 4](#seeder-codeigniter-4)
12. [Tips & Best Practices](#tips--best-practices)

---

## 🎯 DATABASE DESIGN OVERVIEW

### Filosofi Design
- ✅ **Normalisasi:** Database dinormalisasi hingga 3NF
- ✅ **Relasi:** Menggunakan foreign key untuk integritas data
- ✅ **Scalability:** Dirancang untuk mudah di-extend di masa depan
- ✅ **Performance:** Index pada field yang sering di-query
- ✅ **Security:** Password di-hash, role-based access
- ✅ **Audit Trail:** Timestamps untuk created_at dan updated_at

### Struktur Umum Setiap Tabel
```
id (PK)                          - Primary Key (AUTO_INCREMENT)
[field-field utama]              - Sesuai keperluan
created_at (TIMESTAMP)           - Waktu create record
updated_at (TIMESTAMP)           - Waktu update record
[foreign_key_id (FK)]            - Relasi ke tabel lain
```

### Konvensi Penamaan
- **Tabel:** `singular` (users, bukan user)
- **Field:** `snake_case` (created_at, bukan createdAt)
- **FK:** `{table_singular}_id` (user_id, kostum_id)
- **Boolean:** prefix `is_` atau `has_` (is_active, is_admin)

---

## 👥 TABEL: USERS

**Fungsi:** Menyimpan data user (Admin & Pelanggan)  
**Primary Key:** id  
**Relationships:** 1 user → Many penyewaan

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| nama_lengkap | VARCHAR | 100 | NO | - | Nama lengkap user |
| email | VARCHAR | 100 | NO | - | Email unik untuk login |
| password | VARCHAR | 255 | NO | - | Password terenkripsi (bcrypt) |
| nomor_hp | VARCHAR | 15 | YES | NULL | Nomor HP untuk kontak |
| alamat | TEXT | - | YES | NULL | Alamat lengkap |
| kota | VARCHAR | 50 | YES | NULL | Nama kota/kabupaten |
| provinsi | VARCHAR | 50 | YES | NULL | Nama provinsi |
| kode_pos | VARCHAR | 10 | YES | NULL | Kode pos |
| role | ENUM | - | NO | 'pelanggan' | 'admin' atau 'pelanggan' |
| is_active | BOOLEAN | - | NO | 1 | 1 = active, 0 = inactive |
| last_login | TIMESTAMP | - | YES | NULL | Waktu login terakhir |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu create record |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Penjelasan Field Penting

**email:**
- Unique key untuk login
- Format validation dengan email regex
- Case-insensitive untuk keamanan

**password:**
- Tersimpan dalam bentuk hash (bcrypt)
- Minimum 60 karakter (bcrypt hash length)
- Nikah update ketika user ganti password

**role:**
- ENUM('admin', 'pelanggan')
- Admin: Dapat manage kostum, kategori, lihat semua penyewaan
- Pelanggan: Hanya bisa melihat kostum dan membuat penyewaan sendiri

**is_active:**
- 1 = user aktif (bisa login)
- 0 = user sudah dihapus tapi record tetap ada (soft delete)

**last_login:**
- Tracking kapan user terakhir login
- Membantu security monitoring

---

## 🎭 TABEL: KATEGORI

**Fungsi:** Menyimpan data kategori kostum  
**Primary Key:** id  
**Relationships:** 1 kategori → Many kostum

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| nama_kategori | VARCHAR | 100 | NO | - | Nama kategori kostum |
| deskripsi | TEXT | - | YES | NULL | Deskripsi kategori |
| is_active | BOOLEAN | - | NO | 1 | 1 = aktif, 0 = inactive |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu create record |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Contoh Data Kategori
```
1. Kostum Tradisional (Batik, Kebaya, dll)
2. Kostum Karakter (Superhero, Anime, dll)
3. Kostum Festival (Natal, Halloween, dll)
4. Kostum Tema (Pesta, Dekorasi, dll)
5. Kostum Profesional (Nurse, Pilot, dll)
```

---

## 🎪 TABEL: KOSTUM

**Fungsi:** Menyimpan data kostum  
**Primary Key:** id  
**Foreign Keys:** kategori_id  
**Relationships:** 1 kostum → Many penyewaan

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| kategori_id | INT | - | NO | - | Foreign Key to kategori |
| nama_kostum | VARCHAR | 100 | NO | - | Nama kostum |
| deskripsi | TEXT | - | YES | NULL | Deskripsi detail kostum |
| ukuran | VARCHAR | 20 | NO | - | Ukuran (S, M, L, XL, XXL) |
| warna | VARCHAR | 50 | NO | - | Warna kostum |
| harga_sewa_per_hari | DECIMAL | 10,2 | NO | - | Harga sewa per hari (Rp) |
| harga_sewa_per_minggu | DECIMAL | 10,2 | YES | NULL | Harga sewa per minggu (Rp) |
| stok_tersedia | INT | - | NO | 0 | Jumlah kostum siap sewa |
| stok_total | INT | - | NO | 0 | Total stok kostum |
| foto_url | VARCHAR | 255 | YES | NULL | URL foto kostum |
| is_active | BOOLEAN | - | NO | 1 | 1 = aktif, 0 = inactive |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu create record |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Penjelasan Field Penting

**kategori_id:**
- Foreign Key ke tabel kategori
- Wajib ada, tidak boleh NULL
- ON DELETE CASCADE (jika kategori dihapus, kostum juga dihapus)

**ukuran:**
- Predefined: S, M, L, XL, XXL
- Bisa extend dengan enum atau check constraint

**harga_sewa_per_hari vs per_minggu:**
- harga_per_hari: required, minimal tarif
- harga_per_minggu: optional, untuk diskon minggu-an
- Jika tidak ada harga_per_minggu, sistem hitung dari harga_per_hari * 7

**stok_tersedia vs stok_total:**
- stok_total: total kostum yang ada
- stok_tersedia: stok yang bisa disewa (total - yang sedang disewa)
- stok_tersedia dihitung dari penyewaan yang active

---

## 📝 TABEL: PENYEWAAN

**Fungsi:** Menyimpan transaksi sewa kostum  
**Primary Key:** id  
**Foreign Keys:** user_id, kostum_id  
**Relationships:** 1 penyewaan → 1 pembayaran, 1 pengembalian

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| user_id | INT | - | NO | - | Foreign Key to users (pelanggan) |
| kostum_id | INT | - | NO | - | Foreign Key to kostum |
| tanggal_sewa | DATE | - | NO | - | Tanggal sewa mulai |
| tanggal_pengembalian_target | DATE | - | NO | - | Tanggal pengembalian yang direncanakan |
| durasi_hari | INT | - | NO | - | Jumlah hari sewa (dihitung otomatis) |
| harga_sewa_per_hari | DECIMAL | 10,2 | NO | - | Harga per hari saat sewa (snapshot) |
| subtotal_sewa | DECIMAL | 10,2 | NO | - | Subtotal = durasi_hari * harga_per_hari |
| biaya_lainnya | DECIMAL | 10,2 | NO | 0 | Biaya tambahan (delivery, dll) |
| diskon | DECIMAL | 10,2 | NO | 0 | Diskon yang diberikan |
| total_harga | DECIMAL | 10,2 | NO | - | Total = subtotal + biaya - diskon |
| status_penyewaan | ENUM | - | NO | 'pending_bayar' | Status: pending_bayar, aktif, selesai |
| catatan | TEXT | - | YES | NULL | Catatan khusus dari pelanggan |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu create record |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Status Penyewaan
```
pending_bayar      → Menunggu pembayaran
aktif              → Kostum sudah disewa (pembayaran confirmed)
selesai            → Kostum sudah dikembalikan
dibatalkan         → Penyewaan dibatalkan
```

### Penjelasan Field Penting

**user_id & kostum_id:**
- Both are Foreign Keys
- Wajib ada, tidak boleh NULL
- Membentuk relasi pelanggan & kostum

**tanggal_sewa & tanggal_pengembalian_target:**
- Tanggal sewa TIDAK boleh kurang dari hari ini
- Tanggal pengembalian HARUS lebih besar dari tanggal sewa
- Format: YYYY-MM-DD

**durasi_hari:**
- Dihitung otomatis: `DATEDIFF(tanggal_pengembalian_target, tanggal_sewa)`
- Minimal 1 hari

**harga_sewa_per_hari:**
- Snapshot dari harga kostum saat penyewaan dibuat
- Jika harga kostum berubah, harga penyewaan lama tidak terpengaruh

**subtotal_sewa, biaya_lainnya, diskon, total_harga:**
- Semua calculated field
- Untuk transparent pricing

**status_penyewaan:**
- pending_bayar: Menunggu pembayaran di-confirm
- aktif: Pelanggan sudah membayar, kostum bisa diambil
- selesai: Kostum sudah dikembalikan & pengembalian diverify
- dibatalkan: Penyewaan dibatalkan (bisa refund)

---

## 💳 TABEL: PEMBAYARAN

**Fungsi:** Menyimpan data pembayaran untuk penyewaan  
**Primary Key:** id  
**Foreign Keys:** penyewaan_id, user_id  
**Relationships:** 1 penyewaan ← 1 pembayaran

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| penyewaan_id | INT | - | NO | - | Foreign Key to penyewaan (UNIQUE) |
| user_id | INT | - | NO | - | Foreign Key to users (pembayar) |
| metode_pembayaran | VARCHAR | 50 | NO | - | Transfer, E-wallet, Cicilan, dll |
| jumlah_dibayar | DECIMAL | 10,2 | NO | - | Jumlah uang yang dibayarkan |
| bukti_pembayaran_url | VARCHAR | 255 | YES | NULL | URL foto/dokumen bukti pembayaran |
| status_pembayaran | ENUM | - | NO | 'pending' | pending, confirmed, expired, rejected |
| catatan_pembayaran | TEXT | - | YES | NULL | Catatan dari admin/pelanggan |
| tanggal_pembayaran | TIMESTAMP | - | YES | NULL | Tanggal pembayaran (saat confirm) |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu record dibuat |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Status Pembayaran
```
pending       → Menunggu verifikasi bukti dari admin
confirmed     → Pembayaran sudah diverifikasi & accepted
expired       → Waktu tunggu pembayaran sudah lewat
rejected      → Pembayaran ditolak (bisa ulangi)
```

### Penjelasan Field Penting

**penyewaan_id:**
- Foreign Key ke penyewaan
- UNIQUE: 1 penyewaan hanya 1 pembayaran
- ON DELETE CASCADE: Jika penyewaan dihapus, pembayaran juga dihapus

**metode_pembayaran:**
- Transfer Bank
- E-wallet (GCash, OVO, Dana)
- Cicilan (Kredivo, dll)
- Cash (bayar langsung)
- Predefined list atau VARCHAR

**bukti_pembayaran_url:**
- URL ke file/foto bukti transfer
- Optional (bisa NULL untuk bayar cash)
- Disimpan di cloud storage atau direktori lokal

**status_pembayaran:**
- pending: Admin belum verifikasi bukti
- confirmed: Admin sudah verifikasi, pembayaran accepted
- expired: Waktu pembayaran (misal 2 jam) sudah habis
- rejected: Bukti tidak sesuai, diminta ulangi

**tanggal_pembayaran:**
- Tanggal saat pembayaran di-confirm
- Berbeda dengan created_at
- Bisa NULL jika belum diconfirm

---

## 📦 TABEL: PENGEMBALIAN

**Fungsi:** Menyimpan data pengembalian kostum  
**Primary Key:** id  
**Foreign Keys:** penyewaan_id, user_id  
**Relationships:** 1 penyewaan → 1 pengembalian

### Struktur Field

| Field | Type | Length | Nullable | Default | Keterangan |
|-------|------|--------|----------|---------|-----------|
| id | INT | - | NO | AUTO_INCREMENT | Primary Key |
| penyewaan_id | INT | - | NO | - | Foreign Key to penyewaan (UNIQUE) |
| user_id | INT | - | NO | - | Foreign Key to users (pengembalian) |
| tanggal_pengembalian_aktual | DATE | - | NO | - | Tanggal kostum dikembalikan |
| status_kondisi | ENUM | - | NO | 'baik' | baik, lecet, rusak_ringan, rusak_berat |
| catatan_kondisi | TEXT | - | YES | NULL | Catatan detail kondisi kostum |
| denda_keterlambatan | DECIMAL | 10,2 | NO | 0 | Denda jika pengembalian terlambat |
| biaya_perbaikan | DECIMAL | 10,2 | NO | 0 | Biaya perbaikan jika rusak |
| total_denda | DECIMAL | 10,2 | NO | 0 | Total denda = keterlambatan + perbaikan |
| foto_kondisi_url | VARCHAR | 255 | YES | NULL | URL foto kondisi kostum saat dikembalikan |
| status_pengembalian | ENUM | - | NO | 'pending_verifikasi' | pending_verifikasi, accepted, rejected |
| catatan_admin | TEXT | - | YES | NULL | Catatan dari admin |
| created_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP | Waktu record dibuat |
| updated_at | TIMESTAMP | - | NO | CURRENT_TIMESTAMP ON UPDATE | Waktu update record |

### Status Kondisi
```
baik          → Kostum dalam kondisi sempurna
lecet         → Ada lecet kecil, tidak mencolok
rusak_ringan  → Ada kerusakan kecil, bisa diperbaiki
rusak_berat   → Kerusakan parah, tidak bisa diperbaiki
hilang        → Kostum hilang/tidak dikembalikan
```

### Status Pengembalian
```
pending_verifikasi  → Admin belum verifikasi kondisi
accepted            → Kondisi accept, pengembalian selesai
rejected            → Ada masalah, diminta verifikasi ulang
```

### Penjelasan Field Penting

**tanggal_pengembalian_aktual:**
- Tanggal nyata kostum dikembalikan
- Bisa berbeda dengan tanggal_pengembalian_target dari penyewaan
- Jika lebih lambat: ada denda keterlambatan

**status_kondisi:**
- baik: Tidak ada kerusakan
- lecet: Kerusakan kosmetik ringan
- rusak_ringan: Bisa diperbaiki
- rusak_berat: Tidak bisa diperbaiki / musnahkan
- hilang: Kostum tidak dikembalikan

**denda_keterlambatan:**
- Dihitung: (tanggal_aktual - tanggal_target) * denda_per_hari
- Otomatis calculated saat input tanggal_pengembalian_aktual

**biaya_perbaikan:**
- Fixed cost berdasarkan status_kondisi
- Atau bisa custom sesuai kerusakan

**total_denda:**
- Total = denda_keterlambatan + biaya_perbaikan
- Ini harus dibayar pelanggan

**foto_kondisi_url:**
- Foto dokumentasi kostum saat dikembalikan
- Evidence untuk claim jika ada dispute

---

## 🔗 ENTITY RELATIONSHIP DIAGRAM

```
┌──────────────┐
│    USERS     │
├──────────────┤
│ id (PK)      │
│ email (UK)   │
│ password     │
│ role         │
│ ...          │
└──────┬───────┘
       │
       ├──────────────────────────┬─────────────────────┐
       │                          │                     │
       │ 1-to-many               │ 1-to-many          │ 1-to-many
       │                          │                     │
       ▼                          ▼                     ▼
┌─────────────────┐       ┌──────────────────┐  ┌──────────────────┐
│   PENYEWAAN     │       │   PEMBAYARAN     │  │  PENGEMBALIAN    │
├─────────────────┤       ├──────────────────┤  ├──────────────────┤
│ id (PK)         │◄──────│ id (PK)          │  │ id (PK)          │
│ user_id (FK)    │   1-1 │ penyewaan_id(FK) │  │ penyewaan_id(FK) │
│ kostum_id (FK)  │       │ user_id (FK)     │  │ user_id (FK)     │
│ status_penyewaan│       │ status_pembayaran│  │ status_kondisi   │
│ tanggal_sewa    │       │ jumlah_dibayar   │  │ tanggal_pengemb. │
│ total_harga     │       │ metode_pembayaran│  │ total_denda      │
└────────┬────────┘       └──────────────────┘  └──────────────────┘
         │
         │ many-to-one
         │
         ▼
    ┌─────────────────┐
    │    KOSTUM       │
    ├─────────────────┤
    │ id (PK)         │
    │ kategori_id(FK) │
    │ nama_kostum     │
    │ harga_sewa_...  │
    │ stok_tersedia   │
    └────────┬────────┘
             │
             │ many-to-one
             │
             ▼
    ┌─────────────────┐
    │   KATEGORI      │
    ├─────────────────┤
    │ id (PK)         │
    │ nama_kategori   │
    │ deskripsi       │
    └─────────────────┘
```

---

## 🔐 RELASI ANTAR TABEL

### 1. USERS ↔ KATEGORI
- **Relasi:** No relation (independent)
- **Keterangan:** Users tidak memiliki relasi langsung ke kategori

### 2. USERS ↔ KOSTUM
- **Relasi:** No relation (independent)
- **Keterangan:** Users tidak memiliki relasi langsung ke kostum (hanya melalui penyewaan)

### 3. USERS ↔ PENYEWAAN
- **Relasi:** 1 user → Many penyewaan
- **Foreign Key:** penyewaan.user_id → users.id
- **On Delete:** CASCADE (jika user dihapus, penyewaan juga dihapus)
- **Constraint:** 
  ```sql
  ALTER TABLE penyewaan 
  ADD FOREIGN KEY (user_id) 
  REFERENCES users(id) 
  ON DELETE CASCADE;
  ```

### 4. USERS ↔ PEMBAYARAN
- **Relasi:** 1 user → Many pembayaran
- **Foreign Key:** pembayaran.user_id → users.id
- **On Delete:** CASCADE
- **Keterangan:** Tracking siapa yang bayar

### 5. USERS ↔ PENGEMBALIAN
- **Relasi:** 1 user → Many pengembalian
- **Foreign Key:** pengembalian.user_id → users.id
- **On Delete:** CASCADE
- **Keterangan:** Tracking siapa yang kembalikan

### 6. KATEGORI ↔ KOSTUM
- **Relasi:** 1 kategori → Many kostum
- **Foreign Key:** kostum.kategori_id → kategori.id
- **On Delete:** CASCADE (jika kategori dihapus, kostum juga dihapus)
- **Constraint:**
  ```sql
  ALTER TABLE kostum 
  ADD FOREIGN KEY (kategori_id) 
  REFERENCES kategori(id) 
  ON DELETE CASCADE;
  ```

### 7. KOSTUM ↔ PENYEWAAN
- **Relasi:** 1 kostum → Many penyewaan
- **Foreign Key:** penyewaan.kostum_id → kostum.id
- **On Delete:** CASCADE
- **Constraint:**
  ```sql
  ALTER TABLE penyewaan 
  ADD FOREIGN KEY (kostum_id) 
  REFERENCES kostum(id) 
  ON DELETE CASCADE;
  ```

### 8. PENYEWAAN ↔ PEMBAYARAN
- **Relasi:** 1 penyewaan ↔ 1 pembayaran (One-to-One)
- **Foreign Key:** pembayaran.penyewaan_id → penyewaan.id (UNIQUE)
- **On Delete:** CASCADE
- **Constraint:**
  ```sql
  ALTER TABLE pembayaran 
  ADD UNIQUE KEY unique_penyewaan_id (penyewaan_id),
  ADD FOREIGN KEY (penyewaan_id) 
  REFERENCES penyewaan(id) 
  ON DELETE CASCADE;
  ```

### 9. PENYEWAAN ↔ PENGEMBALIAN
- **Relasi:** 1 penyewaan ↔ 1 pengembalian (One-to-One)
- **Foreign Key:** pengembalian.penyewaan_id → penyewaan.id (UNIQUE)
- **On Delete:** CASCADE
- **Constraint:**
  ```sql
  ALTER TABLE pengembalian 
  ADD UNIQUE KEY unique_penyewaan_id (penyewaan_id),
  ADD FOREIGN KEY (penyewaan_id) 
  REFERENCES penyewaan(id) 
  ON DELETE CASCADE;
  ```

---

## 📋 INDEX YANG DIPERLUKAN

Untuk optimization query:

```sql
-- USERS
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_role ON users(role);

-- KATEGORI
CREATE INDEX idx_kategori_is_active ON kategori(is_active);

-- KOSTUM
CREATE INDEX idx_kostum_kategori_id ON kostum(kategori_id);
CREATE INDEX idx_kostum_is_active ON kostum(is_active);

-- PENYEWAAN
CREATE INDEX idx_penyewaan_user_id ON penyewaan(user_id);
CREATE INDEX idx_penyewaan_kostum_id ON penyewaan(kostum_id);
CREATE INDEX idx_penyewaan_status ON penyewaan(status_penyewaan);
CREATE INDEX idx_penyewaan_tanggal_sewa ON penyewaan(tanggal_sewa);

-- PEMBAYARAN
CREATE INDEX idx_pembayaran_penyewaan_id ON pembayaran(penyewaan_id);
CREATE INDEX idx_pembayaran_user_id ON pembayaran(user_id);
CREATE INDEX idx_pembayaran_status ON pembayaran(status_pembayaran);

-- PENGEMBALIAN
CREATE INDEX idx_pengembalian_penyewaan_id ON pengembalian(penyewaan_id);
CREATE INDEX idx_pengembalian_user_id ON pengembalian(user_id);
```

---

## ✅ MIGRATION CODEIGNITER 4

Lihat file migration di `app/Database/Migrations/`

---

## 🌱 SEEDER CODEIGNITER 4

Lihat file seeder di `app/Database/Seeds/`

---

## 📝 TIPS & BEST PRACTICES

### 1. Database Design
✅ **Normalization**
- Hindari data duplication
- Setiap field hanya tergantung pada primary key
- Separasi entity yang berbeda

✅ **Foreign Keys**
- Selalu gunakan FK untuk relasi
- Set ON DELETE CASCADE untuk soft-delete
- Maintain referential integrity

✅ **Timestamps**
- Selalu ada created_at dan updated_at
- Gunakan TIMESTAMP untuk auto-update
- Berguna untuk audit trail

✅ **Naming Convention**
- Tabel: singular (users, bukan user)
- Field: snake_case (created_at, bukan createdAt)
- FK: {table}_id (user_id, bukan userid)
- Boolean: is_/has_ prefix (is_active, has_role)

### 2. Data Integrity
✅ **Constraints**
```sql
-- NOT NULL untuk field wajib
-- UNIQUE untuk email, username
-- DEFAULT untuk field dengan nilai default
-- CHECK untuk nilai range
-- FOREIGN KEY untuk relasi
```

✅ **Type Safety**
- Gunakan tipe data yang tepat (INT, VARCHAR, DECIMAL, DATE, TIMESTAMP)
- DECIMAL untuk harga (bukan FLOAT)
- DATE untuk tanggal tanpa waktu
- TIMESTAMP untuk dengan waktu

### 3. Performance
✅ **Indexing**
- Index pada FK
- Index pada field yang sering di-query
- Index pada field di WHERE clause
- Hindari over-indexing (slow write)

✅ **Query Optimization**
- Select hanya field yang diperlukan
- Use JOIN untuk relasi
- Use WHERE untuk filter
- Use LIMIT untuk pagination

### 4. Security
✅ **Password**
- Hash dengan bcrypt
- Minimum length 60 char untuk hash
- Never store plain password

✅ **Data Validation**
- Validate di application layer
- Constraint di database layer
- Double check untuk sensitive data

✅ **SQL Injection**
- Gunakan prepared statements
- CodeIgniter 4 otomatis prevent SQL injection dengan QueryBuilder

### 5. Business Logic
✅ **Status Tracking**
- Penyewaan: pending_bayar → aktif → selesai
- Pembayaran: pending → confirmed/rejected
- Pengembalian: pending_verifikasi → accepted/rejected

✅ **Financial Accuracy**
- Hitung price saat create penyewaan (snapshot)
- Total harga = subtotal + biaya - diskon
- Denda = keterlambatan + perbaikan

✅ **Audit Trail**
- created_at untuk tracking kapan dibuat
- updated_at untuk tracking kapan update
- Field history untuk soft-delete scenarios

---

## 🚀 EXECUTION FLOW

### 1. Create Migration Files
```bash
php spark migrate:create CreateUsersTable
php spark migrate:create CreateKategoriTable
php spark migrate:create CreateKostumTable
php spark migrate:create CreatePenyewaanTable
php spark migrate:create CreatePembayaranTable
php spark migrate:create CreatePengembalianTable
```

### 2. Edit Migration Files
- Add fields sesuai design
- Add foreign keys
- Add constraints & indexes
- Add timestamps

### 3. Run Migrations
```bash
php spark migrate
```

### 4. Create Seeder Files
```bash
php spark seed:make AdminSeeder
php spark seed:make KategoriSeeder
php spark seed:make KostumSeeder
```

### 5. Run Seeders
```bash
php spark db:seed AdminSeeder
php spark db:seed KategoriSeeder
php spark db:seed KostumSeeder
```

### 6. Verify
```bash
php spark db:seed RollbackSeeder (if needed)
php spark migrate:refresh (reset all)
```

---

## 📚 REFERENSI

- [CodeIgniter 4 Migrations](https://codeigniter.com/user_guide/dbutil/migration.html)
- [CodeIgniter 4 Seeders](https://codeigniter.com/user_guide/dbutil/seeds.html)
- [MySQL Data Types](https://dev.mysql.com/doc/refman/5.7/en/data-types.html)
- [Database Normalization](https://en.wikipedia.org/wiki/Database_normalization)

---

**Status:** ✅ Database Design Complete  
**Version:** 1.0.0  
**Last Updated:** 27 December 2024

Next Step: Buat migration files untuk setiap tabel

