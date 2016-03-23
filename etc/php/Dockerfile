FROM php:5.6-fpm

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install libpq-dev libmemcached-dev -my --no-install-recommends
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install opcache pdo_pgsql
RUN pecl install xdebug memcached
RUN docker-php-ext-enable xdebug memcached

COPY ./php.ini /usr/local/etc/php/conf.d/00-custom.ini

RUN usermod -u 1000 www-data

VOLUME ["/var/www"]

EXPOSE 9000

CMD ["php-fpm"]
