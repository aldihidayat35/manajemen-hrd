# Update Import Karyawan

## Perubahan yang Dilakukan

### 1. Format CSV/Excel yang Didukung

Format header CSV sekarang sesuai dengan database Anda:

```
NIK Karyawan,Nama Karyawan,NIK KTP,Unit,Golongan,Profesi,Status Pegawai,Tempat Lahir,Tanggal Lahir,Umur,Jenis Kelamin
```

**Catatan:**
- Kolom "Umur" diabaikan saat import (dihitung otomatis dari tanggal lahir)
- Kolom "Tanggal Mulai Kerja" diset otomatis ke tanggal hari ini jika tidak ada dalam file

### 2. Format Tanggal yang Didukung

Import sekarang mendukung format tanggal Indonesia:
- `07 April 2000`
- `21 Maret 1996`
- `15 Mei 1988`
- Dan format lain: `01-01-1990`, `01/01/1990`, dll

Bulan dalam bahasa Indonesia akan otomatis dikonversi:
- Januari → January
- Februari → February
- Maret → March
- April → April
- Mei → May
- Juni → June
- Juli → July
- Agustus → August
- September → September
- Oktober → October
- November → November
- Desember → December

### 3. Validasi dan Error Handling

#### Validasi yang Dilakukan:
- NIK Karyawan: Wajib, maksimal 50 karakter
- Nama Karyawan: Wajib, maksimal 255 karakter
- NIK KTP: Wajib, maksimal 20 karakter
- Unit: Wajib, maksimal 100 karakter
- Golongan: Opsional, maksimal 50 karakter
- Profesi: Wajib, maksimal 100 karakter
- Status Pegawai: Wajib, maksimal 50 karakter
- Tempat Lahir: Wajib, maksimal 100 karakter
- Tanggal Lahir: Wajib
- Jenis Kelamin: Wajib

#### Fitur Error Handling:
- Skip baris yang duplikat (NIK Karyawan sama)
- Skip baris yang error validasi
- Lanjutkan import untuk baris yang valid
- Tampilkan detail error per baris yang gagal
- Maksimal 10 error pertama ditampilkan di popup

### 4. Perubahan Database

- NIK KTP diperbesar dari 16 ke 20 karakter
- Kolom Golongan sekarang nullable (boleh kosong)

### 5. Template Download

Template yang didownload sekarang sesuai dengan format CSV Anda:

**Header:**
```
NIK Karyawan,Nama Karyawan,NIK KTP,Unit,Golongan,Profesi,Status Pegawai,Tempat Lahir,Tanggal Lahir,Umur,Jenis Kelamin
```

**Contoh Data:**
```
K001,John Doe,1234567890123456,IT Department,III/A,Software Developer,Tetap,Jakarta,01 Januari 1990,35,Laki-laki
K002,Jane Smith,1234567890123457,Human Resources,III/B,HR Manager,Tetap,Bandung,15 Mei 1988,37,Perempuan
```

## Cara Import Data

1. **Siapkan File CSV**
   - Gunakan format yang sama dengan file Database_Karyawan_2026-01-02.csv
   - Pastikan encoding UTF-8
   - Header harus persis sama (case-sensitive)

2. **Upload File**
   - Klik tombol "Import Excel"
   - Pilih file CSV/Excel Anda
   - Klik "Import"

3. **Hasil Import**
   - ✅ **Sukses**: Semua data berhasil diimport
   - ⚠️ **Warning**: Beberapa baris gagal, tapi sisanya berhasil
   - ❌ **Error**: Import gagal total

4. **Review Error (Jika Ada)**
   - Error akan ditampilkan per baris
   - Maksimal 10 error pertama ditampilkan
   - Perbaiki baris yang error dan import ulang

## Contoh Error yang Mungkin Terjadi

### 1. NIK Duplikat
```
Baris 15: NIK Karyawan K001 sudah ada dalam database
```
**Solusi**: Ubah NIK atau hapus baris tersebut

### 2. Format Tanggal Salah
```
Baris 20: Tanggal lahir tidak valid
```
**Solusi**: Gunakan format `DD Bulan YYYY` (contoh: `07 April 2000`)

### 3. Field Wajib Kosong
```
Baris 25: Nama Karyawan wajib diisi
```
**Solusi**: Isi field yang wajib

### 4. Panjang Data Melebihi Batas
```
Baris 30: NIK KTP maksimal 20 karakter
```
**Solusi**: Pastikan data tidak melebihi batas maksimal

## Tips Import

1. **Test dengan Data Kecil**
   - Coba import 10-20 baris dulu
   - Jika sukses, baru import sisanya

2. **Backup Data**
   - Export data yang ada sebelum import besar
   - Jaga-jaga jika ada masalah

3. **Cek Duplikat**
   - Data dengan NIK yang sama akan di-skip
   - Tidak perlu hapus data lama sebelum import

4. **Format Konsisten**
   - Pastikan semua tanggal menggunakan format yang sama
   - Gunakan format Indonesia yang didukung

5. **Encoding File**
   - Simpan CSV dengan encoding UTF-8
   - Di Excel: Save As → CSV UTF-8

## Testing

Database sudah direset dan berisi 10 data sample untuk testing.

Anda bisa langsung coba import file `Database_Karyawan_2026-01-02.csv` yang ada di folder `public`.

---

**Update**: 2 Januari 2026
