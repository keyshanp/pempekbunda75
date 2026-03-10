# 📊 Cara Menjalankan Seeder Transaksi

## ✅ Seeder yang Sudah Dibuat

1. **OrderSeeder** - Membuat 25 order sample dari customer
2. **TransaksiSeeder** - Membuat transaksi untuk setiap order

## 🚀 Cara Menjalankan

### Opsi 1: Jalankan Semua Seeder
```bash
php artisan db:seed
```

### Opsi 2: Jalankan Seeder Spesifik
```bash
# 1. Jalankan OrderSeeder dulu
php artisan db:seed --class=OrderSeeder

# 2. Lalu jalankan TransaksiSeeder
php artisan db:seed --class=TransaksiSeeder
```

### Opsi 3: Reset Database & Seed Ulang
```bash
php artisan migrate:fresh --seed
```

## 📋 Urutan Seeder (sudah dikonfigurasi di DatabaseSeeder)

1. KategoriSeeder
2. ProdukSeeder
3. AdminSeeder
4. UserSeeder
5. **OrderSeeder** ← Baru
6. **TransaksiSeeder** ← Baru
7. FeedbackSeeder

## 📊 Data yang Akan Dibuat

### Orders (25 data)
- Kode pesanan: PB + tanggal + nomor
- Customer dari user yang ada
- 1-5 produk per order
- Random shipping method
- Random status pesanan & pembayaran

### Transaksi (25 data)
- Kode transaksi: TRX + tanggal + nomor
- Metode pembayaran: cash, gopay, dana, ovo, shopeepay, qris, transfer_bank, kredit
- Status: 70% success, 20% pending, 8% failed, 2% expired
- Waktu pembayaran & konfirmasi (untuk success)
- Detail bank (untuk transfer_bank)

## 🎯 Lihat Hasil di Admin Panel

Setelah seeder berhasil:

1. Login ke admin: `http://localhost:8000/admin`
2. Klik menu **"Transaksi"**
3. Lihat widget **"Transaksi Terbaru"** di dashboard

## ✅ Verifikasi

```bash
# Cek jumlah orders
php artisan tinker --execute="echo 'Orders: ' . \App\Models\Order::count();"

# Cek jumlah transaksi
php artisan tinker --execute="echo 'Transaksi: ' . \App\Models\Transaksi::count();"
```
