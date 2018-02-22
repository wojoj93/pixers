#!/usr/bin/env bash

cd /var/www/symfony && SYMFONY_ENV=dev composer install -n --prefer-dist --dev --optimize-autoloader
chmod 777 var -R

exec apache2-foreground