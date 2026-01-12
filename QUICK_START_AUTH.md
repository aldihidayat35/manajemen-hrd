# 🚀 QUICK START - Authentication, User Management & Pengaturan Aplikasi

## 📌 Ringkasan Singkat

Fitur yang baru saja dibuat:
1. **Authentication** (Login/Logout)
2. **User Management** (CRUD User dengan DataTables)
3. **Pengaturan Aplikasi Global** (Logo, Nama App, Copyright, dll)

---

## ⚡ INSTALASI CEPAT

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Jalankan Seeder (Buat User Default)
```bash
php artisan db:seed --class=UserSeeder
```

### 3. Buat Symlink Storage
```bash
php artisan storage:link
```

### 4. Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
```

---

## 🔐 LOGIN PERTAMA KALI

Akses: `http://localhost/hrd/login`

**Kredensial Admin:**
- Email: `admin@simrs.com`
- Password: `admin123`

**Kredensial Staff:**
- Email: `staff@simrs.com`
- Password: `staff123`

---

## 📍 MENU YANG TERSEDIA

Setelah login, Anda akan melihat menu:

1. **Dashboard** - Halaman utama
2. **Data Karyawan** - CRUD Karyawan (sudah ada sebelumnya)
3. **Manajemen User** - CRUD User ✨ NEW
4. **Pengaturan Aplikasi** - Update Logo, Nama App, dll ✨ NEW
5. **Logout** - Keluar dari sistem

---

## 🎯 FITUR UTAMA

### 1. PENGATURAN APLIKASI (PRIORITAS!)
- **Menu:** Pengaturan Aplikasi
- **Fungsi:** Update Logo, Favicon, Nama Aplikasi, Copyright
- **Efek:** Perubahan langsung terlihat di semua halaman (global)

### 2. MANAJEMEN USER
- **Menu:** Manajemen User
- **Fungsi:** CRUD User lengkap dengan avatar
- **Role:** admin, staff, user
- **Status:** Aktif/Tidak Aktif

### 3. AUTHENTICATION
- Login dengan validasi status aktif
- Remember Me
- Session management
- Redirect protection

---

## 🌟 INTEGRASI GLOBAL $appData

Data dari tabel `data_apps` otomatis tersedia di **SEMUA VIEW** dengan variabel `$appData`.

**Contoh Penggunaan:**
```blade
<!-- Nama Aplikasi -->
{{ $appData->nama_app }}

<!-- Logo -->
<img src="{{ asset('storage/' . $appData->logo) }}" />

<!-- Copyright -->
{{ $appData->copyright_text }}
```

**Sudah Diimplementasikan Di:**
- ✅ Login Page (logo & nama app)
- ✅ Sidebar (logo & user info)
- ✅ Header (logo)
- ✅ Footer (copyright)
- ✅ Page Title (nama app)
- ✅ Favicon (browser tab)

---

## 📂 FILE PENTING

### Controllers
- `app/Http/Controllers/AuthController.php`
- `app/Http/Controllers/UserController.php`
- `app/Http/Controllers/DataAppController.php`

### Models
- `app/Models/DataApp.php`
- `app/Models/User.php` (updated)

### Views
- `resources/views/auth/login.blade.php`
- `resources/views/users/index.blade.php`
- `resources/views/settings/data-app.blade.php`

### Provider
- `app/Providers/AppServiceProvider.php` (View::composer + Cache)

### Routes
- `routes/web.php` (semua route sudah ditambahkan)

---

## 🔄 ALUR KERJA

### First Time Setup:
1. Migrate database
2. Seed user default
3. Login sebagai admin
4. Update **Pengaturan Aplikasi** terlebih dahulu
5. Upload logo & favicon
6. Ubah nama aplikasi sesuai kebutuhan
7. Lihat perubahan langsung di semua halaman

### Daily Usage:
1. Login
2. Kelola user (tambah/edit/hapus)
3. Kelola karyawan
4. Update pengaturan jika diperlukan
5. Logout

---

## 🐛 TROUBLESHOOTING CEPAT

**Problem:** Logo tidak muncul
```bash
php artisan storage:link
```

**Problem:** $appData undefined
```bash
php artisan cache:clear
php artisan config:clear
```

**Problem:** Error upload file
- Cek permission folder `storage/`
- Cek `upload_max_filesize` di php.ini

---

## 📖 DOKUMENTASI LENGKAP

Lihat file: **AUTH_USER_SETTINGS_DOCUMENTATION.md**

Dokumentasi lengkap berisi:
- Database schema detail
- API endpoints lengkap
- Contoh code
- Security features
- Dan banyak lagi...

---

## ✨ TIPS & TRICKS

1. **Update Pengaturan Aplikasi Dulu!**
   - Ini akan mengubah tampilan aplikasi secara keseluruhan
   - Logo, nama, copyright langsung berubah di semua halaman

2. **Gunakan Role dengan Bijak:**
   - Admin: Full access
   - Staff: Untuk karyawan operasional
   - User: Untuk user terbatas

3. **Upload Avatar:**
   - Max 2MB untuk avatar user
   - Max 2MB untuk logo
   - Max 1MB untuk favicon

4. **Status Aktif/Tidak Aktif:**
   - User dengan status tidak aktif tidak bisa login
   - Gunakan fitur ini untuk suspend user sementara

---

## 🎉 SELAMAT!

Sistem Authentication, User Management, dan Pengaturan Aplikasi sudah siap digunakan!

**Next Steps:**
- Customize sesuai kebutuhan
- Tambahkan middleware role-based access control (jika diperlukan)
- Integrasikan dengan fitur lain

---

**Happy Coding! 🚀**
