# 🧪 Cara Test Auto Create Transaksi

## ✅ Fitur Sudah Aktif!

Sistem sudah diupdate untuk otomatis membuat transaksi ketika order status diubah menjadi "completed".

---

## 📋 Langkah Testing:

### Test 1: Via Edit Order (Filament Admin Panel)

1. **Login sebagai admin**
   - Buka: `http://127.0.0.1:8000/admin/login`
   - Login dengan akun admin

2. **Buka halaman Orders**
   - Klik menu "Pesanan" atau "Orders" di sidebar
   - Atau buka: `http://127.0.0.1:8000/admin/orders`

3. **Edit order yang statusnya belum "completed"**
   - Pilih order dengan status "paid", "processed", atau "shipped"
   - Klik tombol "Update Status" (icon pensil)

4. **Ubah status menjadi "completed"**
   - Pilih "Status Pesanan" → "Selesai" (completed)
   - Klik "Save" atau "Simpan"

5. **Cek notifikasi**
   - Seharusnya muncul notifikasi:
     - "Pesanan berhasil diperbarui"
     - "Transaksi TRX-XXXXXXXX berhasil dibuat otomatis"

6. **Verifikasi di Laporan Transaksi**
   - Klik menu "Laporan Transaksi" atau "Transaksi"
   - Atau buka: `http://127.0.0.1:8000/admin/transaksis`
   - Transaksi baru seharusnya muncul di list

---

### Test 2: Via Bulk Action (Update Multiple Orders)

1. **Buka halaman Orders**
   - `http://127.0.0.1:8000/admin/orders`

2. **Pilih beberapa order**
   - Centang checkbox di beberapa order yang statusnya belum "completed"

3. **Klik "Ubah Status" (Bulk Action)**
   - Pilih "Status Pesanan" → "Selesai"
   - Klik "Submit"

4. **Cek Laporan Transaksi**
   - Semua order yang diubah seharusnya punya transaksi baru

---

### Test 3: Cek Detail Transaksi

1. **Buka transaksi yang baru dibuat**
   - Klik salah satu transaksi di list

2. **Verifikasi data:**
   - ✅ Kode Transaksi: Format `TRX-YYYYMMDD-XXXX`
   - ✅ Pesanan ID: Sesuai dengan order
   - ✅ Metode Pembayaran: Sesuai dengan order (QRIS, Transfer, dll)
   - ✅ Jumlah Bayar: Sesuai dengan total order
   - ✅ Status: "success"
   - ✅ Catatan: "Transaksi otomatis dari order completed"

---

## 🔍 Troubleshooting:

### Masalah: Transaksi tidak dibuat

**Cek 1: Log Laravel**
```bash
# Buka file log
notepad storage/logs/laravel.log

# Atau lihat 20 baris terakhir
tail -n 20 storage/logs/laravel.log
```

Cari pesan error atau log seperti:
- `Transaksi TRX-XXXX dibuat otomatis untuk order PB-XXXX`
- Error message jika ada masalah

**Cek 2: Database**
```sql
-- Cek apakah transaksi ada di database
SELECT * FROM transaksis ORDER BY created_at DESC LIMIT 5;

-- Cek relasi order
SELECT t.*, o.kode_pesanan 
FROM transaksis t 
JOIN orders o ON t.pesanan_id = o.id 
ORDER BY t.created_at DESC LIMIT 5;
```

**Cek 3: Browser Console**
- Buka Developer Tools (F12)
- Lihat tab "Console" untuk error JavaScript
- Lihat tab "Network" untuk error HTTP

---

### Masalah: Transaksi duplikat

Sistem sudah ada proteksi duplikat. Jika tetap terjadi:

1. **Cek database:**
```sql
-- Cari transaksi duplikat
SELECT pesanan_id, COUNT(*) as jumlah 
FROM transaksis 
GROUP BY pesanan_id 
HAVING COUNT(*) > 1;
```

2. **Hapus duplikat manual:**
```sql
-- Hapus transaksi duplikat (keep yang pertama)
DELETE t1 FROM transaksis t1
INNER JOIN transaksis t2 
WHERE t1.id > t2.id 
AND t1.pesanan_id = t2.pesanan_id;
```

---

### Masalah: Error "pesanan_id constraint"

Ini berarti foreign key constraint error. Solusi:

1. **Cek migration sudah jalan:**
```bash
php artisan migrate:status
```

2. **Jika belum, jalankan migration:**
```bash
php artisan migrate
```

3. **Jika masih error, cek foreign key:**
```sql
-- Cek foreign key di tabel transaksis
SHOW CREATE TABLE transaksis;
```

---

## 📊 Expected Results:

### Setelah ubah status ke "completed":

| Item | Expected Value |
|------|----------------|
| Notifikasi | "Transaksi TRX-XXXX berhasil dibuat otomatis" |
| Transaksi di database | 1 record baru |
| Kode transaksi | TRX-20260305-XXXX |
| Status transaksi | success |
| Jumlah bayar | Sama dengan total order |
| Metode pembayaran | Sama dengan order |
| Log file | Ada log "Transaksi ... dibuat otomatis" |

---

## 🎯 Quick Test Command:

Jika ingin test cepat via Tinker:

```bash
php artisan tinker
```

```php
// Ambil order pertama yang belum completed
$order = \App\Models\Order::where('status_pesanan', '!=', 'completed')->first();

// Ubah status ke completed
$order->status_pesanan = 'completed';
$order->save();

// Cek apakah transaksi dibuat
$transaksi = \App\Models\Transaksi::where('pesanan_id', $order->id)->first();
dd($transaksi); // Seharusnya ada data
```

---

## ✅ Checklist Testing:

- [ ] Login sebagai admin berhasil
- [ ] Bisa buka halaman Orders
- [ ] Bisa edit order dan ubah status ke "completed"
- [ ] Muncul notifikasi sukses
- [ ] Transaksi muncul di "Laporan Transaksi"
- [ ] Detail transaksi sesuai dengan order
- [ ] Tidak ada transaksi duplikat
- [ ] Log file mencatat aktivitas
- [ ] Bulk action juga berfungsi

---

Jika semua checklist ✅, berarti fitur auto create transaksi sudah berfungsi dengan baik! 🎉
