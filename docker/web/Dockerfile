# syntax=docker/dockerfile:1

FROM php:7.4-apache-bullseye

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
       libpng-dev \
       libjpeg62-turbo-dev \
       libfreetype6-dev \
       default-mysql-client \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j"$(nproc)" mysqli gd \
  && a2enmod rewrite headers \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . /var/www/html

COPY docker/web/php.ini /usr/local/etc/php/conf.d/armagedom.ini
COPY docker/web/mysql-shim.php /usr/local/lib/php/mysql-shim.php
COPY docker/web/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/web/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh \
  && a2enmod rewrite headers \
  && chown -R www-data:www-data /var/www/html/caches /var/www/html/compiles \
  && chmod -R ug+rwX /var/www/html/caches /var/www/html/compiles

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
