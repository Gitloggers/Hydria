# Use the official PHP + Apache image
FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache Mod_Rewrite
RUN a2enmod rewrite

# Copy website files
COPY . /var/www/html/

# Update Apache to listen on Render's dynamic port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Start Apache
CMD ["apache2-foreground"]
