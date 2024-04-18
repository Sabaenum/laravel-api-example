#!/bin/bash
echo "Installing Composer dependencies..."
composer install

echo "Running Laravel migrations..."
php artisan migrate

echo "Running Laravel seed..."
php artisan db:seed

echo "Running Laravel Swagger Gen..."
 php artisan l5-swagger:generate
echo "Done!"

echo "Running Laravel Tests..."
php artisan test
echo "Done!"
