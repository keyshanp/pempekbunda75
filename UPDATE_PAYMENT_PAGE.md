# ✅ Update: Payment Page dengan Dual Marker System

## 🎉 Yang Sudah Diupdate:

File `resources/views/order/payment.blade.php` sudah diupdate dengan sistem dual marker yang sama seperti checkout page.

### Fitur yang Ditambahkan:

1. ✅ **Google Maps Interaktif** (400px)
2. ✅ **Dual Marker System:**
   - Marker Toko (Biru 🏪) - Fixed
   - Marker User (Merah 📍) - Draggable
3. ✅ **Perhitungan Jarak & Ongkir Otomatis**
4. ✅ **Reverse Geocoding** (alamat otomatis)
5. ✅ **Textarea untuk Catatan Tambahan**
6. ✅ **Validasi Ketat**

---

## 🚀 Cara Test:

1. **Buka halaman payment:**
   ```
   http://localhost/order/payment
   ```

2. **Scroll ke bagian "Alamat Spesifik"**

3. **Lihat peta dengan 2 marker:**
   - **Biru** = Toko (tidak bisa digeser)
   - **Merah** = User (geser atau klik peta)

4. **Geser marker merah** atau **klik peta**

5. **Lihat hasil otomatis:**
   - Jarak: X.XX km
   - Ongkir: Rp X.XXX
   - Alamat lengkap
   - Koordinat

6. **Tambahkan catatan** (opsional)

7. **Pilih metode pengiriman** (GoSend/Pickup)

8. **Submit order**

---

## 📊 Data yang Dikirim:

```javascript
{
  lat: -7.435387,
  lng: 109.249988,
  distance: 5.23,
  address: "Jl. Sudirman No. 123...",
  addressNotes: "Rumah pagar hitam, RT 03 RW 05",
  shippingMethod: "instant" // atau "pickup"
}
```

---

## ⚙️ Koordinat Toko

Koordinat toko sudah di-set di payment.blade.php:

```javascript
storeLat: -7.372085370419896,
storeLng: 109.24156771402993,
```

Jika perlu ubah, edit di bagian `paymentPage()` function.

---

## ✅ Selesai!

Sekarang baik halaman **checkout** maupun **payment** sudah menggunakan sistem dual marker yang sama! 🎉

---

**Tanggal: 4 Maret 2026**
