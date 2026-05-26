#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -d vendor ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ "$DB_DATABASE" = "/data/database.sqlite" ]; then
    mkdir -p /data
    touch /data/database.sqlite
    chown -R www-data:www-data /data
    chmod -R ug+rw /data
else
    touch database/database.sqlite
fi

php artisan key:generate --force

php artisan migrate --force

php artisan db:seed --force

if [ ! -d node_modules ]; then
    npm install
fi

npm run build

if [ ! -L public/storage ]; then
    php artisan storage:link
fi

mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs
mkdir -p bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache database

if [ -d /data ]; then
    chown -R www-data:www-data /data
    chmod -R ug+rw /data
fi

php artisan schedule:work > /tmp/scheduler.log 2>&1 &

exec "$@"