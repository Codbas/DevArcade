FROM php:8.2-apache

ENV TZ=America/Los_Angeles

COPY mysql-config.cnf /etc/mysql/conf.d/config.cnf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

RUN docker-php-ext-install zip pdo_mysql

COPY install-composer.sh ./

COPY php.ini /usr/local/etc/php/

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www && chmod -R 775 /var/www
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data
USER www-data

CMD ["apache2-foreground"]
