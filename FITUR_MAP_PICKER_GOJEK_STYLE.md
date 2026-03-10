# 🗺️ Fitur Map Picker GoJek Style - Pempek Bunda 75

## 📋 Deskripsi
Sistem pemilihan lokasi interaktif seperti aplikasi GoJek/Grab untuk halaman checkout. User dapat memilih lokasi pengiriman dengan cara drag map atau klik langsung pada peta.

---

## ✨ Fitur Utama

### 1. **Modal Map Interaktif**
- Modal full-screen dengan Google Maps
- Pin merah di tengah layar (GoJek style)
- Animasi bounce pada pin
- Drag map untuk memilih lokasi
- Klik langsung pada peta untuk pin lokasi

### 2. **Reverse Geocoding Otomatis**
- Alamat lengkap ter-generate otomatis saat user geser peta
- Update real-time koordinat latitude & longitude
- Tampilan alamat yang user-friendly

### 3. **Validasi Ketat**
- User WAJIB memilih lokasi di peta jika pilih metode "Diantar (GoSend)"
- Tombol "Lanjut ke Pembayaran" disabled jika:
  - Nomor WhatsApp kosong
  - Metode delivery = "Diantar" tapi belum pilih lokasi di peta
  - Koordinat latitude/longitude masih null

### 4. **UI/UX GoJek Style**
- Design modern dan clean
- Warna hijau (#6B8E23) untuk branding
- Pin merah dengan animasi bounce
- Loading state saat peta dimuat
- Responsive untuk mobile & desktop

---

## 🚀 Cara Menggunakan

### Untuk User (Customer):

1. **Pilih Metode Pengiriman "Diantar (GoSend)"**
   - Klik radio button "Diantar (GoSend)"

2. **Klik Tombol Pin Merah**
   - Klik tombol pin merah di pojok kanan field alamat
   - Modal peta akan terbuka

3. **Pilih Lokasi di Peta**
   - **Cara 1:** Drag/geser peta ke lokasi yang diinginkan
   - **Cara 2:** Klik langsung pada peta
   - Pin merah akan selalu di tengah layar

4. **Lihat Alamat Otomatis**
   - Alamat lengkap akan muncul di bawah peta
   - Koordinat latitude & longitude terisi otomatis

5. **Konfirmasi Lokasi**
   - Klik tombol "Pilih Lokasi Ini"
   - Alamat dan koordinat akan tersimpan
   - Modal akan tertutup

6. **Lanjut Checkout**
   - Tombol "Lanjut ke Pembayaran" akan aktif
   - Koordinat tersimpan di database saat order dibuat

---

## 🔧 Setup untuk Developer

### 1. **Dapatkan Google Maps API Key**

#### Langkah-langkah:
1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang ada
3. Enable API berikut:
   - **Maps JavaScript API**
   - **Geocoding API**
4. Buat credentials (API Key)
5. Restrict API key untuk keamanan:
   - Application restrictions: HTTP referrers
   - Tambahkan domain website Anda
   - API restrictions: Pilih Maps JavaScript API & Geocoding API

### 2. **Tambahkan API Key ke .env**

```env
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

### 3. **Struktur Data yang Tersimpan**

Saat order dibuat, data berikut akan dikirim ke server:

```javascript
{
  customer: {
    name: "John Doe",
    email: "john@example.com",
    phone: "081234567890",
    address: "Jl. Sudirman No. 123, Palembang, Sumatera Selatan"
  },
  location: {
    latitude: -2.9760735,
    longitude: 104.7754307
  },
  delivery: {
    method: "delivery" // atau "pickup"
  },
  // ... data lainnya
}
```

### 4. **Simpan ke Database**

Pastikan tabel `orders` memiliki kolom:
- `latitude` (decimal, nullable)
- `longitude` (decimal, nullable)
- `address` (text)

Jika belum ada, buat migration:

```bash
php artisan make:migration add_location_to_orders_table
```

```php
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->decimal('latitude', 10, 7)->nullable()->after('address');
        $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
    });
}
```

Jalankan migration:
```bash
php artisan migrate
```

---

## 📱 Fitur Responsif

### Desktop (> 768px)
- Modal lebar penuh dengan max-width 4xl
- Peta tinggi 500px
- Layout 2 kolom untuk koordinat

### Mobile (< 768px)
- Modal full screen
- Peta tinggi 400px
- Layout 1 kolom untuk koordinat
- Touch-friendly controls

---

## 🎨 Customization

### Ubah Default Location
Edit di `initializeMap()`:

```javascript
// Default location: Palembang
const defaultLat = -2.9760735;  // Ganti dengan latitude kota Anda
const defaultLng = 104.7754307; // Ganti dengan longitude kota Anda
```

### Ubah Zoom Level
Edit di `initializeMap()`:

```javascript
zoom: 15, // Ubah nilai 15 ke zoom level yang diinginkan (1-20)
```

### Ubah Warna Pin
Edit CSS di `checkout.blade.php`:

```css
.fas.fa-map-marker-alt {
  color: #ef4444; /* Merah - ganti dengan warna lain */
}
```

---

## 🔒 Keamanan

### 1. **API Key Restriction**
- Restrict API key hanya untuk domain Anda
- Jangan commit API key ke Git
- Gunakan environment variable

### 2. **Validasi Server-Side**
Tambahkan validasi di controller:

```php
$request->validate([
    'latitude' => 'required|numeric|between:-90,90',
    'longitude' => 'required|numeric|between:-180,180',
    'address' => 'required|string|max:500',
]);
```

### 3. **Rate Limiting**
Google Maps API memiliki quota gratis:
- 28,000 map loads per bulan
- 40,000 geocoding requests per bulan

Jika traffic tinggi, pertimbangkan:
- Enable billing di Google Cloud
- Implement caching untuk geocoding results

---

## 🐛 Troubleshooting

### Problem: Peta tidak muncul
**Solusi:**
1. Cek API key sudah benar di `.env`
2. Cek API sudah di-enable di Google Cloud Console
3. Cek console browser untuk error messages
4. Pastikan domain sudah di-whitelist di API restrictions

### Problem: Reverse geocoding tidak jalan
**Solusi:**
1. Enable Geocoding API di Google Cloud Console
2. Cek quota API belum habis
3. Cek koneksi internet

### Problem: Modal tidak terbuka
**Solusi:**
1. Cek Alpine.js sudah loaded
2. Cek console browser untuk JavaScript errors
3. Pastikan `x-data="checkoutSystem()"` ada di body tag

---

## 📊 Testing

### Test Case 1: Pilih Lokasi dengan Drag
1. Buka halaman checkout
2. Pilih "Diantar (GoSend)"
3. Klik tombol pin
4. Drag peta ke lokasi berbeda
5. Verifikasi alamat berubah otomatis
6. Klik "Pilih Lokasi Ini"
7. Verifikasi alamat tersimpan di form

### Test Case 2: Pilih Lokasi dengan Klik
1. Buka modal peta
2. Klik langsung pada peta
3. Verifikasi peta bergerak ke titik yang diklik
4. Verifikasi alamat ter-update
5. Konfirmasi lokasi

### Test Case 3: Validasi Checkout
1. Pilih "Diantar (GoSend)"
2. Jangan pilih lokasi di peta
3. Verifikasi tombol "Lanjut ke Pembayaran" disabled
4. Pilih lokasi di peta
5. Verifikasi tombol menjadi enabled

---

## 📝 Changelog

### Version 1.0.0 (2026-03-04)
- ✅ Implementasi modal map picker GoJek style
- ✅ Reverse geocoding otomatis
- ✅ Validasi koordinat wajib untuk delivery
- ✅ Responsive design untuk mobile & desktop
- ✅ Animasi bounce pada pin
- ✅ Loading state saat peta dimuat

---

## 🎯 Future Improvements

1. **Autocomplete Search**
   - Tambahkan search box untuk cari alamat
   - Gunakan Google Places Autocomplete API

2. **Current Location Button**
   - Tombol "Gunakan Lokasi Saya"
   - Gunakan Geolocation API browser

3. **Radius Delivery**
   - Validasi jarak dari toko
   - Hitung ongkir berdasarkan jarak

4. **Save Favorite Locations**
   - User bisa simpan alamat favorit
   - Quick select dari alamat tersimpan

---

## 📞 Support

Jika ada pertanyaan atau issue:
1. Cek dokumentasi Google Maps API
2. Cek console browser untuk error messages
3. Review kode di `resources/views/order/checkout.blade.php`

---

**Dibuat dengan ❤️ untuk Pempek Bunda 75**
