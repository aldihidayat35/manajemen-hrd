# Sistem Manajemen Data Karyawan

## Fitur yang Tersedia

### 1. CRUD (Create, Read, Update, Delete)
- **Create**: Tambah data karyawan baru melalui form modal
- **Read**: Tampilkan data karyawan dalam tabel dengan server-side processing
- **Update**: Edit data karyawan yang sudah ada
- **Delete**: Hapus data karyawan dengan konfirmasi

### 2. Export Excel
- Export seluruh data karyawan ke format Excel (.xlsx)
- File export otomatis terunduh dengan nama `karyawan_[timestamp].xlsx`
- Sudah dilengkapi dengan styling header

### 3. Import Excel
- Import data karyawan dari file Excel (.xlsx, .xls, .csv)
- Download template import untuk memudahkan format data
- Validasi otomatis untuk setiap baris data

### 4. Server-Side DataTables
- Menggunakan Yajra DataTables untuk processing data di server
- Performa optimal untuk data dalam jumlah besar
- Fitur pencarian, sorting, dan pagination otomatis

### 5. Template Metronic
- UI/UX menggunakan template Metronic
- Responsive design
- Icon set dari Keenicons

## Struktur Database

Tabel: `karyawan`

| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT | Primary Key |
| nikKry | VARCHAR(50) | NIK Karyawan |
| namaKaryawan | VARCHAR(255) | Nama Lengkap Karyawan |
| nikKtp | VARCHAR(16) | NIK KTP |
| unit | VARCHAR(100) | Unit/Departemen |
| gol | VARCHAR(50) | Golongan |
| profesi | VARCHAR(100) | Profesi/Jabatan |
| statusPegawai | VARCHAR(50) | Status (Tetap/Kontrak/Magang) |
| tempatLahir | VARCHAR(100) | Tempat Lahir |
| tglLahir | DATE | Tanggal Lahir |
| tglMulaiKerja | DATE | Tanggal Mulai Kerja |
| jenisKelamin | VARCHAR(20) | Jenis Kelamin (Laki-laki/Perempuan) |
| created_at | TIMESTAMP | Waktu pembuatan record |
| updated_at | TIMESTAMP | Waktu update record |

## File yang Dibuat

### 1. Model
- `app/Models/Karyawan.php` - Eloquent Model untuk tabel karyawan

### 2. Controller
- `app/Http/Controllers/KaryawanController.php` - Controller dengan semua logic CRUD, export, dan import

### 3. Export/Import Classes
- `app/Exports/KaryawanExport.php` - Class untuk export data ke Excel
- `app/Imports/KaryawanImport.php` - Class untuk import data dari Excel

### 4. Views
- `resources/views/karyawan/index.blade.php` - Halaman utama dengan tabel DataTables

### 5. Routes
- Routes sudah ditambahkan di `routes/web.php`

### 6. Sidebar Menu
- Menu "Data Karyawan" sudah ditambahkan di `resources/views/layout/aside/_menu.blade.php`

## Cara Menggunakan

### 1. Akses Halaman Karyawan
Buka browser dan akses: `http://localhost/karyawan`

### 2. Tambah Data Karyawan
- Klik tombol "Tambah Karyawan"
- Isi form yang muncul
- Klik "Simpan"

### 3. Edit Data Karyawan
- Klik icon pensil (Edit) pada baris data yang ingin diedit
- Ubah data yang diperlukan
- Klik "Simpan"

### 4. Hapus Data Karyawan
- Klik icon tempat sampah (Delete) pada baris data yang ingin dihapus
- Konfirmasi penghapusan
- Data akan terhapus

### 5. Export Data ke Excel
- Klik tombol "Export Excel"
- File Excel akan otomatis terunduh

### 6. Import Data dari Excel
- Klik tombol "Import Excel"
- Klik "Download Template" untuk mendapatkan format yang benar
- Isi template dengan data karyawan
- Upload file yang sudah diisi
- Klik "Import"

## Format Template Import

Template Excel harus memiliki header berikut:

| nik_karyawan | nama_karyawan | nik_ktp | unit | golongan | profesi | status_pegawai | tempat_lahir | tanggal_lahir | tanggal_mulai_kerja | jenis_kelamin |
|--------------|---------------|---------|------|----------|---------|----------------|--------------|---------------|---------------------|---------------|
| K001 | John Doe | 1234567890123456 | IT Department | III/A | Software Developer | Tetap | Jakarta | 01-01-1990 | 01-01-2020 | Laki-laki |

**Catatan:**
- Format tanggal: `dd-mm-yyyy` atau `dd/mm/yyyy`
- Jenis Kelamin: `Laki-laki` atau `Perempuan`
- Status Pegawai: `Tetap`, `Kontrak`, atau `Magang`

## Package yang Digunakan

1. **Yajra DataTables Oracle** (`yajra/laravel-datatables-oracle`) - Untuk server-side DataTables
2. **Laravel Excel** (`maatwebsite/excel`) - Untuk export dan import Excel

## API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/karyawan` | Tampilkan halaman index |
| GET | `/karyawan/getData` | Get data untuk DataTables (AJAX) |
| POST | `/karyawan` | Simpan data karyawan baru |
| GET | `/karyawan/{id}` | Get detail karyawan |
| PUT | `/karyawan/{id}` | Update data karyawan |
| DELETE | `/karyawan/{id}` | Hapus data karyawan |
| GET | `/karyawan/export/excel` | Export data ke Excel |
| POST | `/karyawan/import/excel` | Import data dari Excel |
| GET | `/karyawan/download/template` | Download template import |

## Teknologi

- **Backend**: Laravel 11
- **Frontend**: Blade Template, jQuery, Bootstrap 5
- **UI Framework**: Metronic Theme
- **DataTables**: Yajra DataTables (Server-side)
- **Excel Processing**: Maatwebsite Excel
- **Icons**: Keenicons (ki-duotone)
- **Notifications**: SweetAlert2

## Troubleshooting

### Error: DataTables not defined
Pastikan file berikut sudah di-include di layout:
```html
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
```

### Error: Swal is not defined
Pastikan SweetAlert2 sudah di-include di `plugins.bundle.js`

### Error saat import Excel
- Pastikan format file adalah .xlsx, .xls, atau .csv
- Pastikan header sesuai dengan template
- Pastikan format tanggal sesuai (dd-mm-yyyy atau dd/mm/yyyy)

### DataTables tidak muncul
- Buka Console browser (F12) untuk melihat error
- Pastikan route `karyawan.getData` bisa diakses
- Cek apakah ada error di Network tab

## Lisensi

Sistem ini dibuat untuk keperluan internal manajemen HRD.
