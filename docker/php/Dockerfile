FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libicu-dev && apt-get clean
RUN docker-php-ext-install opcache pdo_mysql intl


WORKDIR /usr/share/nginx/html