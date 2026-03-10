# ✅ Testing Checklist: Map Picker GoJek Style

## 📋 Pre-Testing Setup

- [ ] Google Maps API Key sudah dibuat
- [ ] API Key sudah ditambahkan ke `.env`
- [ ] Maps JavaScript API sudah di-enable
- [ ] Geocoding API sudah di-enable
- [ ] Migration sudah dijalankan (`php artisan migrate`)
- [ ] Cache sudah di-clear (`php artisan config:clear`)
- [ ] Server Laravel sudah running (`php artisan serve`)

---

## 🧪 Test Case 1: Setup & Configuration

### 1.1 Environment Variable
- [ ] File `.env` memiliki `GOOGLE_MAPS_API_KEY`
- [ ] API Key tidak kosong
- [ ] API Key format valid (dimulai dengan `AIza`)

### 1.2 Database
- [ ] Tabel `orders` memiliki kolom `latitude`
- [ ] Tabel `orders` memiliki kolom `longitude`
- [ ] Index `idx_location` sudah dibuat

### 1.3 File Integrity
- [ ] File `checkout.blade.php` sudah diupdate
- [ ] Google Maps script tag ada di `<head>`
- [ ] Modal map HTML ada di file
- [ ] JavaScript functions sudah ditambahkan

---

## 🧪 Test Case 2: UI/UX Testing

### 2.1 Checkout Page Load
- [ ] Halaman checkout terbuka tanpa error
- [ ] Form customer info tampil dengan benar
- [ ] Radio button "Ambil Sendiri" dan "Diantar" tampil
- [ ] Field alamat tersembunyi saat pilih "Ambil Sendiri"
- [ ] Field alamat muncul saat pilih "Diantar (GoSend)"

### 2.2 Field Alamat
- [ ] Textarea alamat readonly (tidak bisa diketik)
- [ ] Placeholder text: "Klik tombol pin untuk pilih lokasi di peta..."
- [ ] Tombol pin merah ada di pojok kanan
- [ ] Tombol pin bisa diklik
- [ ] Hover effect pada tombol pin

### 2.3 Validasi Awal
- [ ] Tombol "Lanjut ke Pembayaran" disabled saat belum pilih lokasi
- [ ] Tooltip/hint muncul: "Klik tombol pin untuk memilih lokasi di peta (WAJIB)"

---

## 🧪 Test Case 3: Modal Map Testing

### 3.1 Open Modal
- [ ] Klik tombol pin membuka modal
- [ ] Modal muncul dengan animasi smooth
- [ ] Overlay background gelap (backdrop)
- [ ] Modal centered di layar
- [ ] Loading indicator muncul saat peta dimuat

### 3.2 Map Display
- [ ] Google Maps tampil dengan benar
- [ ] Peta centered di Palembang (atau default location)
- [ ] Zoom level 15 (atau sesuai setting)
- [ ] Pin merah di tengah layar
- [ ] Pin merah memiliki animasi bounce
- [ ] Map controls (zoom +/-) tampil

### 3.3 Modal Header
- [ ] Judul: "Pilih Lokasi Pengiriman"
- [ ] Subtitle: "Geser pin atau klik peta untuk menentukan lokasi"
- [ ] Tombol close (X) di pojok kanan
- [ ] Background hijau (#6B8E23)

### 3.4 Address Display
- [ ] Section "Alamat yang Dipilih" tampil
- [ ] Placeholder: "Geser peta untuk memilih lokasi..."
- [ ] Field latitude tampil
- [ ] Field longitude tampil
- [ ] Tombol "Batal" tampil
- [ ] Tombol "Pilih Lokasi Ini" tampil

---

## 🧪 Test Case 4: Map Interaction

### 4.1 Drag Map
- [ ] Drag peta ke kiri → pin tetap di tengah
- [ ] Drag peta ke kanan → pin tetap di tengah
- [ ] Drag peta ke atas → pin tetap di tengah
- [ ] Drag peta ke bawah → pin tetap di tengah
- [ ] Koordinat latitude update real-time
- [ ] Koordinat longitude update real-time

### 4.2 Click Map
- [ ] Klik pada peta → peta bergerak ke titik yang diklik
- [ ] Pin tetap di tengah setelah klik
- [ ] Koordinat update sesuai titik yang diklik
- [ ] Smooth animation saat peta bergerak

### 4.3 Zoom
- [ ] Zoom in (+) → peta zoom in, pin tetap di tengah
- [ ] Zoom out (-) → peta zoom out, pin tetap di tengah
- [ ] Scroll mouse → zoom in/out
- [ ] Pinch gesture (mobile) → zoom in/out

---

## 🧪 Test Case 5: Reverse Geocoding

### 5.1 Address Generation
- [ ] Setelah drag peta, tunggu 1-2 detik
- [ ] Alamat otomatis muncul di field "Alamat yang Dipilih"
- [ ] Alamat lengkap (jalan, kelurahan, kota, provinsi, kode pos)
- [ ] Format alamat sesuai standar Indonesia

### 5.2 Coordinate Update
- [ ] Latitude terisi otomatis (format: -2.976073)
- [ ] Longitude terisi otomatis (format: 104.775430)
- [ ] Koordinat readonly (tidak bisa diedit)
- [ ] Koordinat update setiap kali peta bergerak

### 5.3 Error Handling
- [ ] Jika geocoding gagal → tampil koordinat saja
- [ ] Jika tidak ada koneksi → tampil error message
- [ ] Jika API quota habis → tampil error message

---

## 🧪 Test Case 6: Confirm Location

### 6.1 Button State
- [ ] Tombol "Pilih Lokasi Ini" disabled saat belum ada alamat
- [ ] Tombol enabled setelah alamat ter-generate
- [ ] Hover effect pada tombol

### 6.2 Confirm Action
- [ ] Klik "Pilih Lokasi Ini" → modal tertutup
- [ ] Alamat tersimpan di field alamat (checkout page)
- [ ] Koordinat tersimpan di `location.latitude`
- [ ] Koordinat tersimpan di `location.longitude`
- [ ] Badge hijau muncul: "✓ Lokasi dipilih: lat, lng"

### 6.3 Cancel Action
- [ ] Klik "Batal" → modal tertutup
- [ ] Alamat tidak tersimpan (tetap kosong)
- [ ] Koordinat tidak tersimpan
- [ ] Badge hijau tidak muncul

### 6.4 Close Modal
- [ ] Klik tombol X → modal tertutup
- [ ] Klik overlay (backdrop) → modal tertutup
- [ ] Press ESC key → modal tertutup (optional)

---

## 🧪 Test Case 7: Validation

### 7.1 Delivery Method: Pickup
- [ ] Pilih "Ambil Sendiri"
- [ ] Field alamat tersembunyi
- [ ] Tombol "Lanjut ke Pembayaran" enabled (jika phone terisi)
- [ ] Tidak perlu pilih lokasi

### 7.2 Delivery Method: Delivery (Belum Pilih Lokasi)
- [ ] Pilih "Diantar (GoSend)"
- [ ] Field alamat muncul
- [ ] Tombol "Lanjut ke Pembayaran" disabled
- [ ] Badge hijau tidak muncul

### 7.3 Delivery Method: Delivery (Sudah Pilih Lokasi)
- [ ] Pilih "Diantar (GoSend)"
- [ ] Klik pin, pilih lokasi
- [ ] Alamat terisi otomatis
- [ ] Badge hijau muncul
- [ ] Tombol "Lanjut ke Pembayaran" enabled

### 7.4 Phone Validation
- [ ] Jika phone kosong → tombol checkout disabled
- [ ] Jika phone terisi → tombol checkout enabled (jika lokasi juga sudah dipilih)

---

## 🧪 Test Case 8: Data Persistence

### 8.1 Frontend State
- [ ] Setelah pilih lokasi, refresh page → data hilang (expected)
- [ ] Setelah pilih lokasi, ganti tab → data tetap ada
- [ ] Setelah pilih lokasi, kembali ke step 1 → data tetap ada

### 8.2 Order Creation
- [ ] Lanjut ke step 2 (pembayaran)
- [ ] Lanjut ke step 3 (konfirmasi)
- [ ] Buat order
- [ ] Cek console log → data location ada
- [ ] Cek database → kolom latitude terisi
- [ ] Cek database → kolom longitude terisi
- [ ] Cek database → kolom address terisi

---

## 🧪 Test Case 9: Responsive Design

### 9.1 Desktop (> 1024px)
- [ ] Modal lebar max-width 4xl
- [ ] Peta tinggi 500px
- [ ] Layout 2 kolom untuk koordinat
- [ ] Semua elemen tampil dengan baik

### 9.2 Tablet (768px - 1024px)
- [ ] Modal lebar 90% viewport
- [ ] Peta tinggi 450px
- [ ] Layout 2 kolom untuk koordinat
- [ ] Tombol tidak terpotong

### 9.3 Mobile (< 768px)
- [ ] Modal full screen
- [ ] Peta tinggi 400px
- [ ] Layout 1 kolom untuk koordinat
- [ ] Touch-friendly controls
- [ ] Drag peta dengan jari
- [ ] Pinch to zoom
- [ ] Tombol cukup besar untuk di-tap

---

## 🧪 Test Case 10: Performance

### 10.1 Load Time
- [ ] Checkout page load < 2 detik
- [ ] Modal open < 0.5 detik
- [ ] Map render < 1 detik
- [ ] Geocoding response < 1 detik

### 10.2 API Calls
- [ ] Map load: 1 API call
- [ ] Geocoding: 1 API call per drag/click
- [ ] No unnecessary API calls
- [ ] Debounced geocoding (tidak spam API)

### 10.3 Memory
- [ ] No memory leaks
- [ ] Map cleanup saat modal close
- [ ] No console errors

---

## 🧪 Test Case 11: Browser Compatibility

### 11.1 Chrome
- [ ] Map tampil dengan benar
- [ ] Drag & click berfungsi
- [ ] Geocoding berfungsi
- [ ] No console errors

### 11.2 Firefox
- [ ] Map tampil dengan benar
- [ ] Drag & click berfungsi
- [ ] Geocoding berfungsi
- [ ] No console errors

### 11.3 Safari
- [ ] Map tampil dengan benar
- [ ] Drag & click berfungsi
- [ ] Geocoding berfungsi
- [ ] No console errors

### 11.4 Edge
- [ ] Map tampil dengan benar
- [ ] Drag & click berfungsi
- [ ] Geocoding berfungsi
- [ ] No console errors

### 11.5 Mobile Browsers
- [ ] Chrome Mobile
- [ ] Safari Mobile
- [ ] Firefox Mobile
- [ ] Samsung Internet

---

## 🧪 Test Case 12: Error Scenarios

### 12.1 No Internet Connection
- [ ] Modal open → loading indicator
- [ ] Map tidak load → error message
- [ ] Geocoding gagal → tampil koordinat saja

### 12.2 Invalid API Key
- [ ] Map tidak load
- [ ] Error message: "This page can't load Google Maps correctly"
- [ ] Console error jelas

### 12.3 API Quota Exceeded
- [ ] Map load tapi ada watermark "For development purposes only"
- [ ] Geocoding gagal setelah quota habis
- [ ] Error message informatif

### 12.4 Slow Network
- [ ] Loading indicator tampil
- [ ] Map load dengan graceful degradation
- [ ] Geocoding timeout setelah 5 detik

---

## 🧪 Test Case 13: Security

### 13.1 API Key
- [ ] API Key tidak terlihat di source code (dari .env)
- [ ] API Key restricted dengan domain
- [ ] API Key restricted dengan API (Maps JS + Geocoding)

### 13.2 Input Validation
- [ ] Koordinat readonly (tidak bisa diubah manual)
- [ ] Alamat readonly (tidak bisa diubah manual)
- [ ] No XSS vulnerability

### 13.3 CSRF Protection
- [ ] Form checkout memiliki CSRF token
- [ ] Order creation protected dengan CSRF

---

## 🧪 Test Case 14: Edge Cases

### 14.1 Lokasi di Luar Negeri
- [ ] Pilih lokasi di luar Indonesia
- [ ] Alamat ter-generate dengan benar
- [ ] Koordinat valid

### 14.2 Lokasi di Tengah Laut
- [ ] Pilih lokasi di laut
- [ ] Alamat: "Unnamed Road" atau koordinat saja
- [ ] Tidak crash

### 14.3 Lokasi di Kutub
- [ ] Pilih lokasi di kutub utara/selatan
- [ ] Koordinat valid (lat: -90 to 90)
- [ ] Tidak crash

### 14.4 Rapid Clicking
- [ ] Klik tombol pin berkali-kali cepat
- [ ] Modal tidak buka berkali-kali
- [ ] No duplicate map instances

### 14.5 Multiple Orders
- [ ] Buat order pertama dengan lokasi A
- [ ] Buat order kedua dengan lokasi B
- [ ] Lokasi tidak tercampur

---

## 🧪 Test Case 15: Accessibility

### 15.1 Keyboard Navigation
- [ ] Tab key untuk navigasi
- [ ] Enter key untuk submit
- [ ] ESC key untuk close modal

### 15.2 Screen Reader
- [ ] Label jelas untuk field
- [ ] Button memiliki aria-label
- [ ] Error messages terbaca

### 15.3 Color Contrast
- [ ] Text readable (contrast ratio > 4.5:1)
- [ ] Button colors accessible
- [ ] Error messages jelas

---

## 📊 Test Results Summary

### Pass Rate Target: 95%

| Category | Total Tests | Passed | Failed | Pass Rate |
|----------|-------------|--------|--------|-----------|
| Setup & Config | 8 | | | % |
| UI/UX | 12 | | | % |
| Modal Map | 15 | | | % |
| Map Interaction | 12 | | | % |
| Reverse Geocoding | 9 | | | % |
| Confirm Location | 12 | | | % |
| Validation | 12 | | | % |
| Data Persistence | 8 | | | % |
| Responsive | 12 | | | % |
| Performance | 9 | | | % |
| Browser Compat | 15 | | | % |
| Error Scenarios | 12 | | | % |
| Security | 9 | | | % |
| Edge Cases | 15 | | | % |
| Accessibility | 9 | | | % |
| **TOTAL** | **169** | | | **%** |

---

## 🐛 Bug Report Template

Jika menemukan bug, gunakan template ini:

```
BUG REPORT

Title: [Judul singkat bug]

Severity: [Critical / High / Medium / Low]

Steps to Reproduce:
1. 
2. 
3. 

Expected Result:
[Apa yang seharusnya terjadi]

Actual Result:
[Apa yang sebenarnya terjadi]

Screenshots:
[Attach screenshot jika ada]

Browser: [Chrome 120 / Firefox 121 / etc]
OS: [Windows 11 / macOS 14 / etc]
Device: [Desktop / Mobile]

Console Errors:
[Copy paste error dari console]

Additional Notes:
[Informasi tambahan]
```

---

## ✅ Sign-off

Tested by: ___________________
Date: ___________________
Signature: ___________________

Approved by: ___________________
Date: ___________________
Signature: ___________________

---

**Selamat testing! 🧪**

Dibuat dengan ❤️ untuk Pempek Bunda 75
Tanggal: 4 Maret 2026
