#!/bin/bash

# Railway build script for Kashish World Laravel App
echo "🚀 Building Kashish World for Railway deployment..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Install Node dependencies
echo "📦 Installing Node.js dependencies..."
npm ci --only=production

# Build assets
echo "🎨 Building frontend assets..."
npm run build

# Set permissions for storage and cache
echo "🔐 Setting proper permissions..."
chmod -R 775 storage bootstrap/cache

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Cache configuration for better performance
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completed successfully for Railway!"
echo "🌐 Your app is ready for deployment!"
    echo "❌ Docker build failed!"
    exit 1
fi

echo "🎉 Build completed!"
