# 📘 CONTOH PENGGUNAAN VARIABEL $appData

## Penjelasan
Variabel `$appData` tersedia secara **GLOBAL** di semua file Blade karena sudah di-share melalui `AppServiceProvider`.

---

## 🎯 1. DI FILE LOGIN (login.blade.php)

### Title & Favicon
```blade
<head>
    <!-- Dynamic Title -->
    <title>Login - {{ $appData->nama_app ?? 'SIM RS' }}</title>
    
    <!-- Dynamic Favicon -->
    @if($appData && $appData->favicon)
        <link rel="shortcut icon" href="{{ asset('storage/' . $appData->favicon) }}" />
    @else
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    @endif
</head>
```

### Logo & Nama Aplikasi
```blade
<div class="d-flex flex-center flex-lg-start flex-column">
    <!-- Dynamic Logo -->
    <a href="#" class="mb-7">
        @if($appData && $appData->logo)
            <img alt="Logo" src="{{ asset('storage/' . $appData->logo) }}" class="h-60px h-lg-75px" />
        @else
            <img alt="Logo" src="{{ asset('assets/media/logos/default.svg') }}" class="h-60px h-lg-75px" />
        @endif
    </a>
    
    <!-- Dynamic App Name -->
    <h2 class="text-white fw-normal m-0">
        {{ $appData->nama_app ?? 'SIM RS' }}
    </h2>
    
    <!-- Dynamic Institution Name -->
    <p class="text-white fs-5 fw-semibold opacity-75 mt-2">
        {{ $appData->nama_instansi ?? 'Sistem Informasi Manajemen Rumah Sakit' }}
    </p>
</div>
```

---

## 🎯 2. DI LAYOUT MASTER (app.blade.php)

### Head Section
```blade
<head>
    <!-- Dynamic Title -->
    <title>@yield('title', $appData->nama_app ?? 'SIM RS')</title>
    
    <!-- Dynamic Meta Description -->
    <meta name="description" content="{{ $appData->nama_instansi ?? 'Sistem Informasi Manajemen Rumah Sakit' }}" />
    
    <!-- Dynamic Favicon -->
    @if($appData && $appData->favicon)
        <link rel="shortcut icon" href="{{ asset('storage/' . $appData->favicon) }}" />
    @else
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    @endif
</head>
```

---

## 🎯 3. DI SIDEBAR (_toolbar.blade.php)

### Logo Aplikasi di Sidebar
```blade
<!--begin::Symbol-->
@if($appData && $appData->logo)
    <div class="symbol symbol-50px">
        <img src="{{ asset('storage/' . $appData->logo) }}" alt="{{ $appData->nama_app }}" />
    </div>
@else
    <div class="symbol symbol-50px">
        <span class="symbol-label fs-2 fw-bold text-primary">
            {{ substr($appData->nama_app ?? 'SIM', 0, 3) }}
        </span>
    </div>
@endif
<!--end::Symbol-->
```

### User Info Dinamis
```blade
<div class="flex-grow-1 me-2">
    <!-- User Name from Auth -->
    <a href="#" class="text-white text-hover-primary fs-6 fw-bold">
        {{ Auth::user()->name ?? 'Admin' }}
    </a>
    
    <!-- User Role -->
    <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">
        {{ ucfirst(Auth::user()->role ?? 'User') }}
    </span>
    
    <!-- Online Status -->
    <div class="d-flex align-items-center text-success fs-9">
        <span class="bullet bullet-dot bg-success me-1"></span>online
    </div>
</div>
```

---

## 🎯 4. DI HEADER (header.blade.php)

### Logo di Header
```blade
<div class="header-brand">
    <!--begin::Logo-->
    <a href="{{ url('/') }}">
        @if($appData && $appData->logo)
            <img alt="{{ $appData->nama_app }}" 
                 src="{{ asset('storage/' . $appData->logo) }}" 
                 class="h-25px h-lg-25px"/>
        @else
            <img alt="Logo" 
                 src="{{ asset('assets/media/logos/default-dark.svg') }}" 
                 class="h-25px h-lg-25px"/>
        @endif
    </a>
    <!--end::Logo-->
</div>
```

---

## 🎯 5. DI FOOTER (footer.blade.php)

### Copyright Text
```blade
<div class="text-gray-900 order-2 order-md-1">
    <!-- Dynamic Copyright -->
    <span class="text-muted fw-semibold me-1">
        {{ $appData->copyright_text ?? '© 2026 SIM RS. All Rights Reserved.' }}
    </span>
</div>
```

### Informasi Kontak
```blade
<div class="footer-info">
    <!-- Alamat -->
    @if($appData && $appData->alamat)
        <p class="mb-2">
            <i class="ki-duotone ki-geolocation fs-2 me-2"></i>
            {{ $appData->alamat }}
        </p>
    @endif
    
    <!-- No Telepon -->
    @if($appData && $appData->no_telp)
        <p class="mb-2">
            <i class="ki-duotone ki-phone fs-2 me-2"></i>
            {{ $appData->no_telp }}
        </p>
    @endif
</div>
```

---

## 🎯 6. DI HALAMAN BIASA (Contoh: dashboard.blade.php)

### Breadcrumb
```blade
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">
            {{ $appData->nama_app ?? 'Home' }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Dashboard</li>
</ul>
```

### Welcome Message
```blade
<div class="card">
    <div class="card-body">
        <h2>Selamat Datang di {{ $appData->nama_app ?? 'SIM RS' }}</h2>
        <p>{{ $appData->nama_instansi ?? 'Sistem Informasi Manajemen' }}</p>
    </div>
</div>
```

---

## 🎯 7. DI EMAIL TEMPLATE

### Email Header
```blade
<table>
    <tr>
        <td>
            @if($appData && $appData->logo)
                <img src="{{ asset('storage/' . $appData->logo) }}" 
                     alt="{{ $appData->nama_app }}" 
                     style="height: 50px;">
            @endif
        </td>
    </tr>
    <tr>
        <td>
            <h2>{{ $appData->nama_app ?? 'SIM RS' }}</h2>
        </td>
    </tr>
</table>
```

### Email Footer
```blade
<footer>
    <p>{{ $appData->copyright_text }}</p>
    @if($appData && $appData->alamat)
        <p>{{ $appData->alamat }}</p>
    @endif
    @if($appData && $appData->no_telp)
        <p>Tel: {{ $appData->no_telp }}</p>
    @endif
</footer>
```

---

## 🎯 8. KONDISIONAL RENDERING

### Cek Jika Data Tersedia
```blade
@if($appData && $appData->logo)
    <!-- Tampilkan logo -->
    <img src="{{ asset('storage/' . $appData->logo) }}" />
@else
    <!-- Fallback: Tampilkan default -->
    <img src="{{ asset('assets/media/logos/default.svg') }}" />
@endif
```

### Null Coalescing Operator
```blade
<!-- Short syntax untuk default value -->
{{ $appData->nama_app ?? 'Default Name' }}

<!-- Atau lebih panjang -->
{{ $appData ? $appData->nama_app : 'Default Name' }}

<!-- Dengan isset -->
{{ isset($appData->nama_app) ? $appData->nama_app : 'Default Name' }}
```

---

## 🎯 9. DALAM JAVASCRIPT

### Pass Data ke JS
```blade
<script>
    const appData = {
        nama_app: "{{ $appData->nama_app ?? 'SIM RS' }}",
        nama_instansi: "{{ $appData->nama_instansi ?? '' }}",
        copyright: "{{ $appData->copyright_text ?? '' }}"
    };
    
    // Gunakan di JS
    document.title = appData.nama_app + ' - Dashboard';
    console.log('Welcome to ' + appData.nama_app);
</script>
```

### Dynamic Alert
```blade
<script>
    Swal.fire({
        title: 'Selamat Datang!',
        text: 'Anda login ke {{ $appData->nama_app ?? "Sistem" }}',
        icon: 'success'
    });
</script>
```

---

## 🎯 10. DALAM COMPONENT

### Component Props
```blade
<!-- parent.blade.php -->
<x-header-component 
    :appName="$appData->nama_app ?? 'SIM RS'" 
    :logo="$appData->logo ?? null" 
/>
```

### Component Usage
```blade
<!-- header-component.blade.php -->
<div>
    @if($logo)
        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $appName }}">
    @endif
    <h1>{{ $appName }}</h1>
</div>
```

---

## 📝 BEST PRACTICES

### 1. Selalu Gunakan Null Coalescing
```blade
<!-- ✅ GOOD -->
{{ $appData->nama_app ?? 'Default' }}

<!-- ❌ BAD (bisa error jika $appData null) -->
{{ $appData->nama_app }}
```

### 2. Cek Eksistensi Untuk File
```blade
<!-- ✅ GOOD -->
@if($appData && $appData->logo)
    <img src="{{ asset('storage/' . $appData->logo) }}" />
@endif

<!-- ❌ BAD -->
<img src="{{ asset('storage/' . $appData->logo) }}" />
```

### 3. Gunakan asset() Helper
```blade
<!-- ✅ GOOD -->
<img src="{{ asset('storage/' . $appData->logo) }}" />

<!-- ❌ BAD -->
<img src="/storage/{{ $appData->logo }}" />
```

### 4. Escape HTML untuk Security
```blade
<!-- Untuk text biasa (auto-escaped) -->
{{ $appData->nama_app }}

<!-- Jika perlu HTML (hati-hati!) -->
{!! $appData->copyright_text !!}
```

---

## 🔍 DEBUGGING

### Cek Isi $appData
```blade
<!-- Dump and Die -->
@dd($appData)

<!-- Dump -->
@dump($appData)

<!-- Manual -->
<pre>
    {{ print_r($appData->toArray(), true) }}
</pre>
```

### Cek di Browser Console
```blade
<script>
    console.log(@json($appData));
</script>
```

---

## ⚠️ CATATAN PENTING

1. **Cache**: Data di-cache 1 jam, clear cache jika tidak update
2. **Storage Link**: Pastikan `php artisan storage:link` sudah dijalankan
3. **Permission**: Folder `storage/app/public` harus writable
4. **Null Check**: Selalu cek null untuk data optional (logo, favicon, dll)

---

## 💡 TIPS TAMBAHAN

### Custom Helper Function (Optional)
Jika ingin lebih simple, bisa buat helper:

**File:** `app/Helpers/AppHelper.php`
```php
<?php
if (!function_exists('app_name')) {
    function app_name() {
        return app(\App\Models\DataApp::class)->getInstance()->nama_app ?? 'SIM RS';
    }
}

if (!function_exists('app_logo')) {
    function app_logo() {
        $logo = app(\App\Models\DataApp::class)->getInstance()->logo;
        return $logo ? asset('storage/' . $logo) : asset('assets/media/logos/default.svg');
    }
}
```

**Gunakan di Blade:**
```blade
<!-- Nama App -->
{{ app_name() }}

<!-- Logo URL -->
<img src="{{ app_logo() }}" />
```

---

**Selamat Menggunakan! 🎉**
