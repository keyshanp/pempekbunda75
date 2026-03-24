# 🔧 Fix: PHP Not Found - Cara Running Laravel

## ❌ Error yang Terjadi:
```
php : The term 'php' is not recognized as the name of a cmdlet
```

## ✅ Solusi Sementara (Quick Fix):

### Gunakan Path Lengkap PHP:
```bash
& "C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64\php.exe" artisan serve
```

Server akan jalan di: http://127.0.0.1:8000

---

## ✅ Solusi Permanen (Recommended):

### Option 1: Tambah PHP ke PATH (Manual)

1. **Copy Path PHP:**
   ```
   C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64
   ```

2. **Buka System Environment Variables:**
   - Tekan **Windows + R**
   - Ketik: `sysdm.cpl`
   - Tekan **Enter**

3. **Edit PATH:**
   - Klik tab **Advanced**
   - Klik **Environment Variables**
   - Di **System variables**, cari **Path**
   - Klik **Edit**
   - Klik **New**
   - Paste: `C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64`
   - Klik **OK** semua

4. **Restart Terminal:**
   - Tutup PowerShell/CMD
   - Buka lagi
   - Test: `php -v`

5. **Sekarang bisa langsung:**
   ```bash
   php artisan serve
   ```

---

### Option 2: Gunakan Laragon Terminal

1. **Buka Laragon**
2. **Klik kanan** di Laragon
3. **Terminal** → **PowerShell** atau **CMD**
4. Terminal akan otomatis load PHP
5. Jalankan:
   ```bash
   cd "C:\Users\keand\OneDrive\Desktop\Sekolah\Kelas 12\pempekbunda75"
   php artisan serve
   ```

---

### Option 3: Buat Batch File (Paling Mudah)

Saya sudah buatkan file `run-server.bat` untuk kamu.

**Cara pakai:**
1. Double-click file `run-server.bat`
2. Server otomatis jalan
3. Buka browser: http://127.0.0.1:8000

---

## 🚀 Cara Running Server (Pilih Salah Satu):

### 1. Via Batch File (Termudah)
```bash
# Double-click file ini:
run-server.bat
```

### 2. Via PowerShell (Path Lengkap)
```bash
& "C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64\php.exe" artisan serve
```

### 3. Via Laragon Terminal
```bash
# Buka Laragon → Terminal
php artisan serve
```

### 4. Via CMD (Setelah Add to PATH)
```bash
php artisan serve
```

---

## 📋 Cek PHP Terinstall:

```bash
# Cek versi PHP
& "C:\laragon\bin\php\php-8.3.13-nts-Win32-vs16-x64\php.exe" -v

# Output:
# PHP 8.3.13 (cli) (built: Oct 22 2024 15:49:34) (NTS Visual C++ 2019 x64)
```

---

## 🔍 Troubleshooting:

### Error: "Address already in use"
**Solusi:**
```bash
# Gunakan port lain
php artisan serve --port=8001
```

### Error: "No application encryption key"
**Solusi:**
```bash
php artisan key:generate
```

### Error: "Database connection failed"
**Solusi:**
1. Buka Laragon
2. Start MySQL
3. Cek `.env` file (DB_HOST, DB_DATABASE, dll)

### Error: "Class not found"
**Solusi:**
```bash
composer dump-autoload
```

---

## 🎯 Quick Commands:

```bash
# Start server
php artisan serve

# Start server di port lain
php artisan serve --port=8001

# Start server di host tertentu
php artisan serve --host=0.0.0.0 --port=8000

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Migrate database
php artisan migrate

# Seed database
php artisan db:seed
```

---

## 💡 Tips:

1. **Gunakan Laragon Terminal** - PHP sudah auto-load
2. **Tambah PHP ke PATH** - Bisa pakai `php` di mana saja
3. **Gunakan Batch File** - Double-click langsung jalan
4. **Jangan tutup terminal** - Server akan mati

---

## ✅ Verifikasi Server Jalan:

1. **Cek di terminal:**
   ```
   Starting Laravel development server: http://127.0.0.1:8000
   ```

2. **Buka browser:**
   ```
   http://127.0.0.1:8000
   ```

3. **Cek admin:**
   ```
   http://127.0.0.1:8000/admin
   ```

---

## 🔗 Useful Links:

- **Homepage**: http://127.0.0.1:8000
- **Admin Panel**: http://127.0.0.1:8000/admin
- **Admin Login**: http://127.0.0.1:8000/admin/login
- **Customer Login**: http://127.0.0.1:8000/login
- **Register**: http://127.0.0.1:8000/register

---

**Server sudah jalan!** 🎉

Sekarang kamu bisa akses website di browser: http://127.0.0.1:8000
