#!/bin/bash

echo Limpiar cache
php artisan cache:clear

echo Limpiar route
php artisan route:clear

echo Limpiar config
php artisan config:clear

echo Reset Apache
 /etc/init.d/apache2 restart
