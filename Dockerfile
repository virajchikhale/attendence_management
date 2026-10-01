# Student Attendance Management System - PHP 8.3 + Apache
FROM php:8.3-apache

# PDO MySQL driver used by includes/connection.php
RUN docker-php-ext-install pdo_mysql

# Production PHP settings, then the app's own overrides
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/zz-app.ini"

COPY . /var/www/html/

# The home page talks to the database, so this also covers the DB link
HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD curl -fsS http://localhost/ > /dev/null || exit 1

EXPOSE 80
