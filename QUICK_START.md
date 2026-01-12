# Quick Start Guide - Manajemen Data Karyawan

## 🚀 Akses Aplikasi

1. Pastikan server Laravel sudah berjalan:
   ```bash
   php artisan serve
   ```

2. Buka browser dan akses:
   ```
   http://127.0.0.1:8000/karyawan
   ```

## 📋 Fitur Utama

### 1️⃣ Tambah Data Karyawan
- Klik tombol **"Tambah Karyawan"** (biru)
- Isi semua field yang required (bertanda *)
- Klik **"Simpan"**

### 2️⃣ Edit Data Karyawan
- Klik icon **pensil (✏️)** pada baris data
- Ubah data yang diperlukan
- Klik **"Simpan"**

### 3️⃣ Hapus Data Karyawan
- Klik icon **tempat sampah (🗑️)** pada baris data
- Konfirmasi penghapusan
- Data akan terhapus

### 4️⃣ Export ke Excel
- Klik tombol **"Export Excel"** (hijau muda)
- File Excel akan otomatis terunduh dengan nama `karyawan_[timestamp].xlsx`

### 5️⃣ Import dari Excel
1. Klik tombol **"Import Excel"** (hijau)
2. Klik **"Download Template"** untuk mendapatkan format yang benar
3. Isi template dengan data karyawan (gunakan contoh di file atau isi sendiri)
4. Upload file yang sudah diisi
5. Klik **"Import"**
6. Tunggu proses selesai

### 6️⃣ Pencarian Data
- Gunakan kolom pencarian di atas tabel
- Ketik nama, NIK, atau data lainnya
- Tabel akan otomatis filter

## 📝 Field Wajib Diisi

| Field | Format | Contoh |
|-------|--------|--------|
| NIK Karyawan | String (max 50) | K001 |
| Nama Karyawan | String (max 255) | John Doe |
| NIK KTP | 16 digit | 1234567890123456 |
| Unit | String (max 100) | IT Department |
| Golongan | String (max 50) | III/A |
| Profesi | String (max 100) | Software Developer |
| Status Pegawai | Tetap/Kontrak/Magang | Tetap |
| Tempat Lahir | String (max 100) | Jakarta |
| Tanggal Lahir | Date | 01-01-1990 |
| Tanggal Mulai Kerja | Date | 01-01-2020 |
| Jenis Kelamin | Laki-laki/Perempuan | Laki-laki |

## 📊 Data Sample

Sistem sudah terisi dengan 10 data sample untuk testing. Anda bisa:
- Melihat data yang sudah ada
- Mengedit data sample
- Menghapus data sample
- Menambah data baru

## 🔧 Troubleshooting

### Tabel tidak muncul
1. Buka Console Browser (F12)
2. Cek tab Console untuk error JavaScript
3. Cek tab Network untuk error AJAX
4. Pastikan route `/karyawan/getData` bisa diakses

### Error saat Import
1. Pastikan format file: `.xlsx`, `.xls`, atau `.csv`
2. Pastikan header file sesuai template
3. Pastikan format tanggal: `dd-mm-yyyy` atau `dd/mm/yyyy`
4. Pastikan NIK Karyawan unik (tidak duplikat)

### Button tidak berfungsi
1. Pastikan JavaScript sudah loaded
2. Refresh halaman (Ctrl+F5)
3. Clear cache browser

## 🎯 Tips

1. **Gunakan template saat import** - Download template untuk memastikan format benar
2. **Backup data** - Export data secara berkala sebagai backup
3. **Validasi sebelum import** - Pastikan data di Excel sudah benar sebelum import
4. **NIK harus unik** - Setiap karyawan harus punya NIK yang berbeda

## 📞 Support

Jika menemukan masalah, periksa:
1. Log Laravel: `storage/logs/laravel.log`
2. Console Browser (F12)
3. Network tab di Developer Tools

---

**Selamat menggunakan Sistem Manajemen Data Karyawan! 🎉**
