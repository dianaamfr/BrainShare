#!/bin/bash
set -e

cd /var/www; php artisan config:cache
# delete old symlink
rm public/storage
# create new symlink with the path from the docker container
php artisan storage:link
env >> /var/www/.env
php-fpm7.4 -D
nginx -g "daemon off;"
