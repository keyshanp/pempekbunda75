# ✅ Fitur Pengurangan & Pengembalian Stok Otomatis

## 🎯 Fitur yang Sudah Ditambahkan:

Sistem sekarang akan **otomatis mengurangi stok produk** ketika ada order baru, dan **mengembalikan stok** jika order dibatalkan atau pembayaran gagal.

---

## 📋 Detail Implementasi:

### 1. Pengurangan Stok Saat Order Dibayar

**File:** `app/Observers/OrderObserver.php`
**Fungsi:** `updated()` - Event Observer

**Alur:**
1. ✅ **Admin Update Status** - Admin ubah status order menjadi "paid"
2. ✅ **Observer Deteksi** - OrderObserver mendeteksi perubahan status
3. ✅ **Kurangi Stok** - Otomatis kurangi stok produk sesuai quantity yang dipesan
4. ✅ **Log Activity** - Catat aktivitas pengurangan stok di log

**Contoh:**
```
Order PB20260304-0123 status: "pending" → "paid"
- Pempek Kapal Selam: 5 pcs (Stok: 100 → 95)
- Pempek Lenjer: 3 pcs (Stok: 50 → 47)
```

### 2. Validasi Stok Sebelum Order

**Fitur Baru:**
- Sistem akan cek stok sebelum proses order
- Jika stok tidak mencukupi, order akan ditolak
- User akan mendapat pesan error yang jelas

**Contoh Error:**
```json
{
  "success": false,
  "error": "Stok produk 'Pempek Kapal Selam' tidak mencukupi. Stok tersedia: 3"
}
```

### 3. Pengembalian Stok Saat Order Dibatalkan

**File:** `app/Observers/OrderObserver.php`
**Fungsi:** `updated()` - Event Observer

**Kondisi Pengembalian Stok:**
- ✅ **Order dibatalkan** (`status_pesanan` berubah ke `cancelled`)
- ✅ **Pembayaran gagal** (`status_pembayaran` berubah ke `gagal`)

**Alur:**
1. ✅ **Deteksi Perubahan Status** - Observer mendeteksi perubahan status order
2. ✅ **Kembalikan Stok** - Otomatis tambahkan kembali quantity yang dipesan ke stok produk
3. ✅ **Log Activity** - Catat aktivitas pengembalian stok di log

**Contoh:**
```
Order PB20260304-0123 dibatalkan:
- Pempek Kapal Selam: +5 (kembali ke stok)
- Pempek Lenjer: +3 (kembali ke stok)
```
**Fungsi:** `adminUpdateStatus()` dan `updateStatus()`

**Alur:**
1. ✅ Admin ubah status order menjadi "cancelled"
2. ✅ Sistem deteksi perubahan status
3. ✅ Sistem kembalikan stok produk sesuai quantity yang dipesan
4. ✅ Log activity pengembalian stok

**Contoh:**
```
Order dibatalkan:
- Pempek Kapal Selam: 5 pcs
- Pempek Lenjer: 3 pcs

Sistem akan:
- Kembalikan stok Pempek Kapal Selam: +5
- Kembalikan stok Pempek Lenjer: +3
```

---

## 🔄 Alur Lengkap:

### Scenario 1: Order Berhasil
```
1. User tambah produk ke cart
   - Pempek Kapal Selam (Stok: 100) → Tambah 5 ke cart

2. User checkout & konfirmasi order
   - Sistem validasi: Stok 100 >= 5? ✅ OK
   - Order dibuat dengan status "pending"
   - Stok TETAP: 100 (belum dikurangi)

3. Admin konfirmasi pembayaran
   - Status berubah: "pending" → "paid"
   - Stok dikurangi: 100 - 5 = 95 ✅

4. Order selesai
   - Status berubah: "paid" → "completed"
   - Stok tetap: 95 (tidak berubah)
```

### Scenario 2: Order Dibatalkan
```
1. User order 5 pcs (Stok: 100)
   - Order dibuat dengan status "pending"
   - Stok TETAP: 100 (belum dikurangi)

2. Admin batalkan order
   - Status berubah: "pending" → "cancelled"
   - Stok tetap: 100 (karena belum pernah dikurangi)
```

### Scenario 3: Order Dibayar Lalu Dibatalkan
```
1. User order 5 pcs (Stok: 100)
   - Order dibuat dengan status "pending"
   - Stok TETAP: 100

2. Admin konfirmasi pembayaran
   - Status: "pending" → "paid"
   - Stok dikurangi: 100 - 5 = 95 ✅

3. Admin batalkan order
   - Status: "paid" → "cancelled"
   - Stok dikembalikan: 95 + 5 = 100 ✅
```

---

## 🎮 Cara Test:

### Test 1: Pengurangan Stok Saat Dibayar
```bash
1. Buat order baru (status: pending)
   → Stok tetap: 100 (belum dikurangi)
2. Admin ubah status menjadi "paid"
   → Stok dikurangi: 100 - 5 = 95 ✅
```

### Test 2: Pengembalian Stok Saat Dibatalkan
```bash
1. Buat order & bayar (status: paid, stok: 95)
2. Admin ubah status menjadi "cancelled"
   → Stok dikembalikan: 95 + 5 = 100 ✅
```

### Test 3: Validasi Stok
```bash
1. Set stok produk menjadi 3 (via admin panel)
2. Coba order 5 pcs
3. Sistem akan tolak dengan error:
   "Stok produk tidak mencukupi. Stok tersedia: 3" ✅
```

---

## 📊 Status Order & Pengaruh ke Stok:

| Status Order | Status Pembayaran | Aksi Stok | Keterangan |
|--------------|-------------------|-----------|------------|
| **pending** | - | - | Order dibuat, stok belum dikurangi |
| **paid** | - | ✅ Dikurangi | Admin konfirmasi bayar, stok dikurangi |
| **processed** | - | - | Tidak ada perubahan stok |
| **shipped** | - | - | Tidak ada perubahan stok |
| **completed** | - | - | Tidak ada perubahan stok |
| **cancelled** | - | ✅ Dikembalikan | Stok dikembalikan saat order dibatalkan |
| - | **gagal** | ✅ Dikembalikan | Stok dikembalikan saat pembayaran gagal |

---

## 🔍 Monitoring & Logging:

Setiap perubahan stok akan dicatat di log Laravel:

**Lokasi Log:** `storage/logs/laravel.log`

**Contoh Log:**
```
[2019-03-04 10:30:15] local.INFO: Stok produk 'Pempek Kapal Selam' dikurangi 5. Stok sekarang: 95
[2019-03-04 11:45:22] local.INFO: Stok produk 'Pempek Kapal Selam' dikembalikan 5 via Observer. Stok sekarang: 100
```

**Cara Cek Log:**
```bash
# Lihat log terbaru
tail -f storage/logs/laravel.log

# Cari log stok
grep "Stok produk" storage/logs/laravel.log
```

---

## ⚠️ Catatan Penting:

### 1. Stok Dikurangi Saat Status Berubah ke "Paid"
- Bukan saat order dibuat (pending)
- Hanya saat admin konfirmasi pembayaran
- Ini mencegah stok berkurang untuk order yang belum dibayar

### 2. Validasi Stok
- Sistem akan cek stok sebelum proses order
- Jika stok tidak cukup, order akan ditolak
- User akan mendapat pesan error yang jelas

### 3. Pengembalian Stok
- Terjadi jika status order berubah ke "cancelled"
- Terjadi jika status pembayaran berubah ke "gagal"
- Jika order sudah "cancelled", tidak akan dikembalikan lagi
- Stok dikembalikan sesuai quantity yang dipesan

### 4. Race Condition
- Jika 2 user order produk yang sama secara bersamaan
- Sistem akan proses secara sequential
- User kedua mungkin mendapat error "stok tidak mencukupi"

---

## 🛠️ Troubleshooting:

### Stok tidak berkurang setelah order?
1. Cek log: `storage/logs/laravel.log`
2. Pastikan order berhasil dibuat (cek database)
3. Cek apakah ada error di log

### Stok tidak dikembalikan setelah cancel?
1. Cek log: `storage/logs/laravel.log`
2. Pastikan status berubah dari non-cancelled ke cancelled
3. Atau status pembayaran berubah ke "gagal"
4. Jika order sudah cancelled sebelumnya, stok tidak akan dikembalikan lagi

### Error "Stok tidak mencukupi" padahal stok masih ada?
1. Cek stok di database (tabel `produks`)
2. Mungkin ada order lain yang sedang diproses
3. Refresh halaman dan coba lagi

---

## 📞 Support:

Jika ada masalah:
1. Cek log: `storage/logs/laravel.log`
2. Screenshot error yang muncul
3. Tanyakan dengan detail error tersebut

---

## ✅ Summary:

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Pengurangan Stok Otomatis | ✅ Done | Saat order dibuat |
| Validasi Stok | ✅ Done | Sebelum proses order |
| Pengembalian Stok (Cancel) | ✅ Done | Saat order dibatalkan |
| Pengembalian Stok (Payment Failed) | ✅ Done | Saat pembayaran gagal |
| Logging | ✅ Done | Semua aktivitas tercatat |
| Error Handling | ✅ Done | Pesan error yang jelas |

Fitur pengurangan stok sudah lengkap dan siap digunakan! 🎉
