#!/bin/bash
set -e

# Create SQLite database if not exists
touch storage/app/dayah_madani.sqlite

# Set DB path for production
export DB_CONNECTION=sqlite
export DB_DATABASE=$(pwd)/storage/app/dayah_madani.sqlite

# Run migrations and seed
php artisan migrate --force
php artisan db:seed --force

# Start PHP-FPM and Nginx
php artisan serve --host=0.0.0.0 --port=$PORT
