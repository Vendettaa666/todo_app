# 🚀 Deployment Guide untuk Railway

## 📋 Persiapan Deployment

### 1. Environment Variables di Railway

Copy semua variables dari `railway-production.env` ke Railway Environment Settings:

```bash
# Application
APP_NAME=TodoApp
APP_ENV=production
APP_KEY=base64:z9eC19ogJTLTwc4JFLCl/FrrVMqtSXsFGb9+PWMnM0s=
APP_DEBUG=false
APP_URL=https://tasklistapp.up.railway.app

# Database
DATABASE_URL=postgresql://postgres:WpsYbwjLAuzNaPkaBHcjkBYcmFeoeDMY@switchback.proxy.rlwy.net:32212/railway

# Cache, Session, Queue
BROADCAST_DRIVER=log
CACHE_DRIVER=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Mail
MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@todoapp.com"
MAIL_FROM_NAME="${APP_NAME}"

# Logging
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error
```

### 2. Cara Set Environment Variables

#### Via Railway Dashboard:
1. Buka [Railway Dashboard](https://railway.app)
2. Pilih project Anda
3. Klik pada web service
4. Pilih tab **"Variables"**
5. Tambahkan variables satu per satu

#### Via Railway CLI:
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Set variables
railway variables set APP_NAME="TodoApp"
railway variables set APP_ENV=production
railway variables set APP_KEY="base64:z9eC19ogJTLTwc4JFLCl/FrrVMqtSXsFGb9+PWMnM0s="
railway variables set APP_DEBUG=false
railway variables set DATABASE_URL="postgresql://postgres:WpsYbwjLAuzNaPkaBHcjkBYcmFeoeDMY@switchback.proxy.rlwy.net:32212/railway"
railway variables set CACHE_DRIVER=database
railway variables set SESSION_DRIVER=database
railway variables set QUEUE_CONNECTION=database
```

## 🔧 Konfigurasi Deployment

### File yang Sudah Dioptimasi:

1. **`railway.json`** ✅
   - Health check path dan timeout
   - Restart policy ON_FAILURE

2. **`nixpacks.toml`** ✅
   - PostgreSQL dependencies
   - Optimized composer install
   - Cache commands

3. **`Procfile`** ✅
   - Web process dengan migration
   - Worker process untuk queue
   - Release process

4. **`railway-production.env`** ✅
   - Production environment variables
   - Database-driven cache/session/queue

## 🚀 Langkah Deployment

### 1. Commit dan Push
```bash
git add .
git commit -m "Optimize deployment configuration for Railway"
git push origin main
```

### 2. Monitor Deployment
- Buka Railway dashboard
- Monitor build logs
- Cek deployment status

### 3. Verify Deployment
- Test aplikasi di URL Railway
- Cek database connection
- Verify migrations berhasil

## 🐛 Troubleshooting

### Error: "No application encryption key"
- Pastikan `APP_KEY` sudah di-set di Railway

### Error: "Database connection refused"
- Pastikan `DATABASE_URL` benar
- Cek PostgreSQL service status

### Error: "Migration failed"
- Cek database connection
- Pastikan environment variables tersedia

### Error: "Cache/Session driver not supported"
- Pastikan `CACHE_DRIVER=database`
- Pastikan `SESSION_DRIVER=database`

## 📊 Monitoring

### Logs
- Cek logs di Railway dashboard
- Monitor error logs
- Cek migration logs

### Health Check
- Aplikasi akan otomatis restart jika gagal
- Health check path: `/`
- Timeout: 100 detik

## 🔄 Local Development

Untuk development lokal, gunakan `local-development.env`:
```bash
cp local-development.env .env
```

## 📝 Notes

- Migration berjalan otomatis saat startup
- Cache, session, dan queue menggunakan database
- Tidak memerlukan Redis untuk basic deployment
- Mail menggunakan log driver (untuk development)
