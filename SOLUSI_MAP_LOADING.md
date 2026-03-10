# 🔧 Solusi: Peta Loading Terus (Muter-muter)

## ❌ Masalah:
Peta menampilkan loading spinner "Memuat peta..." terus-menerus dan tidak pernah muncul.

## ✅ Penyebab:
`GOOGLE_MAPS_API_KEY` belum dikonfigurasi di file `.env`

## 🛠️ Yang Sudah Diperbaiki:

### 1. File `.env` - Ditambahkan placeholder API key
```env
# Google Maps API Key
GOOGLE_MAPS_API_KEY=YOUR_API_KEY_HERE
```

### 2. File `checkout.blade.php` - Koordinat toko diperbaiki
```javascript
// SEBELUM (Salah - Palembang):
toko: {
  latitude:  // Kosong!
  longitude: 104.7754307,
}

// SESUDAH (Benar - Purbalingga):
toko: {
  latitude: -7.372085,
  longitude: 109.241568,
  nama: 'Pempek Bunda 75'
}
```

---

## 📋 Langkah Selanjutnya (ANDA HARUS LAKUKAN):

### Step 1: Dapatkan Google Maps API Key
Baca file: `CARA_DAPATKAN_API_KEY.md` untuk panduan lengkap.

Singkatnya:
1. Buka https://console.cloud.google.com/
2. Buat project baru
3. Enable "Maps JavaScript API" dan "Geocoding API"
4. Buat API key
5. Copy API key tersebut

### Step 2: Update File .env
Ganti `YOUR_API_KEY_HERE` dengan API key yang Anda dapatkan:

```env
GOOGLE_MAPS_API_KEY=AIzaSyXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

### Step 3: Clear Cache Laravel
```bash
php artisan config:clear
php artisan cache:clear
```

### Step 4: Refresh Browser
- Buka halaman checkout
- Tekan `Ctrl + F5` (hard refresh)
- Peta seharusnya muncul dengan 2 marker:
  - 🔵 **Marker Biru** = Lokasi Toko (Fixed, tidak bisa digeser)
  - 🔴 **Marker Merah** = Lokasi User (Draggable, bisa digeser)

---

## 🎯 Hasil yang Diharapkan:

Setelah API key dikonfigurasi, sistem akan:

1. ✅ Menampilkan peta Google Maps
2. ✅ Menampilkan 2 marker (toko & user)
3. ✅ User bisa drag marker merah atau klik peta
4. ✅ Otomatis hitung jarak (km)
5. ✅ Otomatis hitung ongkir (Rp 2.500/km)
6. ✅ Reverse geocoding untuk dapat alamat otomatis
7. ✅ Textarea hanya untuk catatan tambahan

---

## 🐛 Jika Masih Bermasalah:

### Cek Console Browser:
1. Tekan `F12` di browser
2. Buka tab "Console"
3. Refresh halaman
4. Screenshot error yang muncul

### Error Umum:

**"Google Maps JavaScript API error: InvalidKeyMapError"**
- API key salah atau belum di-enable
- Solusi: Cek API key di Google Cloud Console

**"This page can't load Google Maps correctly"**
- Billing account belum diaktifkan
- Solusi: Aktifkan billing (gratis $200/bulan)

**Peta abu-abu semua**
- Maps JavaScript API belum di-enable
- Solusi: Enable di Google Cloud Console

---

## 📊 Status Implementasi:

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Dual Marker System | ✅ Done | Toko (biru) + User (merah) |
| Draggable User Marker | ✅ Done | Bisa drag atau klik peta |
| Distance Calculation | ✅ Done | Haversine formula |
| Shipping Cost Calculation | ✅ Done | Rp 2.500/km |
| Reverse Geocoding | ✅ Done | Alamat otomatis |
| Database Migration | ✅ Done | Sudah dijalankan |
| Store Coordinates | ✅ Fixed | Purbalingga (-7.372085, 109.241568) |
| Google Maps API Key | ⏳ Pending | **ANDA HARUS TAMBAHKAN** |

---

## 💡 Tips:

1. **Jangan lupa clear cache** setiap kali ubah `.env`
2. **Hard refresh browser** dengan `Ctrl + F5`
3. **Cek console browser** jika ada error
4. **Restrict API key** untuk keamanan
5. **Monitor quota** di Google Cloud Console

---

## 📞 Butuh Bantuan Lebih Lanjut?

Jika setelah menambahkan API key masih bermasalah:
1. Screenshot halaman (termasuk console browser)
2. Copy error message yang muncul
3. Tanyakan lagi dengan detail error tersebut

Saya siap membantu! 🚀
