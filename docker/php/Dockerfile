FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y libicu-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install intl pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /app