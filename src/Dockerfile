FROM php:7.4-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    && docker-php-ext-install mysqli pdo pdo_mysql zip gd

# Enable apache rewrite
RUN a2enmod rewrite

# Copy application to webroot
WORKDIR /var/www/html

# Ensure uploads/logs/cache directories exist
RUN mkdir -p /var/www/html/application/cache /var/www/html/application/logs

# Copy entrypoint and make it executable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
