# 🎯 Langkah Terakhir: Aktifkan Google Maps

## ✅ Yang Sudah Saya Perbaiki:

1. **File `.env`** - Sudah ditambahkan placeholder untuk API key
2. **File `checkout.blade.php`** - Koordinat toko sudah diperbaiki ke Purbalingga
3. **Cache Laravel** - Sudah di-clear

## ⏳ Yang Harus Anda Lakukan Sekarang:

### 🔑 Dapatkan Google Maps API Key

Ikuti langkah ini:

```
1. Buka browser → https://console.cloud.google.com/
2. Login dengan akun Google Anda
3. Klik "Select a project" → "NEW PROJECT"
4. Nama project: "PempekBunda 75" → CREATE
5. Tunggu project dibuat (sekitar 10 detik)
6. Di menu kiri, klik "APIs & Services" → "Library"
7. Cari "Maps JavaScript API" → Klik → ENABLE
8. Cari "Geocoding API" → Klik → ENABLE
9. Di menu kiri, klik "Credentials"
10. Klik "CREATE CREDENTIALS" → "API key"
11. COPY API key yang muncul (contoh: AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX)
```

### 📝 Update File .env

Buka file `.env` di root project Anda, cari baris ini:

```env
GOOGLE_MAPS_API_KEY=YOUR_API_KEY_HERE
```

Ganti `YOUR_API_KEY_HERE` dengan API key yang Anda copy tadi:

```env
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

**PENTING:** Jangan ada spasi sebelum atau sesudah API key!

### 🔄 Refresh Browser

1. Buka halaman checkout di browser
2. Tekan `Ctrl + F5` untuk hard refresh
3. Peta seharusnya muncul!

---

## 🎉 Hasil yang Akan Anda Lihat:

Setelah API key dikonfigurasi, di halaman checkout akan muncul:

```
┌─────────────────────────────────────────────────────┐
│  📍 Pilih Lokasi Pengiriman                         │
├─────────────────────────────────────────────────────┤
│                                                     │
│  ┌───────────────────────────────────────────────┐ │
│  │                                               │ │
│  │         🗺️  GOOGLE MAPS                      │ │
│  │                                               │ │
│  │         🔵 ← Marker Toko (Biru, Fixed)       │ │
│  │                                               │ │
│  │         🔴 ← Marker User (Merah, Draggable)  │ │
│  │                                               │ │
│  └───────────────────────────────────────────────┘ │
│                                                     │
│  🔵 Lokasi Toko (Fixed)                            │
│  🔴 Lokasi Anda (Geser untuk pindah)              │
│                                                     │
├─────────────────────────────────────────────────────┤
│  📏 Jarak dari Toko: 5.2 km                        │
│  💰 Ongkos Kirim: Rp 13.000                        │
├─────────────────────────────────────────────────────┤
│  📍 Latitude Anda: -7.380123                       │
│  📍 Longitude Anda: 109.250456                     │
├─────────────────────────────────────────────────────┤
│  ✅ Alamat Terdeteksi:                             │
│  Jl. Contoh No. 123, Purbalingga, Jawa Tengah     │
├─────────────────────────────────────────────────────┤
│  📝 Catatan Tambahan Alamat (Opsional)             │
│  ┌───────────────────────────────────────────────┐ │
│  │ Rumah pagar hitam, dekat masjid...           │ │
│  └───────────────────────────────────────────────┘ │
└─────────────────────────────────────────────────────┘
```

---

## 🎮 Cara Menggunakan:

1. **Geser Marker Merah** - Drag marker merah ke lokasi yang diinginkan
2. **Atau Klik Peta** - Klik langsung di peta untuk pindahkan marker
3. **Jarak & Ongkir Otomatis** - Akan terhitung otomatis setiap kali marker dipindah
4. **Alamat Otomatis** - Alamat akan muncul otomatis dari reverse geocoding
5. **Tambahkan Catatan** - Isi textarea dengan patokan tambahan (RT/RW, warna rumah, dll)

---

## ⚠️ Catatan Penting:

### Billing Account
Google Maps API memerlukan billing account, TAPI:
- ✅ Google memberikan **$200 kredit gratis per bulan**
- ✅ Untuk toko pempek, ini **lebih dari cukup**
- ✅ Anda **tidak akan dicharge** kecuali melebihi $200/bulan

### Quota Gratis:
- Maps JavaScript API: **28,000 loads/bulan** gratis
- Geocoding API: **40,000 requests/bulan** gratis

Untuk toko pempek dengan traffic normal, ini sangat cukup!

---

## 🐛 Jika Masih Bermasalah:

### Peta masih loading terus?
1. Cek API key sudah benar di `.env` (tidak ada spasi)
2. Pastikan sudah enable "Maps JavaScript API" dan "Geocoding API"
3. Hard refresh browser: `Ctrl + F5`
4. Cek console browser (F12) untuk error

### Error "This page can't load Google Maps correctly"?
- Billing account belum diaktifkan
- Solusi: Aktifkan billing di Google Cloud Console (gratis $200/bulan)

### Peta muncul tapi abu-abu?
- Maps JavaScript API belum di-enable
- Solusi: Enable di Google Cloud Console → APIs & Services → Library

---

## 📞 Butuh Bantuan?

Jika setelah menambahkan API key masih ada masalah:
1. Screenshot halaman (termasuk peta yang error)
2. Tekan F12 → buka tab Console → screenshot error yang muncul
3. Tanyakan lagi dengan screenshot tersebut

Saya siap membantu! 🚀

---

## 📚 File Dokumentasi Lainnya:

- `QUICK_FIX.txt` - Panduan singkat
- `CARA_DAPATKAN_API_KEY.md` - Panduan detail mendapatkan API key
- `SOLUSI_MAP_LOADING.md` - Penjelasan lengkap masalah & solusi
- `DUAL_MARKER_DISTANCE_SYSTEM.md` - Dokumentasi sistem dual marker

---

**Selamat mencoba! Semoga berhasil! 🎉**

