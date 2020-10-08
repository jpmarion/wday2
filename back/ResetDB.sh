#!/bin/bash

echo Reset Base de datos
php artisan migrate:reset
echo Crear Base de datos
php artisan migrate
echo Instalar Passport
php artisan passport:install --force
