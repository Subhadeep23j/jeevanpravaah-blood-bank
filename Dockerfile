# Use PHP 8.2 with FPM
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create Nginx configuration
RUN echo 'server { \n\
    listen 80; \n\
    server_name _; \n\
    root /var/www/html/public; \n\
    index index.php index.html; \n\
    \n\
    location / { \n\
        try_files $uri $uri/ /index.php?$query_string; \n\
    } \n\
    \n\
    location ~ \.php$ { \n\
        fastcgi_pass 127.0.0.1:9000; \n\
        fastcgi_index index.php; \n\
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name; \n\
        include fastcgi_params; \n\
    } \n\
    \n\
    location ~ /\.(?!well-known).* { \n\
        deny all; \n\
    } \n\
}' > /etc/nginx/sites-available/default

# Create Supervisor configuration
RUN echo '[supervisord] \n\
nodaemon=true \n\
\n\
[program:php-fpm] \n\
command=/usr/local/sbin/php-fpm \n\
autostart=true \n\
autorestart=true \n\
\n\
[program:nginx] \n\
command=/usr/sbin/nginx -g "daemon off;" \n\
autostart=true \n\
autorestart=true' > /etc/supervisor/conf.d/supervisord.conf

# Create startup script
RUN echo '#!/bin/bash \n\
php artisan config:cache \n\
php artisan route:cache \n\
php artisan view:cache \n\
php artisan migrate --force \n\
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf' > /var/www/html/start.sh \
    && chmod +x /var/www/html/start.sh

# Expose port 80
EXPOSE 80

# Start the application
CMD ["/var/www/html/start.sh"]
