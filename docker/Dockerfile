FROM php:8.4-apache-bookworm

WORKDIR /var/www/html

COPY src/ /var/www/html/

RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        zip \
        curl \
        libzip-dev \
        libsqlite3-dev \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && node -v \
    && npm -v

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

CMD ["apache2-foreground"]