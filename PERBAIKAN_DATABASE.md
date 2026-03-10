# 🔧 Perbaikan Masalah Loading Laravel

## ❌ Masalah
Laravel terus loading dan tidak muncul tampilan karena **MySQL database tidak berjalan**.

Error: `SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it`

## ✅ Solusi

### Opsi 1: Start MySQL Server

#### Jika menggunakan XAMPP:
1. Buka XAMPP Control Panel
2. Klik tombol "Start" pada MySQL
3. Tunggu hingga status berubah menjadi hijau
4. Refresh browser Laravel Anda

#### Jika menggunakan WAMP:
1. Buka WAMP Server
2. Klik icon WAMP di system tray
3. Pastikan MySQL berjalan (hijau)
4. Refresh browser

#### Jika menggunakan Laragon:
1. Buka Laragon
2. Klik "Start All"
3. Tunggu hingga MySQL berjalan
4. Refresh browser

### Opsi 2: Gunakan SQLite (Alternatif Cepat)

Jika MySQL bermasalah, gunakan SQLite sebagai database sementara:

1. Edit file `.env`:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=pempekbunda75
# DB_USERNAME=root
# DB_PASSWORD=
```

2. Buat file database SQLite:
```bash
touch database/database.sqlite
```

3. Jalankan migrasi:
```bash
php artisan migrate:fresh --seed
```

4. Clear cache:
```bash
php artisan config:clear
php artisan cache:clear
```

### Opsi 3: Cek Port MySQL

Jika MySQL berjalan tapi masih error, cek port:

1. Buka Command Prompt/PowerShell
2. Jalankan:
```bash
netstat -ano | findstr :3306
```

3. Jika port 3306 tidak ada, MySQL tidak berjalan
4. Jika port berbeda, update `.env`:
```env
DB_PORT=3307  # atau port yang sesuai
```

## 🧪 Test Koneksi Database

Setelah MySQL berjalan, test koneksi:

```bash
php artisan tinker
```

Lalu ketik:
```php
DB::connection()->getPdo();
```

Jika berhasil, akan muncul objek PDO.

## 🚀 Langkah Setelah Database Berjalan

1. Clear semua cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

2. Restart development server:
```bash
php artisan serve
```

3. Buka browser: `http://localhost:8000`

## 📝 Catatan Penting

- Pastikan MySQL/MariaDB service berjalan sebelum menjalankan Laravel
- Jika menggunakan XAMPP, pastikan Apache dan MySQL keduanya berjalan
- Database `pempekbunda75` harus sudah dibuat di phpMyAdmin
- Jika database belum ada, buat dulu:
  1. Buka phpMyAdmin (http://localhost/phpmyadmin)
  2. Klik "New" untuk membuat database baru
  3. Nama database: `pempekbunda75`
  4. Collation: `utf8mb4_unicode_ci`
  5. Klik "Create"

## 🔍 Troubleshooting Lanjutan

### Error: "Access denied for user 'root'@'localhost'"
Update `.env`:
```env
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### Error: "Unknown database 'pempekbunda75'"
Buat database dulu di phpMyAdmin atau via command:
```bash
mysql -u root -p
CREATE DATABASE pempekbunda75;
exit;
```

### Error: "Connection refused"
1. Cek apakah MySQL service berjalan
2. Cek firewall tidak memblokir port 3306
3. Restart MySQL service

## ✅ Verifikasi

Setelah perbaikan, coba akses:
- Homepage: `http://localhost:8000`
- Admin: `http://localhost:8000/admin`
- Test System: `http://localhost:8000/test-system`

Jika masih loading, cek log error:
```bash
tail -f storage/logs/laravel.log
```
