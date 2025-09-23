# 🚀 Step-by-Step Deploy Laravel ke Railway

## 📋 Langkah 1: Persiapan Repository

### ✅ Pastikan semua file sudah di-commit
```bash
git add .
git commit -m "Ready for Railway deployment"
git push origin main
```

## 🔧 Langkah 2: Setup Railway Account

### ✅ Buat akun Railway
1. Buka: https://railway.app
2. Klik **"Login"** → **"Login with GitHub"**
3. Authorize Railway untuk akses repository

## 🗄️ Langkah 3: Setup Database PostgreSQL

### ✅ Buat database PostgreSQL
1. Di Railway dashboard, klik **"New Project"**
2. Klik **"New"** → **"Database"** → **"PostgreSQL"**
3. Tunggu 30-60 detik hingga database ready
4. **PENTING**: Copy `DATABASE_URL` dari database service

## 🌐 Langkah 4: Setup Web Application

### ✅ Deploy aplikasi Laravel
1. Di project yang sama, klik **"New"** → **"GitHub Repo"**
2. Pilih repository `todo_app`
3. Railway akan otomatis detect Laravel dan mulai build

## ⚙️ Langkah 5: Set Environment Variables

### ✅ Buka Variables Tab
1. Klik pada **Web Service** (bukan database)
2. Klik tab **"Variables"**
3. Tambahkan variables satu per satu dari file `duplicate env production`

### 📝 Copy Environment Variables Ini:

```bash
APP_NAME=TodoApp
APP_ENV=production
APP_KEY=base64:z9eC19ogJTLTwc4JFLCl/FrrVMqtSXsFGb9+PWMnM0s=
APP_DEBUG=false
APP_URL=https://tasklistapp.up.railway.app

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

APP_OPTIMIZE=true

DATABASE_URL=[PASTE_DATABASE_URL_DARI_STEP_3]

BROADCAST_DRIVER=log
CACHE_DRIVER=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@todoapp.com
MAIL_FROM_NAME=${APP_NAME}
```

### 🔄 Cara Set Variables di Railway:
1. Klik **"New Variable"**
2. Masukkan **Name**: `APP_NAME`
3. Masukkan **Value**: `TodoApp`
4. Klik **"Add"**
5. Ulangi untuk semua variables di atas

## 🚀 Langkah 6: Monitor Deployment

### ✅ Tunggu Build & Deploy
1. **Build Phase** (2-3 menit):
   - Install dependencies
   - Run cache commands
   - Build assets

2. **Deploy Phase** (1-2 menit):
   - Start web server
   - Run migrations
   - Health check

### 📊 Monitor di Railway Dashboard:
- **Build Logs**: Cek apakah ada error
- **Deploy Logs**: Cek startup process
- **Health Check**: Harus berubah jadi hijau

## 🧪 Langkah 7: Test Aplikasi

### ✅ Buka URL Railway
1. Klik **"Settings"** di web service
2. Copy **"Domain"** URL
3. Buka di browser

### ✅ Test Fitur:
1. **Register user baru**
2. **Login**
3. **Create task**
4. **Test semua fitur**

## 🎯 Hasil Akhir

Setelah selesai, Anda akan punya:
- ✅ Laravel Todo App live di Railway
- ✅ PostgreSQL database
- ✅ Auto-scaling web server
- ✅ Health monitoring
- ✅ Automatic backups

---

## 🆘 Jika Ada Masalah

### ❌ Build Gagal?
- Cek logs di Railway dashboard
- Pastikan semua dependencies ada

### ❌ Healthcheck Gagal?
- Pastikan DATABASE_URL benar
- Tunggu 5 menit (startup time)

### ❌ Database Error?
- Pastikan PostgreSQL service running
- Cek DATABASE_URL format

---

## 📞 Butuh Bantuan?

1. Cek Railway documentation: https://docs.railway.app
2. Cek logs di Railway dashboard
3. Test lokal dengan `debug-startup.php`
