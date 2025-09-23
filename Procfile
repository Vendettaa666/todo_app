web: chmod +x start-simple.sh && ./start-simple.sh
release: echo "Database migrations will run during web startup"
worker: php artisan queue:work --verbose --tries=3 --timeout=90
