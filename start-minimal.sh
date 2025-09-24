#!/bin/bash

echo "Starting Laravel Todo App (minimal version)..."

# Check basic requirements
echo "PHP version: $(php --version | head -1)"
echo "Current directory: $(pwd)"

# Try to run migrations (non-blocking)
echo "Attempting database migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

# Start web server immediately
echo "Starting web server on port ${PORT:-8080}..."
exec vendor/bin/heroku-php-apache2 public/
