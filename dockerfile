FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Copy specific files
COPY index.php /var/www/html/
COPY handle-form.php /var/www/html/
COPY success-page.php /var/www/html/
COPY functions.php /var/www/html/
COPY styles.css /var/www/html/
COPY form_data.csv /var/www/html/

# Install additional PHP extensions and dependencies
RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

# Enable Apache modules
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html
