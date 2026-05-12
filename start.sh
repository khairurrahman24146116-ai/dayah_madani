#!/bin/bash
set -e

mkdir -p storage/app storage/framework/views storage/framework/cache storage/logs

touch storage/app/dayah_madani.sqlite

php artisan storage:link --force

php artisan optimize

php artisan migrate --force

php artisan db:seed --force
