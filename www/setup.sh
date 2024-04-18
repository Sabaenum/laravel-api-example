#!/bin/bash
echo "Installing Composer dependencies..."
composer install

echo "Running Laravel migrations..."
php artisan migrate

echo "Running Laravel seed..."
php artisan db:seed
