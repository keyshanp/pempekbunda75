# 📥 Cara Pull dari GitHub

## 🎯 Apa itu Git Pull?

**Git Pull** = Download perubahan terbaru dari GitHub ke komputer lokal kamu.

Gunakan ketika:
- Ada perubahan di GitHub yang belum ada di komputer kamu
- Kerja tim (orang lain push perubahan)
- Kamu edit di GitHub web, mau sync ke lokal
- Pindah komputer, mau sync project

---

## 🚀 Cara Pull - Basic

### 1. Pull dari Branch Main (Paling Umum)

```bash
# Masuk ke folder project
cd "C:\Users\keand\OneDrive\Desktop\Sekolah\Kelas 12\pempekbunda75"

# Pull perubahan terbaru
git pull origin main
```

### 2. Pull dengan Rebase (Lebih Bersih)

```bash
git pull --rebase origin main
```

### 3. Pull Semua Branch

```bash
git pull --all
```

---

## 📋 Step-by-Step Pull

### Step 1: Cek Status Lokal

```bash
# Cek apakah ada perubahan yang belum di-commit
git status
```

**Jika ada perubahan:**
```bash
# Commit dulu perubahan lokal
git add .
git commit -m "Save local changes"
```

### Step 2: Cek Remote

```bash
# Lihat remote yang terhubung
git remote -v
```

Output seharusnya:
```
origin  https://github.com/keyshanp/pempekbunda75.git (fetch)
origin  https://github.com/keyshanp/pempekbunda75.git (push)
```

### Step 3: Fetch (Cek Perubahan Tanpa Merge)

```bash
# Download info perubahan tanpa merge
git fetch origin
```

### Step 4: Lihat Perbedaan

```bash
# Lihat apa yang berubah
git log HEAD..origin/main --oneline
```

### Step 5: Pull (Download & Merge)

```bash
# Pull perubahan
git pull origin main
```

---

## 🔄 Skenario Pull

### Skenario 1: Pull Biasa (Tidak Ada Konflik)

```bash
git pull origin main
```

Output:
```
Updating abc1234..def5678
Fast-forward
 file1.php | 10 +++++-----
 file2.php | 5 +++--
 2 files changed, 8 insertions(+), 7 deletions(-)
```

✅ Berhasil! File otomatis ter-update.

---

### Skenario 2: Ada Perubahan Lokal (Belum Commit)

```bash
git pull origin main
```

Output:
```
error: Your local changes to the following files would be overwritten by merge:
    file.php
Please commit your changes or stash them before you merge.
```

**Solusi A: Commit Dulu**
```bash
git add .
git commit -m "Save local changes"
git pull origin main
```

**Solusi B: Stash (Simpan Sementara)**
```bash
# Simpan perubahan lokal
git stash

# Pull
git pull origin main

# Kembalikan perubahan lokal
git stash pop
```

---

### Skenario 3: Ada Konflik (Merge Conflict)

```bash
git pull origin main
```

Output:
```
Auto-merging file.php
CONFLICT (content): Merge conflict in file.php
Automatic merge failed; fix conflicts and then commit the result.
```

**Cara Resolve Conflict:**

1. Buka file yang konflik (contoh: `file.php`)
2. Cari bagian yang konflik:
```php
<<<<<<< HEAD
// Kode lokal kamu
$nama = "Pempek Bunda 75";
=======
// Kode dari GitHub
$nama = "Pempek Bunda";
>>>>>>> origin/main
```

3. Edit manual, pilih yang mau dipakai:
```php
// Hasil setelah resolve
$nama = "Pempek Bunda 75";
```

4. Commit hasil resolve:
```bash
git add file.php
git commit -m "Resolve merge conflict"
```

---

### Skenario 4: Pull dari Branch Lain

```bash
# Pull dari branch development
git pull origin development

# Pull dari branch feature
git pull origin feature/new-feature
```

---

## 🛠️ Pull Commands Lengkap

### Basic Pull
```bash
git pull                    # Pull dari branch sekarang
git pull origin main        # Pull dari branch main
git pull origin development # Pull dari branch development
```

### Pull dengan Options
```bash
git pull --rebase origin main    # Pull dengan rebase (lebih bersih)
git pull --no-rebase origin main # Pull dengan merge (default)
git pull --ff-only origin main   # Pull hanya jika fast-forward
git pull --all                   # Pull semua branch
git pull --tags                  # Pull dengan tags
```

### Pull dengan Force (Hati-hati!)
```bash
# Buang semua perubahan lokal, ambil dari GitHub
git fetch origin
git reset --hard origin/main
```

⚠️ **WARNING**: Command ini akan **MENGHAPUS** semua perubahan lokal!

---

## 📊 Cek Sebelum Pull

### 1. Cek Branch Sekarang
```bash
git branch
```

Output:
```
* main
  development
```

### 2. Cek Status
```bash
git status
```

### 3. Cek Remote
```bash
git remote -v
```

### 4. Cek Log
```bash
git log --oneline -5
```

### 5. Cek Perbedaan dengan Remote
```bash
git fetch origin
git diff HEAD origin/main
```

---

## 🔄 Pull vs Fetch vs Clone

| Command | Fungsi | Kapan Digunakan |
|---------|--------|-----------------|
| **git clone** | Download project pertama kali | Belum punya project di lokal |
| **git fetch** | Download info perubahan (tidak merge) | Cek perubahan dulu sebelum merge |
| **git pull** | Download + merge perubahan | Update project yang sudah ada |

### Contoh:

**Clone (Pertama Kali):**
```bash
git clone https://github.com/keyshanp/pempekbunda75.git
```

**Fetch (Cek Perubahan):**
```bash
git fetch origin
git log HEAD..origin/main
```

**Pull (Update):**
```bash
git pull origin main
```

---

## 🚨 Troubleshooting Pull

### Error 1: "fatal: refusing to merge unrelated histories"

**Solusi:**
```bash
git pull origin main --allow-unrelated-histories
```

### Error 2: "Your local changes would be overwritten"

**Solusi:**
```bash
# Simpan perubahan lokal
git stash
git pull origin main
git stash pop
```

### Error 3: "Authentication failed"

**Solusi:**
```bash
# Gunakan Personal Access Token
git remote set-url origin https://TOKEN@github.com/keyshanp/pempekbunda75.git
git pull origin main
```

### Error 4: "fatal: couldn't find remote ref main"

**Solusi:**
```bash
# Mungkin branch-nya master, bukan main
git pull origin master
```

### Error 5: "fatal: not a git repository"

**Solusi:**
```bash
# Pastikan di folder yang benar
cd "C:\Users\keand\OneDrive\Desktop\Sekolah\Kelas 12\pempekbunda75"

# Atau init git
git init
git remote add origin https://github.com/keyshanp/pempekbunda75.git
git pull origin main
```

---

## 📱 Pull di Komputer Lain

### Scenario: Kamu mau kerja di komputer lain

**Di Komputer Baru:**

```bash
# 1. Clone project
git clone https://github.com/keyshanp/pempekbunda75.git

# 2. Masuk ke folder
cd pempekbunda75

# 3. Install dependencies
composer install
npm install

# 4. Copy .env
cp .env.example .env

# 5. Generate key
php artisan key:generate

# 6. Migrate database
php artisan migrate

# 7. Run server
php artisan serve
```

**Update Selanjutnya:**
```bash
git pull origin main
```

---

## 🔄 Workflow Pull yang Baik

### Sebelum Mulai Kerja:
```bash
# 1. Pull perubahan terbaru
git pull origin main

# 2. Cek status
git status

# 3. Mulai kerja
```

### Setelah Selesai Kerja:
```bash
# 1. Add & commit
git add .
git commit -m "Deskripsi perubahan"

# 2. Pull dulu (untuk sync)
git pull origin main

# 3. Resolve conflict jika ada

# 4. Push
git push origin main
```

---

## 💡 Tips Pull

1. **Selalu pull sebelum mulai kerja** - Hindari konflik
2. **Commit dulu sebelum pull** - Jaga perubahan lokal
3. **Gunakan git stash** - Jika belum siap commit
4. **Pull dengan rebase** - Untuk history yang lebih bersih
5. **Backup dulu** - Sebelum force pull

---

## 🎯 Quick Commands

```bash
# Pull basic
git pull

# Pull dengan rebase
git pull --rebase

# Pull dan lihat perubahan
git pull && git log -1

# Pull semua branch
git pull --all

# Pull dan update submodules
git pull --recurse-submodules

# Cek perubahan tanpa merge
git fetch && git diff HEAD origin/main
```

---

## 📝 Catatan Penting

1. **Pull = Fetch + Merge**
   ```bash
   git pull origin main
   # Sama dengan:
   git fetch origin
   git merge origin/main
   ```

2. **Selalu commit sebelum pull** - Hindari kehilangan perubahan

3. **Backup penting** - Sebelum force pull

4. **Komunikasi tim** - Koordinasi sebelum pull/push

5. **Branch strategy** - Gunakan branch untuk fitur baru

---

## ✅ Checklist Pull

- [ ] Cek status: `git status`
- [ ] Commit perubahan lokal: `git add . && git commit -m "message"`
- [ ] Fetch info: `git fetch origin`
- [ ] Cek perbedaan: `git log HEAD..origin/main`
- [ ] Pull: `git pull origin main`
- [ ] Resolve conflict (jika ada)
- [ ] Test project: `php artisan serve`
- [ ] Verify: `git log -1`

---

**Repository Kamu:**
```
https://github.com/keyshanp/pempekbunda75
```

**Need Help?**
- Lihat: `git pull --help`
- Atau: https://git-scm.com/docs/git-pull

---

Happy Pulling! 🚀
