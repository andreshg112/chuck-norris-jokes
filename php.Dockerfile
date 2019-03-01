FROM php:7.2-fpm

# libpng-dev se necesita GD.
RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client git zip unzip libpng-dev \
    && docker-php-ext-install pdo_mysql

RUN pecl install mcrypt-1.0.1
RUN docker-php-ext-enable mcrypt

# https://stackoverflow.com/questions/39657058/installing-gd-in-docker
RUN docker-php-ext-install mbstring

RUN docker-php-ext-install zip

RUN docker-php-ext-install gd
#

# https://gist.github.com/chadrien/c90927ec2d160ffea9c4
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
#

# Override with custom settings
COPY ./php-custom.ini $PHP_INI_DIR/conf.d/

ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
