# 🚪 Logout Customer - Dokumentasi

## ✅ Yang Sudah Dibuat

### 1. Tombol Logout di Navbar (Desktop)
- **Lokasi**: Dropdown menu user (klik nama user)
- **Fitur**:
  - Dropdown menu dengan info user
  - Link ke Dashboard
  - Link ke Pesanan Saya
  - Link ke Histori Transaksi
  - Link ke Profile
  - **Tombol Logout** (warna merah)

### 2. Tombol Logout di Navbar (Mobile)
- **Lokasi**: Mobile menu (hamburger menu)
- **Fitur**:
  - Nama user ditampilkan
  - Menu navigasi lengkap
  - **Tombol Logout** di bagian bawah

### 3. Route Logout
```php
POST /logout
```

## 🎨 Tampilan Navbar

### Desktop View
```
[Logo] Home | Produk | Pesanan Saya | Histori | [Order] [Cart] [User ▼]
                                                                    |
                                                    Dropdown Menu:  |
                                                    - Dashboard     |
                                                    - Pesanan Saya  |
                                                    - Histori       |
                                                    - Profile       |
                                                    - Logout (red)  |
```

### Mobile View
```
[Logo]                                              [☰]
                                                     |
                                    Mobile Menu:     |
                                    - Home           |
                                    - Produk         |
                                    - Keranjang      |
                                    ---------------  |
                                    User Name        |
                                    - Dashboard      |
                                    - Pesanan Saya   |
                                    - Histori        |
                                    - Profile        |
                                    - Logout (red)   |
```

## 🔧 Fitur Logout

### Proses Logout:
1. User klik tombol "Logout"
2. Form POST ke `/logout`
3. Session di-invalidate
4. Token CSRF di-regenerate
5. Redirect ke homepage
6. Flash message: "Anda telah logout"

### Keamanan:
- ✅ CSRF Protection
- ✅ Session Invalidation
- ✅ Token Regeneration
- ✅ Redirect ke homepage

## 📍 Lokasi File

### Navbar Component
```
resources/views/components/navbar.blade.php
```

### Route Logout
```php
// routes/web.php
Route::middleware('auth')->group(function () {
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')
            ->with('success', 'Anda telah logout.');
    })->name('logout');
});
```

## 🎯 Cara Menggunakan

### Untuk Customer:

1. **Login** ke akun customer
2. Lihat **nama user** di navbar (pojok kanan)
3. **Klik nama user** untuk membuka dropdown
4. **Klik "Logout"** (tombol merah di bawah)
5. Anda akan di-redirect ke homepage

### Di Mobile:

1. **Login** ke akun customer
2. **Klik hamburger menu** (☰)
3. Scroll ke bawah
4. **Klik "Logout"** (tombol merah)
5. Anda akan di-redirect ke homepage

## 🎨 Styling

### Desktop Dropdown:
- Background: White
- Shadow: XL
- Border: Gray 200
- Hover: Gray 100
- Logout button: Red text, red hover background

### Mobile Menu:
- Background: White
- Shadow: LG
- Border bottom: Gray 100
- Logout button: Red text, red hover background

## ✅ Testing

### Test Logout:
1. Login sebagai customer
2. Klik logout
3. Verifikasi:
   - ✅ Redirect ke homepage
   - ✅ Flash message muncul
   - ✅ Tidak bisa akses halaman protected
   - ✅ Navbar berubah (tampil "Login" bukan nama user)

### Test Route:
```bash
php artisan route:list | Select-String -Pattern "logout"
```

Output:
```
POST logout ........................... logout
POST admin/logout ..................... filament.admin.auth.logout
```

## 🔒 Protected Routes

Setelah logout, customer tidak bisa akses:
- `/dashboard`
- `/profile`
- `/order/my-orders`
- `/transaksi/history`
- `/my-reviews`

Akan di-redirect ke login page.

## 📝 Catatan

1. **Logout berbeda dengan Admin**:
   - Customer logout: `/logout` → redirect ke homepage
   - Admin logout: `/admin/logout` → redirect ke admin login

2. **Session Management**:
   - Session di-clear sepenuhnya
   - Cart tetap tersimpan (session cart)
   - User harus login ulang

3. **Flash Message**:
   - Success message: "Anda telah logout"
   - Tampil di homepage setelah logout

## 🎉 Selesai!

Tombol logout customer sudah siap digunakan di navbar (desktop & mobile)!
