# 🗺️ Cara Setup Google Maps API Key

## Langkah 1: Buat Google Cloud Project

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Login dengan akun Google Anda
3. Klik "Select a project" di bagian atas
4. Klik "NEW PROJECT"
5. Beri nama project: `Pempek-Bunda-75`
6. Klik "CREATE"

---

## Langkah 2: Enable APIs

1. Di sidebar kiri, klik **"APIs & Services"** → **"Library"**
2. Cari dan enable API berikut:

### a. Maps JavaScript API
- Ketik "Maps JavaScript API" di search box
- Klik hasil pertama
- Klik tombol **"ENABLE"**

### b. Geocoding API
- Kembali ke Library
- Ketik "Geocoding API" di search box
- Klik hasil pertama
- Klik tombol **"ENABLE"**

---

## Langkah 3: Buat API Key

1. Di sidebar kiri, klik **"APIs & Services"** → **"Credentials"**
2. Klik tombol **"+ CREATE CREDENTIALS"**
3. Pilih **"API key"**
4. API key akan dibuat otomatis
5. **COPY** API key yang muncul (contoh: `AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX`)

---

## Langkah 4: Restrict API Key (PENTING untuk Keamanan!)

1. Setelah API key dibuat, klik **"RESTRICT KEY"**
2. Beri nama: `Pempek Bunda 75 - Maps`

### Application Restrictions:
- Pilih **"HTTP referrers (web sites)"**
- Klik **"ADD AN ITEM"**
- Tambahkan domain Anda:
  ```
  http://localhost/*
  http://127.0.0.1/*
  https://yourdomain.com/*
  ```
  (Ganti `yourdomain.com` dengan domain website Anda)

### API Restrictions:
- Pilih **"Restrict key"**
- Centang:
  - ✅ Maps JavaScript API
  - ✅ Geocoding API

3. Klik **"SAVE"**

---

## Langkah 5: Tambahkan ke .env

1. Buka file `.env` di root project Laravel
2. Tambahkan baris berikut:

```env
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

3. Ganti `AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX` dengan API key Anda
4. Save file

---

## Langkah 6: Clear Cache Laravel

Jalankan command berikut di terminal:

```bash
php artisan config:clear
php artisan cache:clear
```

---

## Langkah 7: Test

1. Buka website Anda
2. Masuk ke halaman checkout
3. Pilih "Diantar (GoSend)"
4. Klik tombol pin merah
5. Peta harus muncul dengan benar

---

## 💰 Biaya Google Maps API

### Free Tier (Gratis):
- **$200 kredit gratis per bulan**
- Setara dengan:
  - 28,000 map loads
  - 40,000 geocoding requests
  - 100,000 static map requests

### Untuk Website Kecil-Menengah:
- Free tier sudah lebih dari cukup
- Tidak perlu enable billing

### Jika Traffic Tinggi:
- Enable billing di Google Cloud Console
- Biaya mulai dari $0.007 per request setelah quota gratis habis

---

## 🔒 Tips Keamanan

1. **JANGAN** commit API key ke Git
2. **SELALU** gunakan `.env` untuk menyimpan API key
3. **WAJIB** restrict API key dengan domain
4. **MONITOR** usage di Google Cloud Console
5. **ROTATE** API key secara berkala (setiap 6 bulan)

---

## 🐛 Troubleshooting

### Error: "This page can't load Google Maps correctly"
**Penyebab:** API key tidak valid atau belum di-restrict dengan benar

**Solusi:**
1. Cek API key di `.env` sudah benar
2. Cek Maps JavaScript API sudah di-enable
3. Cek domain sudah di-whitelist di API restrictions
4. Clear cache Laravel: `php artisan config:clear`

### Error: "Geocoding Service: This API project is not authorized"
**Penyebab:** Geocoding API belum di-enable

**Solusi:**
1. Buka Google Cloud Console
2. Enable Geocoding API
3. Tunggu 1-2 menit
4. Refresh halaman

### Peta Muncul tapi Abu-abu
**Penyebab:** Billing belum di-enable (jika sudah melebihi quota gratis)

**Solusi:**
1. Cek usage di Google Cloud Console
2. Jika sudah melebihi quota, enable billing
3. Atau tunggu bulan depan untuk quota baru

---

## 📞 Bantuan Lebih Lanjut

- [Google Maps Platform Documentation](https://developers.google.com/maps/documentation)
- [Google Cloud Console](https://console.cloud.google.com/)
- [Pricing Calculator](https://mapsplatform.google.com/pricing/)

---

**Selamat mencoba! 🎉**
