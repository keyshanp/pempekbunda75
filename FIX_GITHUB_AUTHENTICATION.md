# 🔐 Fix GitHub Authentication Error

## ❌ Error yang Terjadi:
```
remote: Permission to keyshanp/pempekbunda75.git denied to cleyyrei.
fatal: unable to access 'https://github.com/keyshanp/pempekbunda75.git/': The requested URL returned error: 403
```

## 🔍 Penyebab:
Windows menyimpan kredensial GitHub yang salah (akun `cleyyrei` bukan `keyshanp`).

---

## ✅ Solusi 1: Hapus Kredensial Lama (Recommended)

### Step 1: Buka Windows Credential Manager
1. Tekan **Windows + R**
2. Ketik: `control /name Microsoft.CredentialManager`
3. Tekan **Enter**

### Step 2: Hapus Kredensial GitHub
1. Klik **Windows Credentials** (Kredensial Windows)
2. Scroll ke bawah, cari yang ada tulisan **git:https://github.com**
3. Klik **Remove** (Hapus)

### Step 3: Push Lagi
```bash
git push
```

Nanti akan muncul popup login GitHub. Login dengan akun **keyshanp**.

---

## ✅ Solusi 2: Gunakan Personal Access Token

### Step 1: Buat Personal Access Token di GitHub

1. Login ke GitHub dengan akun **keyshanp**
2. Klik foto profil (kanan atas) → **Settings**
3. Scroll ke bawah → **Developer settings**
4. **Personal access tokens** → **Tokens (classic)**
5. **Generate new token** → **Generate new token (classic)**
6. Isi form:
   - **Note**: `PempekBunda 75`
   - **Expiration**: `90 days` (atau `No expiration`)
   - **Select scopes**: Centang **repo** (semua checkbox di bawahnya)
7. Klik **Generate token**
8. **COPY TOKEN** (hanya muncul sekali!)

Contoh token: `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx`

### Step 2: Update Remote URL dengan Token

```bash
# Format: https://TOKEN@github.com/username/repo.git
git remote set-url origin https://ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx@github.com/keyshanp/pempekbunda75.git
```

Ganti `ghp_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` dengan token yang kamu copy.

### Step 3: Push
```bash
git push
```

---

## ✅ Solusi 3: Push dengan Username & Token Manual

Jika solusi 1 & 2 tidak berhasil, gunakan cara ini:

```bash
git push https://keyshanp:TOKEN@github.com/keyshanp/pempekbunda75.git
```

Ganti `TOKEN` dengan Personal Access Token kamu.

---

## 🔄 Cara Ganti Akun GitHub di Git

Jika kamu mau ganti akun GitHub yang digunakan:

```bash
# Cek config sekarang
git config --global user.name
git config --global user.email

# Ganti dengan akun keyshanp
git config --global user.name "keyshanp"
git config --global user.email "email-keyshanp@example.com"
```

---

## 📝 Catatan Penting:

1. **Personal Access Token** adalah password pengganti untuk Git
2. Token hanya muncul **sekali** saat dibuat, jadi **COPY dan SIMPAN**
3. Jangan share token ke orang lain
4. Jika token hilang, buat token baru
5. Token bisa di-revoke (hapus) kapan saja di GitHub settings

---

## 🚀 Setelah Berhasil Push:

Cek di GitHub apakah project sudah terupload:
```
https://github.com/keyshanp/pempekbunda75
```

Kamu akan lihat semua file dan commit terbaru! 🎉

---

## 🆘 Jika Masih Error:

1. Pastikan akun GitHub yang login adalah **keyshanp**
2. Pastikan repository **pempekbunda75** ada di akun keyshanp
3. Pastikan token punya permission **repo** (full control)
4. Coba logout dari GitHub di browser, lalu login lagi dengan akun yang benar

---

**Pilih solusi mana yang mau dicoba?**
- Solusi 1: Paling mudah (hapus kredensial lama)
- Solusi 2: Paling aman (pakai token)
- Solusi 3: Quick fix (push manual dengan token)

