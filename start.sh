#!/bin/bash

# Post-deployment script for Railway
echo "🚀 Starting Kashish World application..."

# Run migrations if needed
echo "📊 Running database migrations..."
php artisan migrate --force --no-interaction

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link --force --no-interaction || true

# Clear and cache for production
echo "⚡ Optimizing for production..."
php artisan config:cache --no-interaction || true
php artisan route:cache --no-interaction || true
php artisan view:cache --no-interaction || true

echo "✅ Application is ready!"

# Start the application
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
