web: php artisan migrate --force && vendor/bin/heroku-php-apache2 public/
release: echo "Database migrations will run during web startup"
worker: php artisan queue:work --verbose --tries=3 --timeout=90
