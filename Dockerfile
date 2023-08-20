FROM php:8.0-cli

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y libzip-dev && \
    apt-get install -y zip && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

COPY . .

RUN composer install

VOLUME /var/www
EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www"]
