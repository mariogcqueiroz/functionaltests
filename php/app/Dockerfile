FROM php:8.2-fpm-bullseye
#sempre use versoes numeradas
RUN apt update
RUN apt-get install git zlib1g-dev libzip-dev unzip -y
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions zip pdo_pgsql

COPY . /app
WORKDIR /app
RUN composer install
COPY php.ini "$PHP_INI_DIR/php.ini"

EXPOSE 9000

CMD ["php-fpm"]