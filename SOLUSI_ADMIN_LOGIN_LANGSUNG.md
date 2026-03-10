# 🔧 Solusi: Admin Login Langsung ke /admin

## 🎯 Masalah:
Ketika akses `http://127.0.0.1:8000/admin`, malah redirect ke user sign in dulu.

## ✅ Solusi:

### Cara 1: Akses Langsung ke Admin Login
Gunakan URL ini untuk login admin:
```
http://127.0.0.1:8000/admin/login
```

Ini akan langsung ke halaman login admin tanpa redirect ke user sign in.

### Cara 2: Bookmark URL Admin Login
Simpan URL ini sebagai bookmark di browser:
```
http://127.0.0.1:8000/admin/login
```

### Cara 3: Clear Browser Cache & Session
Kadang browser menyimpan redirect lama. Coba:
1. Clear browser cache (Ctrl + Shift + Delete)
2. Clear cookies untuk localhost
3. Restart browser
4. Akses: `http://127.0.0.1:8000/admin/login`

## 📋 Testing:

1. **Buka browser** (gunakan Incognito/Private mode untuk testing bersih)
2. **Akses**: `http://127.0.0.1:8000/admin/login`
3. **Login** dengan akun admin
4. **Seharusnya langsung masuk** ke dashboard admin

## 🔍 Cek Akun Admin:

Pastikan kamu punya akun admin di database:

```sql
SELECT * FROM users WHERE is_admin = 1;
```

Jika belum ada, buat dengan:

```bash
php artisan tinker
```

```php
$user = new \App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@pempekbunda75.com';
$user->password = bcrypt('admin123');
$user->is_admin = true;
$user->save();
```

## ✅ URL yang Benar:

| URL | Fungsi |
|-----|--------|
| `http://127.0.0.1:8000` | Homepage (customer) |
| `http://127.0.0.1:8000/login` | Login customer |
| `http://127.0.0.1:8000/admin` | Dashboard admin (perlu login dulu) |
| `http://127.0.0.1:8000/admin/login` | **Login admin (gunakan ini!)** |

## 🎯 Kesimpulan:

Gunakan URL `http://127.0.0.1:8000/admin/login` untuk login admin langsung tanpa redirect ke user sign in.
