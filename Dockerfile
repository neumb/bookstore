FROM php:8.2-fpm

# Install necessary extensions
RUN docker-php-ext-install pdo pdo_mysql
