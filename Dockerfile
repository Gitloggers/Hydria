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

# Copy website files
COPY . /var/www/html/

# Create assets directory if it doesn't exist and set permissions
RUN mkdir -p /var/www/html/assets && \
    chown -R www-data:www-data /var/www/html/ && \
    chmod -R 755 /var/www/html/assets

# Update Apache to listen on Render's dynamic port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Start Apache
CMD ["apache2-foreground"]
