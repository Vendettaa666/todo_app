#!/bin/bash

echo "Starting Laravel Todo App deployment..."

# Check if we're in the right directory
echo "Current directory: $(pwd)"
echo "Contents: $(ls -la)"

# Check if vendor directory exists
if [ ! -d "vendor" ]; then
    echo "ERROR: vendor directory not found!"
    exit 1
fi

# Check if public directory exists
if [ ! -d "public" ]; then
    echo "ERROR: public directory not found!"
    exit 1
fi

# Run database migrations (don't fail if database is not ready)
echo "Running database migrations..."
php artisan migrate --force || echo "WARNING: Database migration failed, continuing..."

# Clear and cache config (don't fail if some commands fail)
echo "Caching configuration..."
php artisan config:cache || echo "WARNING: Config cache failed, continuing..."
php artisan route:cache || echo "WARNING: Route cache failed, continuing..."
php artisan view:cache || echo "WARNING: View cache failed, continuing..."

# Test if health check works
echo "Testing health check..."
php artisan route:list | grep health || echo "WARNING: Health route not found"

# Start the web server
echo "Starting web server..."
echo "Using PHP version: $(php --version)"
echo "Starting Apache server on port ${PORT:-8080}"

exec vendor/bin/heroku-php-apache2 public/
