# ⏱️ Sistem Timer Invoice - Dokumentasi

## ✅ Fitur yang Sudah Dibuat

### 1. Timer Countdown Otomatis
- **Timer berjalan** saat status: `pending` (belum bayar)
- **Timer berhenti** saat status: `paid`, `processed`, `shipped`, `completed`
- Format: `HH:MM:SS` (jam:menit:detik)

### 2. Status-Based Timer Control
```
Status Pesanan:
├── pending     → Timer BERJALAN ⏱️
├── paid        → Timer BERHENTI ✓ (Pembayaran Dikonfirmasi)
├── processed   → Timer BERHENTI ✓
├── shipped     → Timer BERHENTI ✓
└── completed   → Timer BERHENTI ✓ + AUTO LOGOUT
```

### 3. Auto Logout saat Completed
- Saat status = `completed`
- Notifikasi muncul: "Pesanan Selesai!"
- Countdown 10 detik
- Auto logout
- Redirect ke homepage (`/`)

---

## 🎯 Cara Kerja

### Timer Countdown

**Status: PENDING (Belum Bayar)**
```
Timer menghitung mundur dari batas pembayaran
Contoh: 23:45:12 → 23:45:11 → 23:45:10 ...
```

**Status: PAID / PROCESSED / SHIPPED (Sudah Bayar)**
```
Timer berhenti dan menampilkan:
✓ Pembayaran Dikonfirmasi
```

**Status: COMPLETED (Selesai)**
```
1. Timer berhenti
2. Notifikasi muncul (pojok kanan atas)
3. Countdown logout: 10... 9... 8...
4. Auto logout setelah 10 detik
5. Redirect ke homepage
```

---

## 📊 Flow Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                    INVOICE PAGE                              │
└─────────────────────────────────────────────────────────────┘
                            │
                            ▼
                ┌───────────────────────┐
                │  Cek Status Pesanan   │
                └───────────────────────┘
                            │
        ┌───────────────────┼───────────────────┐
        │                   │                   │
        ▼                   ▼                   ▼
   ┌─────────┐        ┌─────────┐        ┌──────────┐
   │ PENDING │        │  PAID   │        │COMPLETED │
   └─────────┘        └─────────┘        └──────────┘
        │                   │                   │
        ▼                   ▼                   ▼
  ┌──────────┐      ┌──────────────┐    ┌──────────────┐
  │Timer ON  │      │  Timer STOP  │    │  Timer STOP  │
  │⏱️ Running│      │✓ Dikonfirmasi│    │✓ Dikonfirmasi│
  └──────────┘      └──────────────┘    └──────────────┘
                                               │
                                               ▼
                                      ┌─────────────────┐
                                      │ Notifikasi      │
                                      │ "Pesanan Selesai"│
                                      └─────────────────┘
                                               │
                                               ▼
                                      ┌─────────────────┐
                                      │ Countdown 10s   │
                                      │ 10...9...8...   │
                                      └─────────────────┘
                                               │
                                               ▼
                                      ┌─────────────────┐
                                      │  AUTO LOGOUT    │
                                      │  Redirect to /  │
                                      └─────────────────┘
```

---

## 💻 Kode yang Ditambahkan

### JavaScript Logic

```javascript
// Status pesanan dari server
const orderStatus = '{{ $statusPesanan }}';

// Status yang menghentikan timer
const stopTimerStatuses = ['paid', 'processed', 'shipped', 'completed'];
const shouldStopTimer = stopTimerStatuses.includes(orderStatus);

// Timer berhenti jika status sudah dibayar
if (shouldStopTimer) {
    countdownEl.innerHTML = '✓ Pembayaran Dikonfirmasi';
    return;
}

// Auto logout saat completed
if (orderStatus === 'completed') {
    // Countdown 10 detik
    // Logout & redirect
}
```

---

## 🎨 Tampilan UI

### Timer Berjalan (Pending)
```
┌─────────────────────────────────────┐
│  Batas Pembayaran                   │
│  ⏱️ 23:45:12                        │
│  (countdown berjalan setiap detik)  │
└─────────────────────────────────────┘
```

### Timer Berhenti (Paid/Processed/Shipped)
```
┌─────────────────────────────────────┐
│  Status Pembayaran                  │
│  ✓ Pembayaran Dikonfirmasi          │
│  (timer berhenti, warna hijau)      │
└─────────────────────────────────────┘
```

### Notifikasi Auto Logout (Completed)
```
┌─────────────────────────────────────┐
│  🎉 Pesanan Selesai!                │
│  Anda akan logout dalam 10 detik... │
│  (notifikasi hijau, pojok kanan)    │
└─────────────────────────────────────┘
```

---

## 🔧 Testing

### Test Timer Berhenti

1. **Buat order baru** (status: pending)
2. **Buka invoice** → Timer berjalan ⏱️
3. **Admin ubah status** ke "paid"
4. **Refresh invoice** → Timer berhenti ✓

### Test Auto Logout

1. **Buat order** dan bayar
2. **Admin ubah status** ke "completed"
3. **Buka invoice**
4. **Verifikasi:**
   - ✅ Timer berhenti
   - ✅ Notifikasi muncul
   - ✅ Countdown 10 detik
   - ✅ Auto logout
   - ✅ Redirect ke `/`

---

## 📝 Catatan Penting

### 1. Status Mapping
```php
'pending'    => Belum bayar (timer ON)
'paid'       => Sudah bayar (timer OFF)
'processed'  => Diproses (timer OFF)
'shipped'    => Dikirim (timer OFF)
'completed'  => Selesai (timer OFF + auto logout)
```

### 2. Keamanan
- ✅ CSRF token untuk logout
- ✅ Fetch API dengan error handling
- ✅ Fallback redirect jika fetch gagal

### 3. User Experience
- Notifikasi jelas dan informatif
- Countdown memberikan waktu untuk membaca
- Auto redirect tanpa perlu klik

---

## 🐛 Troubleshooting

### Timer tidak berhenti?
- Cek status pesanan di database
- Pastikan status = 'paid', 'processed', 'shipped', atau 'completed'
- Clear cache browser

### Auto logout tidak jalan?
- Cek console browser untuk error
- Pastikan route logout ada: `POST /logout`
- Cek CSRF token

### Redirect tidak ke homepage?
- Cek route '/' ada
- Cek console untuk error fetch

---

## ✅ Checklist

- [x] Timer countdown berjalan saat pending
- [x] Timer berhenti saat paid/processed/shipped/completed
- [x] Tampilan "✓ Pembayaran Dikonfirmasi" saat timer berhenti
- [x] Notifikasi muncul saat status completed
- [x] Countdown 10 detik untuk logout
- [x] Auto logout dengan CSRF protection
- [x] Redirect ke homepage setelah logout
- [x] Error handling untuk fetch API

---

## 🎉 Selesai!

Sistem timer invoice dengan auto logout sudah siap digunakan!
