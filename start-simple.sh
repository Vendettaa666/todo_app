#!/bin/bash

echo "=== Simple Startup ==="

# Set port
export PORT=${PORT:-80}

# Run migrations with timeout
echo "Running migrations..."
timeout 60 php artisan migrate --force

# Start server
echo "Starting server..."
vendor/bin/heroku-php-apache2 public/
