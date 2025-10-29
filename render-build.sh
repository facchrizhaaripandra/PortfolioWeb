#!/bin/bash

# Exit on error
set -o errexit

echo "Starting Laravel application build..."

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Generate application key if not exists
if [ -z "$(grep APP_KEY=base64 .env.production 2>/dev/null)" ]; then
    php artisan key:generate --env=production
fi

# Create database directory and file
mkdir -p database
touch database/database.sqlite

# Run database migrations
php artisan migrate --force --env=production

# Seed the database
php artisan db:seed --force --env=production

# Cache configuration
php artisan config:cache --env=production

# Cache routes
php artisan route:cache --env=production

# Cache views
php artisan view:cache --env=production

# Create storage link
php artisan storage:link --env=production

echo "Build completed successfully!"
