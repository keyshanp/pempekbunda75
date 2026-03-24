# 🔐 Cara Fix Authentication GitHub - Step by Step

## 🎯 Masalah:
```
remote: Permission to keyshanp/pempekbunda75.git denied to cleyyrei.
fatal: unable to access 'https://github.com/keyshanp/pempekbunda75.git/': The requested URL returned error: 403
```

Windows menggunakan akun GitHub yang salah (cleyyrei bukan keyshanp).

---

## ✅ SOLUSI TERMUDAH - Hapus Kredensial Windows

### Step 1: Buka Credential Manager

**Cara 1 (Paling Cepat):**
1. Tekan **Windows + R** di keyboard
2. Ketik: `control /name Microsoft.CredentialManager`
3. Tekan **Enter**

**Cara 2 (Via Control Panel):**
1. Buka **Control Panel**
2. Cari **Credential Manager**
3. Klik **Credential Manager**

### Step 2: Hapus Kredensial GitHub

1. Klik **Windows Credentials** (tab kedua)
2. Scroll ke bawah, cari yang ada tulisan:
   - `git:https://github.com`
   - Atau `github.com`
3. Klik **▼** (panah ke bawah) untuk expand
4. Klik **Remove** (Hapus)
5. Konfirmasi **Yes**

**Screenshot lokasi:**
```
Windows Credentials
  ↓
Generic Credentials
  ↓
git:https://github.com  ← Hapus ini
```

### Step 3: Test Push Lagi

Buka PowerShell/Terminal di folder project, lalu:

```bash
git push origin main
```

Akan muncul **popup login GitHub**:
- Login dengan akun **keyshanp**
- Masukkan password atau Personal Access Token
- Centang "Remember me" (opsional)

### Step 4: Verify

Jika berhasil, akan muncul:
```
Enumerating objects: 250, done.
Counting objects: 100% (250/250), done.
...
To https://github.com/keyshanp/pempekbunda75.git
   436a3af..613ea07  main -> main
```

✅ **Berhasil!** Project sudah terupload ke GitHub.

---

## ✅ SOLUSI ALTERNATIF - Gunakan Personal Access Token

Jika cara di atas tidak berhasil, gunakan Personal Access Token:

### Step 1: Buat Personal Access Token

1. **Login ke GitHub** dengan akun **keyshanp**
   - Buka: https://github.com/login

2. **Buka Settings**
   - Klik foto profil (kanan atas)
   - Klik **Settings**

3. **Buka Developer Settings**
   - Scroll ke bawah
   - Klik **Developer settings** (paling bawah)

4. **Generate Token**
   - Klik **Personal access tokens**
   - Klik **Tokens (classic)**
   - Klik **Generate new token**
   - Klik **Generate new token (classic)**

5. **Isi Form:**
   - **Note**: `Pempek Bunda 75`
   - **Expiration**: `90 days` (atau `No expiration`)
   - **Select scopes**: Centang **repo** (semua checkbox di bawahnya akan otomatis tercentang)

6. **Generate**
   - Klik **Generate token** (tombol hijau di bawah)
   - **COPY TOKEN** yang muncul (contoh: `ghp_xxxxxxxxxxxxxxxxxxxx`)
   - ⚠️ **PENTING**: Token hanya muncul sekali! Simpan di tempat aman.

**Direct Link:**
```
https://github.com/settings/tokens/new
```

### Step 2: Update Git Remote dengan Token

Di PowerShell/Terminal, jalankan:

```bash
# Format: https://TOKEN@github.com/username/repo.git
git remote set-url origin https://ghp_TOKENMU@github.com/keyshanp/pempekbunda75.git
```

**Ganti `ghp_TOKENMU` dengan token yang kamu copy.**

Contoh:
```bash
git remote set-url origin https://ghp_1234567890abcdefghijklmnopqrstuvwxyz@github.com/keyshanp/pempekbunda75.git
```

### Step 3: Push

```bash
git push origin main
```

Sekarang akan langsung push tanpa diminta login! ✅

---

## 🔍 Cara Cek Apakah Sudah Berhasil

### 1. Cek di Terminal
Setelah push berhasil, akan muncul:
```
To https://github.com/keyshanp/pempekbunda75.git
   436a3af..613ea07  main -> main
Branch 'main' set up to track remote branch 'main' from 'origin'.
```

### 2. Cek di Browser
Buka:
```
https://github.com/keyshanp/pempekbunda75
```

Kamu akan lihat:
- ✅ Commit terbaru: "Save local changes"
- ✅ File-file baru yang kamu tambahkan
- ✅ Tanggal commit terbaru

### 3. Cek di Git
```bash
git status
```

Output:
```
On branch main
Your branch is up to date with 'origin/main'.
nothing to commit, working tree clean
```

✅ Artinya sudah sync dengan GitHub!

---

## 📋 Checklist - Ikuti Urutan Ini:

- [ ] **Step 1**: Buka Credential Manager (Windows + R → `control /name Microsoft.CredentialManager`)
- [ ] **Step 2**: Hapus kredensial `git:https://github.com`
- [ ] **Step 3**: Jalankan `git push origin main`
- [ ] **Step 4**: Login dengan akun **keyshanp** saat popup muncul
- [ ] **Step 5**: Verify di browser: https://github.com/keyshanp/pempekbunda75
- [ ] **Step 6**: Cek `git status` untuk konfirmasi

**Jika gagal:**
- [ ] **Plan B**: Buat Personal Access Token di GitHub
- [ ] **Plan B**: Update remote: `git remote set-url origin https://TOKEN@github.com/keyshanp/pempekbunda75.git`
- [ ] **Plan B**: Push lagi: `git push origin main`

---

## 🚨 Troubleshooting

### Error: "fatal: Authentication failed"
**Solusi**: Gunakan Personal Access Token (Plan B di atas)

### Error: "fatal: unable to access"
**Solusi**: 
1. Cek koneksi internet
2. Cek apakah GitHub down: https://www.githubstatus.com
3. Gunakan Personal Access Token

### Error: "Updates were rejected"
**Solusi**:
```bash
git pull --rebase origin main
git push origin main
```

### Token Hilang/Lupa
**Solusi**: Buat token baru di GitHub settings, lalu update remote lagi

---

## 💡 Tips Keamanan Token

1. **Jangan share token** ke orang lain
2. **Simpan di tempat aman** (password manager)
3. **Gunakan expiration** (90 days recommended)
4. **Revoke token lama** jika tidak dipakai
5. **Buat token baru** jika token bocor

---

## 🎯 Setelah Berhasil Push

### File yang Akan Terupload:
- ✅ Semua code Laravel
- ✅ Dokumentasi (.md files)
- ✅ Database migrations
- ✅ Seeders
- ✅ Views (Blade templates)
- ✅ Controllers
- ✅ Models
- ✅ Config files

### File yang TIDAK Terupload (karena .gitignore):
- ❌ `/vendor` (Composer dependencies)
- ❌ `/node_modules` (NPM dependencies)
- ❌ `.env` (Environment variables)
- ❌ `/storage` (Cache, logs, sessions)

---

## 📱 Cara Clone di Komputer Lain

Setelah push berhasil, kamu bisa clone di komputer lain:

```bash
# Clone repository
git clone https://github.com/keyshanp/pempekbunda75.git

# Masuk ke folder
cd pempekbunda75

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Migrate database
php artisan migrate

# Run server
php artisan serve
```

---

## ✅ Summary

**Cara Tercepat:**
1. Hapus kredensial Windows (Credential Manager)
2. Push lagi (`git push origin main`)
3. Login dengan akun keyshanp
4. Done! ✅

**Cara Alternatif:**
1. Buat Personal Access Token di GitHub
2. Update remote dengan token
3. Push (`git push origin main`)
4. Done! ✅

---

**Repository Kamu:**
```
https://github.com/keyshanp/pempekbunda75
```

**Need Help?**
- GitHub Docs: https://docs.github.com/en/authentication
- Token Guide: https://docs.github.com/en/authentication/keeping-your-account-and-data-secure/creating-a-personal-access-token

---

**Selamat mencoba!** 🚀

Jika masih ada error, screenshot error-nya dan saya akan bantu troubleshoot.
