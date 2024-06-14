FROM php:apache

# Install mysqli extension and other necessary packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli

# Change ownership of the directory
RUN chown -R www-data:www-data /var/run/apache2/

# Ensure the container uses the www-data user
USER www-data

# Copy application source
COPY src/ /var/www/html/

# Start Apache in the foreground
CMD ["apache2-foreground"]
