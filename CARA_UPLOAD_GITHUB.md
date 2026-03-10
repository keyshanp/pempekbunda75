# 🚀 Cara Upload Project ke GitHub

## 📋 Persiapan:

### 1. Buat Akun GitHub (Jika Belum Punya)
- Buka: https://github.com
- Klik "Sign up"
- Isi email, password, username
- Verifikasi email

### 2. Install Git (Jika Belum Ada)
- Download: https://git-scm.com/download/win
- Install dengan setting default
- Restart terminal/PowerShell

---

## 🎯 Langkah-Langkah Upload:

### Step 1: Cek Apakah Git Sudah Terinstall
```bash
git --version
```

Jika muncul versi (contoh: `git version 2.40.0`), berarti sudah terinstall ✅

### Step 2: Konfigurasi Git (Pertama Kali)
```bash
git config --global user.name "Nama Kamu"
git config --global user.email "email@kamu.com"
```

Ganti dengan nama dan email GitHub kamu.

### Step 3: Buat Repository Baru di GitHub

1. Login ke GitHub
2. Klik tombol **"+"** di kanan atas → **"New repository"**
3. Isi:
   - **Repository name**: `pempekbunda75` (atau nama lain)
   - **Description**: "Website Pempek Bunda 75 - Laravel"
   - **Public** atau **Private** (pilih sesuai kebutuhan)
   - **JANGAN** centang "Add a README file"
4. Klik **"Create repository"**

### Step 4: Inisialisasi Git di Project

Buka PowerShell/Terminal di folder project, lalu jalankan:

```bash
# Masuk ke folder project
cd "C:\Users\keand\OneDrive\Desktop\Sekolah\Kelas 12\pempekbunda75"

# Inisialisasi git
git init
```

### Step 5: Tambahkan File ke Git

```bash
# Tambahkan semua file
git add .

# Atau tambahkan file tertentu saja
git add app/
git add resources/
git add database/
```

### Step 6: Commit Perubahan

```bash
git commit -m "Initial commit - Pempek Bunda 75 website"
```

### Step 7: Hubungkan ke GitHub Repository

```bash
# Ganti URL dengan repository kamu
git remote add origin https://github.com/username-kamu/pempekbunda75.git

# Cek apakah sudah terhubung
git remote -v
```

### Step 8: Push ke GitHub

```bash
# Push ke branch main
git push -u origin main

# Atau jika branch-nya master
git push -u origin master
```

Jika diminta login:
- Username: username GitHub kamu
- Password: **Personal Access Token** (bukan password biasa)

---

## 🔑 Cara Buat Personal Access Token:

Jika diminta password saat push, kamu perlu Personal Access Token:

1. Buka GitHub → **Settings** (klik foto profil)
2. Scroll ke bawah → **Developer settings**
3. **Personal access tokens** → **Tokens (classic)**
4. **Generate new token** → **Generate new token (classic)**
5. Isi:
   - **Note**: "Pempek Bunda 75"
   - **Expiration**: 90 days (atau No expiration)
   - **Select scopes**: Centang **repo** (semua)
6. Klik **Generate token**
7. **COPY TOKEN** (hanya muncul sekali!)
8. Gunakan token ini sebagai password saat push

---

## 📝 File yang TIDAK Perlu Di-Upload:

Buat file `.gitignore` untuk exclude file yang tidak perlu:

```bash
# Buat file .gitignore
notepad .gitignore
```

Isi dengan:

```
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/.idea
/.vscode
```

Lalu commit lagi:

```bash
git add .gitignore
git commit -m "Add .gitignore"
git push
```

---

## 🔄 Update Project di GitHub (Setelah Ada Perubahan):

Setiap kali ada perubahan code:

```bash
# 1. Tambahkan file yang berubah
git add .

# 2. Commit dengan pesan
git commit -m "Deskripsi perubahan"

# 3. Push ke GitHub
git push
```

---

## 🐛 Troubleshooting:

### Error: "fatal: not a git repository"
**Solusi**: Jalankan `git init` dulu

### Error: "failed to push some refs"
**Solusi**: 
```bash
git pull origin main --rebase
git push origin main
```

### Error: "remote origin already exists"
**Solusi**:
```bash
git remote remove origin
git remote add origin https://github.com/username/repo.git
```

### Error: Authentication failed
**Solusi**: Gunakan Personal Access Token, bukan password

### Error: "src refspec main does not match any"
**Solusi**: Branch mungkin bernama `master`, bukan `main`
```bash
git branch -M main
git push -u origin main
```

---

## 📱 Cara Clone Project (Download dari GitHub):

Jika mau download project di komputer lain:

```bash
# Clone repository
git clone https://github.com/username/pempekbunda75.git

# Masuk ke folder
cd pempekbunda75

# Install dependencies
composer install
npm install

# Copy .env
cp .env.example .env

# Generate key
php artisan key:generate

# Migrate database
php artisan migrate

# Run server
php artisan serve
```

---

## 💡 Tips:

### 1. Commit Sering
Jangan tunggu banyak perubahan, commit setiap fitur selesai.

### 2. Pesan Commit yang Jelas
```bash
# ❌ Bad
git commit -m "update"

# ✅ Good
git commit -m "Add auto-create transaksi feature"
```

### 3. Gunakan Branch untuk Fitur Baru
```bash
# Buat branch baru
git checkout -b feature-responsive-mobile

# Setelah selesai, merge ke main
git checkout main
git merge feature-responsive-mobile
```

### 4. Backup .env
File `.env` tidak di-upload ke GitHub (karena ada di `.gitignore`).
Backup manual atau simpan di tempat aman.

---

## 🎯 Quick Commands:

```bash
# Status file yang berubah
git status

# Lihat history commit
git log

# Lihat perubahan file
git diff

# Undo perubahan (belum commit)
git checkout -- filename

# Undo commit terakhir (keep changes)
git reset --soft HEAD~1

# Undo commit terakhir (discard changes)
git reset --hard HEAD~1
```

---

## ✅ Checklist Upload:

- [ ] Git sudah terinstall
- [ ] Akun GitHub sudah dibuat
- [ ] Repository GitHub sudah dibuat
- [ ] Git config sudah diset (name & email)
- [ ] File `.gitignore` sudah dibuat
- [ ] `git init` sudah dijalankan
- [ ] `git add .` sudah dijalankan
- [ ] `git commit` sudah dijalankan
- [ ] `git remote add origin` sudah dijalankan
- [ ] `git push` berhasil
- [ ] Project muncul di GitHub ✅

---

Selamat! Project kamu sudah di GitHub! 🎉
