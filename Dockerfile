FROM php:8.1.0-apache

WORKDIR /var/www/html

RUN rm -rf /etc/apache2/sites-available/*

COPY ./_docker/apache2/sites-available /etc/apache2/sites-available

RUN a2enmod rewrite

RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    nano

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

ENTRYPOINT ["./_docker/start.sh"]
