#!/usr/bin/env bash

echo "-------------------------------------------------------------"
echo "|			|  Cleaning Laravel Application Cache |	          |"
echo "-------------------------------------------------------------"

php artisan clear-compiled;

# Clear caches
php artisan cache:clear;

# Clear and cache routes
php artisan route:clear;
php artisan config:clear;

# Clear compiled views
php artisan view:clear;

composer dumpautoload -o;

echo "****** Deleting images ******"
#rm -R storage/app/public;
#rm -R public/storage;

echo "****** Storage:Link ******"
#php artisan storage:link;

echo "****** Refreshing Database && Seeding data ******"
#php artisan migrate:refresh --seed;

echo "-------------------------------------------------------------"
echo "|				|  Finalizing Application Updates |	  		  |"
echo "-------------------------------------------------------------"
