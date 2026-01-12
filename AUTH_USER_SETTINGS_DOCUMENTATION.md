# DOKUMENTASI FITUR AUTHENTICATION, USER MANAGEMENT & PENGATURAN APLIKASI

## 📋 DAFTAR ISI
1. [Penjelasan Fitur](#penjelasan-fitur)
2. [Database Schema](#database-schema)
3. [Cara Instalasi](#cara-instalasi)
4. [Cara Penggunaan](#cara-penggunaan)
5. [Struktur File](#struktur-file)
6. [API Endpoints](#api-endpoints)

---

## 🎯 PENJELASAN FITUR

### 1. PENGATURAN APLIKASI (Data App) - GLOBAL INTEGRATION
**Single Row Logic** - Hanya 1 record yang digunakan untuk menyimpan data aplikasi.

**Field yang tersedia:**
- `nama_app`: Nama aplikasi (contoh: "SIM RS")
- `nama_instansi`: Nama institusi/rumah sakit
- `logo`: Path ke file logo (tersimpan di storage/app/public)
- `favicon`: Path ke file favicon
- `copyright_text`: Teks copyright untuk footer
- `alamat`: Alamat lengkap institusi
- `no_telp`: Nomor telepon institusi

**Integrasi Global:**
- Data dari tabel `data_apps` otomatis tersedia di **SEMUA file Blade** dengan variabel `$appData`
- Menggunakan `View::composer` di `AppServiceProvider`
- Di-cache selama 1 jam (3600 detik) untuk performa optimal
- Cache otomatis dihapus saat data diupdate

**Contoh Penggunaan di Blade:**
```blade
<!-- Nama Aplikasi -->
{{ $appData->nama_app }}

<!-- Logo -->
<img src="{{ asset('storage/' . $appData->logo) }}" alt="Logo" />

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('storage/' . $appData->favicon) }}" />

<!-- Copyright -->
{{ $appData->copyright_text }}
```

### 2. AUTHENTICATION
**Fitur:**
- Login dengan email & password
- Validasi status aktif user (kolom `is_active`)
- Remember Me checkbox
- Session management
- Redirect ke dashboard setelah login

**Security:**
- Password di-hash dengan bcrypt
- CSRF Protection
- Session regeneration setelah login
- Middleware authentication untuk route protection

### 3. USER MANAGEMENT
**Fitur CRUD Lengkap:**
- Create: Tambah user baru dengan validasi
- Read: List semua user dengan DataTables
- Update: Edit data user (password optional)
- Delete: Hapus user dengan konfirmasi

**Field User:**
- `name`: Nama lengkap
- `email`: Email (unique)
- `password`: Password (hashed)
- `role`: admin, staff, atau user
- `avatar`: Foto profil (optional)
- `is_active`: Status aktif/tidak aktif

**Tampilan:**
- Menggunakan DataTables Metronic dengan server-side processing
- AJAX untuk semua operasi CRUD
- Modal Bootstrap untuk form
- Upload avatar dengan preview
- Badge untuk role dan status

---

## 🗄️ DATABASE SCHEMA

### Tabel: `data_apps`
```sql
CREATE TABLE data_apps (
    id BIGINT UNSIGNED PRIMARY KEY,
    nama_app VARCHAR(100) DEFAULT 'SIM RS',
    nama_instansi VARCHAR(200) NULL,
    logo VARCHAR(255) NULL,
    favicon VARCHAR(255) NULL,
    copyright_text TEXT NULL,
    alamat TEXT NULL,
    no_telp VARCHAR(20) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabel: `users` (Modified)
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    role VARCHAR(50) DEFAULT 'staff' COMMENT 'admin, staff, user',
    avatar VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## ⚙️ CARA INSTALASI

### 1. Jalankan Migration
```bash
php artisan migrate
```

Migration yang akan dijalankan:
- `2026_01_09_000001_create_data_apps_table.php`
- `2026_01_09_000002_update_users_table_add_role_avatar.php`

### 2. Jalankan Seeder (Optional)
```bash
php artisan db:seed --class=UserSeeder
```

Ini akan membuat 3 user default:
- **Admin**: admin@simrs.com / admin123
- **Staff**: staff@simrs.com / staff123
- **User**: user@simrs.com / user123

### 3. Buat Symlink Storage
```bash
php artisan storage:link
```

### 4. Clear Cache (Jika Diperlukan)
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🚀 CARA PENGGUNAAN

### A. Login ke Sistem
1. Akses: `http://localhost/hrd/login`
2. Masukkan email & password
3. Klik "Login"

**Halaman Login:**
- Menampilkan logo dan nama aplikasi dari database
- Form dengan validasi
- Pesan error jika login gagal
- Redirect otomatis jika sudah login

### B. Manajemen User
**Akses Menu:** Sidebar → Manajemen User

**Tambah User:**
1. Klik tombol "Tambah User"
2. Isi form (nama, email, password, role, avatar)
3. Centang "Status Aktif" jika ingin user langsung aktif
4. Klik "Simpan"

**Edit User:**
1. Klik tombol Edit (icon pencil) pada row user
2. Form akan terisi otomatis
3. Password boleh dikosongkan (tidak diubah)
4. Klik "Simpan"

**Hapus User:**
1. Klik tombol Hapus (icon trash)
2. Konfirmasi hapus
3. User akan dihapus beserta avatarnya

### C. Pengaturan Aplikasi
**Akses Menu:** Sidebar → Pengaturan Aplikasi

**Update Pengaturan:**
1. Isi/ubah field yang diinginkan
2. Upload logo (max 2MB)
3. Upload favicon (max 1MB)
4. Klik "Simpan Perubahan"

**Efek Setelah Update:**
- Logo/nama aplikasi berubah di semua halaman
- Favicon browser berubah
- Copyright di footer berubah
- Cache otomatis di-refresh

### D. Logout
Klik menu "Logout" di sidebar atau header.

---

## 📁 STRUKTUR FILE

### Controllers
```
app/Http/Controllers/
├── AuthController.php          # Login, logout
├── UserController.php          # CRUD user + DataTables
└── DataAppController.php       # Update pengaturan app
```

### Models
```
app/Models/
├── User.php                    # Model user (updated)
└── DataApp.php                 # Model data aplikasi
```

### Views
```
resources/views/
├── auth/
│   └── login.blade.php         # Halaman login
├── users/
│   └── index.blade.php         # CRUD user dengan DataTables
├── settings/
│   └── data-app.blade.php      # Form pengaturan aplikasi
└── layouts/
    ├── app.blade.php           # Master layout (updated)
    ├── sidebar.blade.php       # Sidebar (updated)
    ├── header.blade.php        # Header (updated)
    └── footer.blade.php        # Footer (updated)
```

### Migrations
```
database/migrations/
├── 2026_01_09_000001_create_data_apps_table.php
└── 2026_01_09_000002_update_users_table_add_role_avatar.php
```

### Seeders
```
database/seeders/
├── DatabaseSeeder.php          # Main seeder (updated)
└── UserSeeder.php              # Seeder user default
```

### Routes
```
routes/
└── web.php                     # Semua route (updated)
```

### Providers
```
app/Providers/
└── AppServiceProvider.php      # Global view share (updated)
```

---

## 🔌 API ENDPOINTS

### Authentication Routes
| Method | URL | Name | Middleware | Description |
|--------|-----|------|------------|-------------|
| GET | `/login` | login | guest | Tampil form login |
| POST | `/login` | login.post | guest | Proses login |
| POST | `/logout` | logout | auth | Proses logout |

### User Management Routes
| Method | URL | Name | Middleware | Description |
|--------|-----|------|------------|-------------|
| GET | `/users` | users.index | auth | List user (view) |
| GET | `/users/data` | users.data | auth | DataTables JSON |
| POST | `/users` | users.store | auth | Tambah user |
| GET | `/users/{id}` | users.show | auth | Detail user (JSON) |
| PUT | `/users/{id}` | users.update | auth | Update user |
| DELETE | `/users/{id}` | users.destroy | auth | Hapus user |

### Settings Routes
| Method | URL | Name | Middleware | Description |
|--------|-----|------|------------|-------------|
| GET | `/settings/data-app` | settings.data-app.index | auth | Form pengaturan |
| PUT | `/settings/data-app` | settings.data-app.update | auth | Update pengaturan |
| POST | `/settings/data-app/remove-logo` | settings.data-app.remove-logo | auth | Hapus logo |
| POST | `/settings/data-app/remove-favicon` | settings.data-app.remove-favicon | auth | Hapus favicon |

---

## 🎨 INTEGRASI METRONIC THEME

### DataTables
- Menggunakan plugin DataTables dari Metronic
- Server-side processing untuk performa optimal
- Custom styling sesuai tema Metronic

### Form Components
- Form controls dengan class Metronic
- Image input component untuk avatar/logo
- Sweet Alert 2 untuk notifikasi

### Icons
- Menggunakan Keenicons dari Metronic
- Duotone style untuk icon menu

---

## 🔒 SECURITY FEATURES

1. **Authentication Middleware**: Semua route dilindungi dengan middleware `auth`
2. **CSRF Protection**: Semua form menggunakan `@csrf`
3. **Password Hashing**: Password di-hash dengan bcrypt
4. **Input Validation**: Validasi lengkap untuk semua input
5. **File Upload Validation**: Validasi type dan size untuk upload file
6. **Active User Check**: Hanya user dengan `is_active = true` yang bisa login

---

## 📝 CATATAN PENTING

### Cache Management
- Data aplikasi di-cache selama 1 jam
- Cache otomatis dihapus saat update data
- Manual clear cache: `Cache::forget('app_data_settings')`

### File Storage
- Logo disimpan di: `storage/app/public/app-assets/`
- Avatar disimpan di: `storage/app/public/avatars/`
- Pastikan folder `storage/app/public/` writable

### Default Data
- Migration otomatis insert 1 row default ke `data_apps`
- Seeder membuat 3 user default (admin, staff, user)

---

## 🐛 TROUBLESHOOTING

### Problem: Variabel $appData tidak tersedia
**Solusi:**
```bash
php artisan cache:clear
php artisan config:clear
```

### Problem: Logo/Avatar tidak muncul
**Solusi:**
```bash
php artisan storage:link
# Pastikan folder storage writable
chmod -R 775 storage
```

### Problem: Error saat upload file
**Solusi:**
- Cek `php.ini`: `upload_max_filesize` dan `post_max_size`
- Cek permission folder storage

---

## 👨‍💻 CONTOH PENGGUNAAN VARIABEL $appData

### Di Layout Master
```blade
<!-- Title -->
<title>@yield('title', $appData->nama_app ?? 'SIM RS')</title>

<!-- Favicon -->
@if($appData && $appData->favicon)
    <link rel="shortcut icon" href="{{ asset('storage/' . $appData->favicon) }}" />
@endif
```

### Di Sidebar
```blade
<!-- Logo di Sidebar -->
@if($appData && $appData->logo)
    <img src="{{ asset('storage/' . $appData->logo) }}" alt="{{ $appData->nama_app }}" />
@endif

<!-- Nama User & Role -->
<span>{{ Auth::user()->name }}</span>
<span>{{ ucfirst(Auth::user()->role) }}</span>
```

### Di Footer
```blade
<!-- Copyright Text -->
<span>{{ $appData->copyright_text ?? '© 2026 SIM RS. All Rights Reserved.' }}</span>
```

### Di Login Page
```blade
<!-- Logo -->
@if($appData && $appData->logo)
    <img alt="Logo" src="{{ asset('storage/' . $appData->logo) }}" />
@endif

<!-- Nama Aplikasi -->
<h2>{{ $appData->nama_app ?? 'SIM RS' }}</h2>

<!-- Nama Instansi -->
<p>{{ $appData->nama_instansi ?? 'Sistem Informasi Manajemen' }}</p>
```

---

## ✅ CHECKLIST IMPLEMENTASI

- [x] Migration tabel `data_apps` dengan single row logic
- [x] Migration update tabel `users` (role, avatar, is_active)
- [x] Model DataApp dengan method getInstance()
- [x] Model User updated dengan fillable dan casts
- [x] AppServiceProvider dengan View::composer dan Cache
- [x] AuthController dengan login/logout logic
- [x] UserController dengan CRUD lengkap
- [x] DataAppController dengan update & remove files
- [x] View login dengan Metronic style
- [x] View user management dengan DataTables
- [x] View pengaturan aplikasi
- [x] Update layout master dengan variabel dinamis
- [x] Update sidebar dengan logo & user info dinamis
- [x] Update header dengan logo dinamis
- [x] Update footer dengan copyright dinamis
- [x] Routes authentication & middleware
- [x] Routes user management
- [x] Routes settings
- [x] Seeder user default
- [x] Middleware Authenticate

---

## 📧 KREDENSIAL DEFAULT

Setelah menjalankan seeder:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@simrs.com | admin123 |
| Staff | staff@simrs.com | staff123 |
| User | user@simrs.com | user123 |

---

**Dibuat oleh:** Senior Laravel Developer  
**Tanggal:** 9 Januari 2026  
**Laravel Version:** 11.x  
**Template:** Metronic 8
