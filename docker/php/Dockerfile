FROM php:7.4.21-fpm

LABEL version="0.1"
LABEL description="PHP-FPM Garage API"

## libzip used for docker-php-ext install zip, zlibc used for composer download, libpq-dev used for pdo_pgsql ##
## librabbitmq-dev libssh-dev used for amqp
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install libzip-dev zlibc vim libpq-dev libpng-dev -y && \
    docker-php-ext-install zip mysqli pdo_mysql json gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

## Install Composer ##
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

## Composer Cache Config ##
RUN mkdir /var/cache/.composer && \
    chown -R 1000:1000 /var/cache/.composer && \
    chmod -R 740 /var/cache/.composer/

## Copy Entrypoint to root path ##
COPY --chown=1000:1000 ./docker/php/entrypoint.sh /entrypoint.sh

## Copy Project ##
COPY --chown=1000:1000 ./back-end /var/www

WORKDIR /var/www

USER 1000
EXPOSE 9000

## Entrypoint path relative to WORKDIR ##
ENTRYPOINT ["sh", "/entrypoint.sh"]