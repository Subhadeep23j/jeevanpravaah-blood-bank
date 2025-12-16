#!/bin/bash
# JeevanPravaah Production Deployment Script
# Run this script on your production server

echo "🚀 Starting JeevanPravaah deployment..."

# 1. Pull latest changes (if using git)
echo "📥 Pulling latest changes..."
git pull origin main

# 2. Install dependencies (production only)
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev

# 3. Clear and cache configurations
echo "🔧 Caching configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Run migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# 5. Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# 6. Set permissions (Linux/Unix)
echo "🔐 Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# 7. Restart queue workers (if using queues)
echo "♻️ Restarting queue workers..."
php artisan queue:restart

echo "✅ Deployment complete!"
echo ""
echo "⚠️ IMPORTANT: Make sure to:"
echo "   1. Update .env with production values"
echo "   2. Set APP_DEBUG=false"
echo "   3. Set APP_ENV=production"
echo "   4. Configure your web server (Apache/Nginx)"
echo "   5. Set up SSL certificate for HTTPS"
