#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -f database/database.sqlite ]; then
    touch database/database.sqlite
fi

php artisan key:generate --force

php artisan migrate --force

if [ ! -d node_modules ]; then
    npm install
fi

npm run build

php artisan storage:link || true

chown -R www-data:www-data storage bootstrap/cache database

php artisan schedule:work > /tmp/scheduler.log 2>&1 &

exec "$@"