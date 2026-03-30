# 🔐 Cara Login Admin - PempekBunda 75

## ✅ Akun Admin yang Tersedia:

### Admin 1:
- **Email**: `admin@pempekbunda75.com`
- **Password**: `admin123` (default)

### Admin 2:
- **Email**: `superadmin@pempekbunda75.com`
- **Password**: `admin123` (default)

### Admin 3:
- **Email**: `bunda75@pempekbunda75.com`
- **Password**: `admin123` (default)

---

## 🎯 Cara Login Admin:

### Step 1: Akses URL Admin Login
Buka browser dan akses:
```
http://127.0.0.1:8000/admin/login
```

**PENTING**: Gunakan `/admin/login` bukan `/admin` saja!

### Step 2: Masukkan Kredensial
- **Email**: `admin@pempekbunda75.com`
- **Password**: `admin123`

### Step 3: Klik "Login"
Setelah login berhasil, kamu akan diarahkan ke dashboard admin.

---

## 🔄 Jika Masih Redirect ke User Sign In:

### Solusi 1: Clear Browser Cache
1. Tekan `Ctrl + Shift + Delete`
2. Pilih "Cookies and other site data"
3. Pilih "Cached images and files"
4. Klik "Clear data"
5. Restart browser
6. Akses lagi: `http://127.0.0.1:8000/admin/login`

### Solusi 2: Gunakan Incognito/Private Mode
1. Buka browser dalam mode Incognito (Ctrl + Shift + N di Chrome)
2. Akses: `http://127.0.0.1:8000/admin/login`
3. Login dengan akun admin

### Solusi 3: Clear Laravel Session
```bash
php artisan cache:clear
php artisan config:clear
php artisan session:clear
```

Lalu restart server:
```bash
php artisan serve
```

---

## 📋 URL yang Benar:

| URL | Fungsi | Untuk |
|-----|--------|-------|
| `http://127.0.0.1:8000` | Homepage | Customer |
| `http://127.0.0.1:8000/login` | Login Customer | Customer |
| `http://127.0.0.1:8000/register` | Register Customer | Customer |
| `http://127.0.0.1:8000/admin/login` | **Login Admin** | **Admin** |
| `http://127.0.0.1:8000/admin` | Dashboard Admin | Admin (setelah login) |

---

## 🎯 Testing Auto-Create Transaksi:

Setelah berhasil login admin:

1. **Buka Menu "Pesanan"** di sidebar
2. **Edit order** dengan status "paid" atau "processed"
3. **Ubah status** ke "Selesai" (completed)
4. **Klik "Save"**
5. **Cek notifikasi**: "Transaksi TRX-XXXX berhasil dibuat otomatis"
6. **Buka Menu "Laporan Transaksi"**
7. **Verifikasi**: Transaksi baru seharusnya ada ✅

---

## 🐛 Troubleshooting:

### Masalah: "Email tidak terdaftar"
**Solusi**: Pastikan menggunakan email admin yang benar:
- `admin@pempekbunda75.com`
- `superadmin@pempekbunda75.com`
- `bunda75@pempekbunda75.com`

### Masalah: "Password salah"
**Solusi**: Password default adalah `admin123`. Jika sudah diubah, gunakan password yang baru.

### Masalah: "Akun ini tidak memiliki akses admin"
**Solusi**: Pastikan menggunakan akun admin, bukan akun customer.

### Masalah: Tetap redirect ke user sign in
**Solusi**: 
1. Clear browser cache
2. Gunakan Incognito mode
3. Akses langsung: `http://127.0.0.1:8000/admin/login`

---

## ✅ Checklist Login Admin:

- [ ] Server Laravel sudah jalan (`php artisan serve`)
- [ ] Akses URL: `http://127.0.0.1:8000/admin/login`
- [ ] Gunakan email admin: `admin@pempekbunda75.com`
- [ ] Gunakan password: `admin123`
- [ ] Klik "Login"
- [ ] Berhasil masuk ke dashboard admin ✅

---

## 💡 Tips:

1. **Bookmark URL admin login** untuk akses cepat
2. **Gunakan Incognito mode** untuk testing bersih
3. **Clear cache** jika ada masalah redirect
4. **Pastikan MySQL berjalan** sebelum akses admin

---

Selamat menggunakan admin panel! 🎉

