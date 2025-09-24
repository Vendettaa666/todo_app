#!/bin/bash

# Copy environment variables to .env
printenv > .env

# Install dependencies
composer install --no-dev --optimize-autoloader

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate --force

# Cache config
php artisan config:cache
