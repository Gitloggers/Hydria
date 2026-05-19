# Use the official PHP + Apache image
FROM php:8.2-apache

# Install System Dependencies for GD
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Enable Apache Mod_Rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides and enable rewrites in the web root
RUN sed -i '/<Directory \/var\/www\/html\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf

# Copy website files to document root
COPY . /var/www/html/

# Create assets directory and set permissions
RUN mkdir -p /var/www/html/assets && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/assets

# Copy and prepare the entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Port replacement happens at runtime via entrypoint (Render sets $PORT dynamically)
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
