FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip pdo pdo_mysql
