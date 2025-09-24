#!/bin/bash

# Exit on any error
set -e

echo "Starting Laravel Todo App deployment..."

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Clear and cache config
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the web server
echo "Starting web server..."
exec vendor/bin/heroku-php-apache2 public/
