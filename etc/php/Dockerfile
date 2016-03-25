FROM php:7-fpm

RUN apt-get update
RUN apt-get upgrade -my
RUN apt-get install libpq-dev libxml2-dev -my --no-install-recommends
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install opcache pdo_pgsql soap
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

COPY ./php.ini /usr/local/etc/php/conf.d/00-custom.ini

RUN usermod -u 1000 www-data

VOLUME ["/var/www"]

EXPOSE 9000

CMD ["php-fpm"]
