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



# Switch to root user to create the configuration file
USER root

# Set upload_max_filesize and post_max_size from the environment variable
RUN echo "upload_max_filesize=${UPLOAD_LIMIT}" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size=${UPLOAD_LIMIT}" >> /usr/local/etc/php/conf.d/uploads.ini

# Ensure the container uses the www-data user
USER www-data

# Copy application source
COPY src/ /var/www/html/

# Copy custom PHP ini file
COPY custom.ini /usr/local/etc/php/conf.d/


# Start Apache in the foreground
CMD ["apache2-foreground"]
