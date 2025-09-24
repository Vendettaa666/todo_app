# Railway Deployment Guide

## Konfigurasi yang Sudah Diperbaiki

### 1. File Konfigurasi
- ✅ `railway.json` - Konfigurasi Railway deployment
- ✅ `nixpacks.toml` - Build configuration dengan Node.js dan PHP
- ✅ `Procfile` - Process configuration
- ✅ `start-simple.sh` - Startup script untuk deployment
- ✅ `railway-production.env` - Environment variables untuk production

### 2. Environment Variables yang Perlu Diset di Railway

Copy semua variable dari `railway-production.env` ke Railway Environment Settings:

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

# Database URL akan disediakan otomatis oleh Railway
DATABASE_URL=postgresql://postgres:WpsYbwjLAuzNaPkaBHcjkBYcmFeoeDMY@switchback.proxy.rlwy.net:32212/railway

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
MAIL_FROM_ADDRESS="hello@todoapp.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 3. Langkah Deployment

1. **Connect Repository ke Railway**
   - Login ke Railway.app
   - Create new project
   - Connect GitHub repository

2. **Add PostgreSQL Database**
   - Add PostgreSQL service
   - Railway akan otomatis set `DATABASE_URL`

3. **Set Environment Variables**
   - Copy semua variable dari `railway-production.env`
   - Update `APP_URL` dengan URL Railway Anda
   - Generate `APP_KEY` baru jika perlu: `php artisan key:generate --show`

4. **Deploy**
   - Railway akan otomatis build dan deploy
   - Build process: install dependencies, build assets, cache config
   - Startup: run migrations, start web server

### 4. Health Check

Aplikasi memiliki health check endpoint di `/health` yang akan digunakan Railway untuk monitoring.

### 5. Troubleshooting

Jika deployment gagal:
1. Check logs di Railway dashboard
2. Pastikan semua environment variables sudah diset
3. Pastikan database connection berfungsi
4. Check apakah `APP_KEY` sudah diset dengan benar

### 6. Build Process

Railway akan menjalankan:
1. Install PHP dependencies (`composer install`)
2. Clean npm cache dan install Node.js dependencies (`npm install --no-optional --legacy-peer-deps`)
3. Build frontend assets (`npm run build`)
4. Cache Laravel config, routes, dan views
5. Run database migrations
6. Start web server

### 7. Troubleshooting NPM Issues

Jika masih ada masalah dengan npm dependencies:
1. File `.npmrc` sudah dikonfigurasi untuk menggunakan legacy peer deps
2. Build process akan clean cache dan regenerate package-lock.json
3. Menggunakan `--no-optional` dan `--legacy-peer-deps` untuk kompatibilitas
