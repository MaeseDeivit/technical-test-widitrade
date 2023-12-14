all:
  composer install
  php artisan migrate
