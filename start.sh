#!/bin/bash

echo "=== Starting Todo App ==="

# Set environment variables
export PORT=${PORT:-80}

echo "Port: $PORT"
echo "Database URL: $DATABASE_URL"

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="echo 'Database connection: ' . (DB::connection()->getPdo() ? 'OK' : 'FAILED');"

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Check if migrations succeeded
if [ $? -eq 0 ]; then
    echo "Migrations completed successfully"
else
    echo "Migration failed"
    exit 1
fi

# Start web server
echo "Starting web server on port $PORT..."
vendor/bin/heroku-php-apache2 public/
