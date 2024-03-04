FROM php:8.3-fpm-bullseye
#sempre use versoes numeradas
RUN apt update
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
COPY web /app
WORKDIR /app
RUN composer install
COPY php.ini "$PHP_INI_DIR/php.ini"
EXPOSE 9000

CMD ["php-fpm"]