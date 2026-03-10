# ✅ Fitur Pengurangan Stok Otomatis

## 🎯 Fitur yang Sudah Ditambahkan:

Sistem sekarang akan **otomatis mengurangi stok produk** ketika ada order baru, dan **mengembalikan stok** jika order dibatalkan.

---

## 📋 Detail Implementasi:

### 1. Pengurangan Stok Saat Order Dibuat

**File:** `app/Http/Controllers/OrderController.php`
**Fungsi:** `process()`

**Alur:**
1. ✅ **Validasi Stok** - Cek apakah stok mencukupi sebelum proses order
2. ✅ **Buat Order** - Simpan order ke database
3. ✅ **Kurangi Stok** - Otomatis kurangi stok produk sesuai quantity yang dipesan
4. ✅ **Log Activity** - Catat aktivitas pengurangan stok di log

**Contoh:**
```
User order:
- Pempek Kapal Selam: 5 pcs
- Pempek Lenjer: 3 pcs

Sistem akan:
- Kurangi stok Pempek Kapal Selam: -5
- Kurangi stok Pempek Lenjer: -3
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

**File:** `app/Http/Controllers/OrderController.php`
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
   - Stok dikurangi: 100 - 5 = 95 ✅

3. Admin konfirmasi pembayaran
   - Status berubah: "pending" → "paid"
   - Stok tetap: 95 (tidak berubah)

4. Order selesai
   - Status berubah: "paid" → "completed"
   - Stok tetap: 95 (tidak berubah)
```

### Scenario 2: Order Dibatalkan
```
1. User order 5 pcs (Stok: 100)
   - Order dibuat
   - Stok dikurangi: 100 - 5 = 95 ✅

2. Admin batalkan order
   - Status berubah: "pending" → "cancelled"
   - Stok dikembalikan: 95 + 5 = 100 ✅
```

### Scenario 3: Stok Tidak Mencukupi
```
1. User order 10 pcs (Stok: 5)
   - Sistem validasi: Stok 5 >= 10? ❌ GAGAL
   - Order ditolak
   - Error: "Stok produk tidak mencukupi. Stok tersedia: 5"
   - Stok tetap: 5 (tidak berubah)
```

---

## 🎮 Cara Test:

### Test 1: Pengurangan Stok
```bash
1. Login sebagai customer
2. Cek stok produk di halaman order (misal: Pempek Kapal Selam = 100)
3. Tambah produk ke cart (quantity: 5)
4. Checkout & konfirmasi order
5. Cek database atau admin panel
   → Stok sekarang: 95 ✅
```

### Test 2: Validasi Stok
```bash
1. Set stok produk menjadi 3 (via admin panel)
2. Coba order 5 pcs
3. Sistem akan tolak dengan error:
   "Stok produk tidak mencukupi. Stok tersedia: 3" ✅
```

### Test 3: Pengembalian Stok
```bash
1. Buat order (5 pcs, stok awal: 100)
   → Stok sekarang: 95
2. Login sebagai admin
3. Buka order tersebut
4. Ubah status menjadi "cancelled"
5. Cek stok produk
   → Stok kembali: 100 ✅
```

---

## 📊 Status Order & Pengaruh ke Stok:

| Status Order | Aksi Stok | Keterangan |
|--------------|-----------|------------|
| **pending** | ✅ Dikurangi | Stok dikurangi saat order dibuat |
| **paid** | - | Tidak ada perubahan stok |
| **processed** | - | Tidak ada perubahan stok |
| **shipped** | - | Tidak ada perubahan stok |
| **completed** | - | Tidak ada perubahan stok |
| **cancelled** | ✅ Dikembalikan | Stok dikembalikan saat order dibatalkan |

---

## 🔍 Monitoring & Logging:

Setiap perubahan stok akan dicatat di log Laravel:

**Lokasi Log:** `storage/logs/laravel.log`

**Contoh Log:**
```
[2026-03-04 10:30:15] local.INFO: Stok produk 'Pempek Kapal Selam' dikurangi 5. Stok sekarang: 95
[2026-03-04 11:45:22] local.INFO: Stok produk 'Pempek Kapal Selam' dikembalikan 5. Stok sekarang: 100
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

### 1. Stok Dikurangi Saat Order Dibuat (Status: pending)
- Bukan saat pembayaran dikonfirmasi
- Ini untuk mencegah overselling
- Jika order dibatalkan, stok akan dikembalikan

### 2. Validasi Stok
- Sistem akan cek stok sebelum proses order
- Jika stok tidak cukup, order akan ditolak
- User akan mendapat pesan error yang jelas

### 3. Pengembalian Stok
- Hanya terjadi jika status berubah ke "cancelled"
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
3. Jika order sudah cancelled sebelumnya, stok tidak akan dikembalikan lagi

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
| Pengembalian Stok | ✅ Done | Saat order dibatalkan |
| Logging | ✅ Done | Semua aktivitas tercatat |
| Error Handling | ✅ Done | Pesan error yang jelas |

Fitur pengurangan stok sudah lengkap dan siap digunakan! 🎉
