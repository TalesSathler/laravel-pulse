#!/bin/bash
set -e

git config --global --add safe.directory /var/www

if [ "${CONTAINER_ROLE}" = "vite" ]; then
    exec npm run dev -- --host 0.0.0.0
fi

chmod -R 775 storage bootstrap/cache
composer install --no-interaction
php artisan migrate --force

exec php-fpm
