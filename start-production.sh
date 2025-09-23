#!/bin/bash

set -e  # Exit on any error

echo "=== Production Startup Script ==="
echo "Timestamp: $(date)"
echo "Port: ${PORT:-80}"

# Wait for database to be ready
echo "Waiting for database connection..."
for i in {1..30}; do
    if php artisan tinker --execute="DB::connection()->getPdo();" >/dev/null 2>&1; then
        echo "✅ Database connection established"
        break
    fi
    echo "Attempt $i/30: Database not ready, waiting..."
    sleep 2
done

# Run migrations
echo "Running database migrations..."
php artisan migrate --force
echo "✅ Migrations completed"

# Clear and rebuild cache
echo "Rebuilding application cache..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✅ Cache rebuilt"

# Start web server
echo "Starting web server..."
exec vendor/bin/heroku-php-apache2 public/
