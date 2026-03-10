# 🔐 Test Login Admin Panel

## ✅ User Admin Sudah Dibuat

**Email:** admin@pempekbunda75.com  
**Password:** Admin123!  
**Role:** Administrator (is_admin = true)

## 🚀 Cara Test Login

### 1. Start Development Server
```bash
php artisan serve
```

### 2. Akses Admin Panel
Buka browser dan akses:
```
http://localhost:8000/admin
```

### 3. Login dengan Kredensial
- **Email:** admin@pempekbunda75.com
- **Password:** Admin123!

### 4. Setelah Login Berhasil
Anda akan diarahkan ke Dashboard Admin dengan fitur:
- Dashboard dengan statistik
- Manajemen Produk
- Manajemen Pesanan
- Manajemen Transaksi
- Manajemen Feedback
- Widget Transaksi Terbaru

## 🔧 Troubleshooting

### Jika Login Gagal:

1. **Clear Cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

2. **Cek User di Database:**
```bash
php artisan tinker
```
Lalu ketik:
```php
\App\Models\User::where('email', 'admin@pempekbunda75.com')->first();
```

3. **Reset Password Admin:**
```bash
php artisan tinker
```
Lalu ketik:
```php
$user = \App\Models\User::where('email', 'admin@pempekbunda75.com')->first();
$user->password = \Hash::make('Admin123!');
$user->is_admin = true;
$user->save();
echo "Password reset berhasil!";
exit;
```

4. **Atau Gunakan Route Helper:**
Akses:
```
http://localhost:8000/create-admin
```

## 📝 User Admin Lainnya

Jika perlu, ada user admin tambahan:

1. **Super Admin**
   - Email: superadmin@pempekbunda75.com
   - Password: SuperAdmin123!

2. **Pempek Bunda**
   - Email: bunda75@pempekbunda75.com
   - Password: Pempek123!

## ✅ Verifikasi Login Berhasil

Setelah login berhasil, Anda akan melihat:
- ✅ Sidebar dengan menu navigasi
- ✅ Topbar dengan greeting dan user info
- ✅ Dashboard dengan widget statistik
- ✅ Widget Transaksi Terbaru
- ✅ Akses ke semua resource (Produk, Pesanan, Transaksi, Feedback)

## 🎯 Fitur Admin Panel

### Dashboard
- Statistik overview (total produk, pesanan, transaksi)
- Chart produk
- Widget aktivitas terbaru
- Widget transaksi terbaru
- Widget stok rendah

### Manajemen Produk
- CRUD produk
- Upload gambar
- Manajemen stok
- Kategori produk

### Manajemen Pesanan
- Lihat semua pesanan
- Update status pesanan
- Detail pesanan dengan items
- Filter dan search

### Manajemen Transaksi
- Lihat semua transaksi
- Konfirmasi pembayaran
- Lihat bukti pembayaran
- Filter berdasarkan metode dan status

### Manajemen Feedback
- Lihat semua review pelanggan
- Rating dan tags
- Analytics feedback
- Detail feedback per order

## 🔒 Keamanan

- ✅ Middleware authentication
- ✅ Middleware admin check (is_admin = true)
- ✅ Session management
- ✅ CSRF protection
- ✅ Password hashing

## 📞 Support

Jika masih ada masalah, cek:
1. Log error: `storage/logs/laravel.log`
2. Database connection: `php artisan db:show`
3. Route list: `php artisan route:list | Select-String -Pattern "admin"`
