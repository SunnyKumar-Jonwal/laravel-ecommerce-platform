#!/bin/bash

# Railway build script for Laravel
echo "🚀 Building Kashish World for Railway..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
echo "📦 Installing Node.js dependencies..."
npm ci

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Generate application key if not set
echo "🔑 Setting up application..."
php artisan key:generate --force --no-interaction || true

# Cache configuration for better performance
echo "⚡ Optimizing application..."
php artisan config:cache --no-interaction || true
php artisan route:cache --no-interaction || true
php artisan view:cache --no-interaction || true

echo "✅ Build completed successfully!"
    echo "❌ Docker build failed!"
    exit 1
fi

echo "🎉 Build completed!"
