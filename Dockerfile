FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    nginx \
    nodejs \
    npm \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    --with-xpm

RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    exif \
    pcntl \
    zip

# Verify extensions installed
RUN php -m | grep -E "pdo|pdo_mysql"

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel app
COPY . /var/www/html

# Ensure required Laravel directories exist
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
# --no-scripts prevents artisan/package discovery failures during build
RUN composer install \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# Install JS dependencies & build assets
RUN npm install && npm run build

# Write custom nginx config directly
RUN rm -f /etc/nginx/sites-enabled/default && \
    printf "%s\n" \
    "server {" \
    "    listen 80;" \
    "    index index.php index.html;" \
    "    root /var/www/html/public;" \
    "" \
    "    location / {" \
    "        try_files \$uri \$uri/ /index.php?\$query_string;" \
    "    }" \
    "" \
    "    location ~ \.php$ {" \
    "        try_files \$uri =404;" \
    "        fastcgi_pass 127.0.0.1:9000;" \
    "        fastcgi_index index.php;" \
    "        include fastcgi_params;" \
    "        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;" \
    "    }" \
    "" \
    "    location ~ /\.ht {" \
    "        deny all;" \
    "    }" \
    "}" > /etc/nginx/conf.d/default.conf

# Copy Supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy SSL certificate for TiDB
COPY docker/ssl/ca.pem /etc/ssl/certs/ca.pem

# Copy start script
COPY docker/start.sh /start.sh

# Fix Windows line endings if present
RUN sed -i 's/\r$//' /start.sh && chmod +x /start.sh

# Expose port
EXPOSE 80

# Start everything
CMD ["/start.sh"]