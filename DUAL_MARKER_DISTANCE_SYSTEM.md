# 🗺️ Dual Marker Distance System - PempekBunda 75

## 📋 Overview

Sistem pemilihan lokasi dengan **2 marker berbeda**:
1. **Marker Toko** (Biru, Fixed) - Tidak bisa digeser
2. **Marker User** (Merah, Draggable) - Bisa digeser/diklik

Sistem otomatis menghitung **jarak** dan **ongkir** berdasarkan jarak antara toko dan user.

---

## ✨ Fitur Utama

### 1. **Dual Marker System**

#### Marker 1: Toko (Fixed - Biru 🏪)
- Warna: Biru (#3B82F6)
- Icon: 🏪 (toko)
- Draggable: **TIDAK** (fixed position)
- Koordinat: Dari database/config
- Info Window: Nama toko + koordinat

#### Marker 2: User (Draggable - Merah 📍)
- Warna: Merah (#EF4444)
- Icon: 📍 (pin)
- Draggable: **YA** (bisa digeser)
- Animasi: Bounce (2 detik pertama)
- Bisa dipindahkan dengan:
  - Drag marker
  - Klik pada peta

### 2. **Perhitungan Jarak Otomatis**
- Menggunakan **Haversine Formula**
- Akurasi tinggi (radius bumi: 6371 km)
- Update real-time saat marker berpindah
- Hasil dalam kilometer (2 desimal)

### 3. **Perhitungan Ongkir Otomatis**
- Formula: `Ongkir = Jarak (km) × Harga per km`
- Default: Rp 2.500 per km (bisa diubah)
- Contoh:
  - Jarak 5.2 km → Ongkir = 5.2 × 2.500 = Rp 13.000
  - Jarak 10.8 km → Ongkir = 10.8 × 2.500 = Rp 27.000

### 4. **Display Informasi**
- Jarak dari toko (dalam km)
- Ongkos kirim (dalam Rupiah)
- Perhitungan detail
- Koordinat user (latitude & longitude)
- Alamat lengkap (reverse geocoding)

### 5. **Validasi Ketat**
- Tombol checkout disabled jika:
  - Belum pilih lokasi
  - Jarak belum dihitung
  - Koordinat masih null

---

## 🎯 Cara Menggunakan (User)

### Step 1: Pilih Metode Pengiriman
- Klik "Diantar (GoSend)"
- Peta muncul dengan 2 marker

### Step 2: Lihat Marker Toko (Biru)
- Marker biru = lokasi toko
- Tidak bisa digeser (fixed)
- Klik untuk lihat info toko

### Step 3: Pindahkan Marker User (Merah)
**Cara 1: Drag Marker**
- Klik dan tahan marker merah
- Geser ke lokasi Anda
- Lepas klik

**Cara 2: Klik Peta**
- Klik langsung pada peta di lokasi Anda
- Marker merah otomatis pindah

### Step 4: Lihat Hasil Otomatis
- Jarak dari toko (contoh: 5.2 km)
- Ongkir (contoh: Rp 13.000)
- Alamat lengkap
- Koordinat

### Step 5: Tambahkan Catatan (Opsional)
- Patokan rumah
- Warna pagar
- RT/RW
- Detail lainnya

### Step 6: Lanjut Checkout
- Tombol aktif jika jarak sudah dihitung
- Ongkir otomatis ditambahkan ke total

---

## 📊 Data yang Dikirim ke Backend

```javascript
{
  location: {
    latitude_user: -2.9860735,      // Koordinat user
    longitude_user: 104.7854307,
    latitude_toko: -2.9760735,      // Koordinat toko
    longitude_toko: 104.7754307,
    jarak_km: 5.23,                 // Jarak dalam km
    ongkir: 13075,                  // Ongkir dalam Rupiah
    catatan_alamat: "Rumah pagar hitam, RT 03 RW 05"
  },
  customer: {
    address: "Jl. Sudirman No. 123, Palembang...",
    catatan_alamat: "Rumah pagar hitam, RT 03 RW 05"
  }
}
```

### Database (orders table):
- `latitude`: -2.9860735 (user)
- `longitude`: 104.7854307 (user)
- `latitude_toko`: -2.9760735 (toko)
- `longitude_toko`: 104.7754307 (toko)
- `jarak_km`: 5.23
- `ongkir`: 13075

---

## 🔧 Setup & Configuration

### 1. Set Koordinat Toko

Edit di `checkout.blade.php`, bagian Alpine.js data:

```javascript
// Koordinat Toko (Fixed)
toko: {
  latitude: -2.9760735,  // GANTI dengan latitude toko Anda
  longitude: 104.7754307, // GANTI dengan longitude toko Anda
  nama: 'PempekBunda 75'
},
```

**Cara mendapatkan koordinat toko:**
1. Buka Google Maps
2. Cari alamat toko Anda
3. Klik kanan pada lokasi toko
4. Pilih koordinat yang muncul (akan ter-copy)
5. Format: `latitude, longitude`

### 2. Set Harga per KM

Edit di `checkout.blade.php`:

```javascript
// Jarak & Ongkir
pengiriman: {
  jarak_km: 0,
  ongkir: 0,
  harga_per_km: 2500  // GANTI dengan harga per km Anda
},
```

Contoh harga:
- Rp 2.000/km (murah)
- Rp 2.500/km (standar)
- Rp 3.000/km (premium)
- Rp 5.000/km (jauh)

### 3. Jalankan Migration

```bash
php artisan migrate:fresh
# ATAU jika sudah ada data:
php artisan migrate
```

Kolom yang ditambahkan:
- `latitude` (user)
- `longitude` (user)
- `latitude_toko` (toko)
- `longitude_toko` (toko)
- `jarak_km` (decimal 8,2)
- `ongkir` (integer)

---

## 🎨 Customization

### Ubah Warna Marker

Edit di `initializeEmbeddedMap()`:

```javascript
// Marker Toko (Biru)
icon: {
  fillColor: '#3B82F6',  // Ganti warna (hex code)
  // ...
}

// Marker User (Merah)
icon: {
  fillColor: '#EF4444',  // Ganti warna (hex code)
  // ...
}
```

### Ubah Icon Marker

```javascript
label: {
  text: '🏪',  // Ganti emoji untuk toko
  fontSize: '20px'
}

label: {
  text: '📍',  // Ganti emoji untuk user
  fontSize: '20px'
}
```

### Ubah Zoom Level

```javascript
zoom: 14,  // Ubah ke 10-18 sesuai kebutuhan
```

### Ubah Default Posisi User

```javascript
// Default lokasi user: dekat toko (offset sedikit)
const defaultUserLat = tokoLat + 0.01;  // Ubah offset (0.01 ≈ 1km)
const defaultUserLng = tokoLng + 0.01;
```

---

## 📐 Haversine Formula

Formula yang digunakan untuk menghitung jarak:

```javascript
const R = 6371; // Radius bumi dalam km

const lat1 = toko.latitude * Math.PI / 180;
const lat2 = user.latitude * Math.PI / 180;
const deltaLat = (user.latitude - toko.latitude) * Math.PI / 180;
const deltaLng = (user.longitude - toko.longitude) * Math.PI / 180;

const a = Math.sin(deltaLat / 2) * Math.sin(deltaLat / 2) +
          Math.cos(lat1) * Math.cos(lat2) *
          Math.sin(deltaLng / 2) * Math.sin(deltaLng / 2);

const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

const jarak = R * c; // Jarak dalam km
```

**Akurasi:**
- Sangat akurat untuk jarak < 100 km
- Error < 0.5% untuk jarak < 1000 km
- Cocok untuk delivery lokal

---

## 🔍 Alternatif: Google Distance Matrix API

Jika ingin menggunakan Google Distance Matrix API (lebih akurat, tapi berbayar):

```javascript
calculateDistance() {
  const service = new google.maps.DistanceMatrixService();
  
  service.getDistanceMatrix({
    origins: [{ lat: this.toko.latitude, lng: this.toko.longitude }],
    destinations: [{ lat: parseFloat(this.location.latitude), lng: parseFloat(this.location.longitude) }],
    travelMode: 'DRIVING',
    unitSystem: google.maps.UnitSystem.METRIC
  }, (response, status) => {
    if (status === 'OK') {
      const distance = response.rows[0].elements[0].distance.value / 1000; // Convert to km
      this.pengiriman.jarak_km = distance;
      this.pengiriman.ongkir = Math.round(distance * this.pengiriman.harga_per_km);
      this.calculateTotals();
    }
  });
}
```

**Keuntungan:**
- Jarak berdasarkan rute jalan (bukan garis lurus)
- Lebih akurat untuk kota dengan banyak jalan
- Bisa estimasi waktu tempuh

**Kekurangan:**
- Berbayar (setelah quota gratis habis)
- Perlu enable Distance Matrix API
- Lebih lambat (API call)

---

## 💰 Biaya

### Haversine Formula (Current):
- **GRATIS** (perhitungan di client-side)
- Tidak ada API call
- Tidak ada quota

### Google Distance Matrix API (Alternative):
- **$5 per 1000 requests** (setelah quota gratis)
- Quota gratis: $200/bulan
- Setara ~40,000 requests gratis per bulan

**Rekomendasi:**
- Gunakan Haversine untuk delivery lokal (< 20 km)
- Gunakan Distance Matrix jika perlu akurasi tinggi

---

## 🐛 Troubleshooting

### Problem: Marker toko tidak muncul
**Solusi:**
1. Cek koordinat toko sudah benar
2. Cek format: `latitude: -2.9760735` (pakai titik, bukan koma)
3. Refresh halaman

### Problem: Jarak tidak dihitung
**Solusi:**
1. Cek console browser untuk error
2. Pastikan user marker sudah dipindahkan
3. Cek fungsi `calculateDistance()` dipanggil

### Problem: Ongkir tidak update
**Solusi:**
1. Cek `calculateTotals()` dipanggil setelah `calculateDistance()`
2. Cek `harga_per_km` sudah diset
3. Refresh halaman

### Problem: Marker user tidak bisa digeser
**Solusi:**
1. Cek `draggable: true` di kode user marker
2. Cek tidak ada CSS yang block pointer events
3. Refresh halaman

---

## ✅ Testing Checklist

- [ ] Setup koordinat toko
- [ ] Setup harga per km
- [ ] Jalankan migration
- [ ] Clear cache
- [ ] Peta muncul dengan 2 marker
- [ ] Marker toko (biru) tidak bisa digeser
- [ ] Marker user (merah) bisa digeser
- [ ] Klik peta memindahkan marker user
- [ ] Jarak dihitung otomatis
- [ ] Ongkir dihitung otomatis
- [ ] Display jarak & ongkir tampil
- [ ] Koordinat update real-time
- [ ] Alamat otomatis muncul
- [ ] Validasi berfungsi
- [ ] Total checkout include ongkir
- [ ] Data tersimpan ke database

---

## 📊 Example Scenarios

### Scenario 1: Jarak Dekat (2 km)
```
Toko: -2.9760735, 104.7754307
User: -2.9860735, 104.7854307
Jarak: 2.15 km
Ongkir: 2.15 × 2500 = Rp 5.375 → Rp 5.000 (rounded)
```

### Scenario 2: Jarak Sedang (5 km)
```
Toko: -2.9760735, 104.7754307
User: -3.0160735, 104.8154307
Jarak: 5.23 km
Ongkir: 5.23 × 2500 = Rp 13.075 → Rp 13.000 (rounded)
```

### Scenario 3: Jarak Jauh (10 km)
```
Toko: -2.9760735, 104.7754307
User: -3.0760735, 104.8754307
Jarak: 10.87 km
Ongkir: 10.87 × 2500 = Rp 27.175 → Rp 27.000 (rounded)
```

---

## 🎯 Best Practices

### Untuk User:
1. **Zoom in** untuk akurasi lebih tinggi
2. **Geser marker** ke posisi yang tepat (depan rumah)
3. **Tambahkan catatan** untuk memudahkan driver
4. **Cek jarak** sebelum checkout

### Untuk Developer:
1. **Set koordinat toko** dengan akurat
2. **Adjust harga per km** sesuai biaya operasional
3. **Test di berbagai jarak** (dekat, sedang, jauh)
4. **Monitor ongkir** apakah masuk akal
5. **Implement radius limit** jika perlu (contoh: max 20 km)

---

## 🚀 Future Improvements

1. **Radius Limit**
   - Validasi jarak maksimal (contoh: 20 km)
   - Tampilkan error jika terlalu jauh

2. **Harga Bertingkat**
   - 0-5 km: Rp 2.000/km
   - 5-10 km: Rp 2.500/km
   - 10+ km: Rp 3.000/km

3. **Estimasi Waktu**
   - Hitung estimasi waktu tempuh
   - Tampilkan: "Estimasi 30 menit"

4. **Multiple Toko**
   - Pilih toko terdekat otomatis
   - Hitung dari toko terdekat

5. **Save Favorite Locations**
   - User bisa simpan alamat favorit
   - Quick select dari list

---

**Dibuat dengan ❤️ untuk PempekBunda 75**
**Tanggal: 4 Maret 2019**
**Version: 3.0.0 (Dual Marker + Distance System)**

