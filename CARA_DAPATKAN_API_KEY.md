# 🗺️ Cara Mendapatkan Google Maps API Key

## Langkah-langkah:

### 1. Buka Google Cloud Console
- Kunjungi: https://console.cloud.google.com/
- Login dengan akun Google Anda

### 2. Buat Project Baru (jika belum punya)
- Klik dropdown project di bagian atas
- Klik "NEW PROJECT"
- Beri nama: "PempekBunda 75"
- Klik "CREATE"

### 3. Enable APIs yang Diperlukan
- Di menu sebelah kiri, pilih "APIs & Services" > "Library"
- Cari dan enable API berikut:
  - ✅ **Maps JavaScript API** (untuk menampilkan peta)
  - ✅ **Geocoding API** (untuk reverse geocoding alamat)
  - ✅ **Places API** (opsional, untuk autocomplete)

### 4. Buat API Key
- Di menu sebelah kiri, pilih "APIs & Services" > "Credentials"
- Klik "CREATE CREDENTIALS" > "API key"
- Copy API key yang muncul (contoh: `AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX`)

### 5. Restrict API Key (Penting untuk Keamanan!)
- Klik API key yang baru dibuat
- Di bagian "Application restrictions":
  - Pilih "HTTP referrers (web sites)"
  - Tambahkan domain Anda:
    - `http://localhost/*` (untuk development)
    - `https://yourdomain.com/*` (untuk production)
- Di bagian "API restrictions":
  - Pilih "Restrict key"
  - Centang:
    - Maps JavaScript API
    - Geocoding API
    - Places API
- Klik "SAVE"

### 6. Tambahkan ke File .env
```env
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

### 7. Clear Cache Laravel
```bash
php artisan config:clear
php artisan cache:clear
```

### 8. Refresh Browser
- Tekan `Ctrl + F5` untuk hard refresh
- Peta seharusnya sudah muncul!

---

## ⚠️ CATATAN PENTING:

### Billing Account
Google Maps API memerlukan billing account aktif, TAPI:
- Google memberikan **$200 kredit gratis per bulan**
- Untuk aplikasi kecil-menengah, ini lebih dari cukup
- Anda tidak akan dicharge kecuali melebihi $200/bulan

### Quota Gratis per Bulan:
- Maps JavaScript API: 28,000 loads gratis
- Geocoding API: 40,000 requests gratis
- Untuk toko pempek, ini sangat cukup!

### Jika Tidak Ingin Pakai Google Maps:
Alternatif gratis:
1. **Leaflet + OpenStreetMap** (100% gratis, tidak perlu API key)
2. **Mapbox** (50,000 loads gratis per bulan)

---

## 🐛 Troubleshooting:

### Peta masih loading terus?
1. Cek apakah API key sudah benar di `.env`
2. Jalankan: `php artisan config:clear`
3. Hard refresh browser: `Ctrl + F5`
4. Cek console browser (F12) untuk error

### Error "This page can't load Google Maps correctly"?
- API key salah atau belum di-enable
- Billing account belum diaktifkan
- Domain tidak sesuai dengan restriction

### Peta muncul tapi abu-abu?
- Maps JavaScript API belum di-enable
- Cek quota sudah habis atau belum

---

## 📞 Butuh Bantuan?
Jika masih ada masalah, screenshot error di console browser (F12) dan tanyakan lagi!

