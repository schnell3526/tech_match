FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
  && apt-get -y install \
  libzip-dev \
  libicu-dev \
  libonig-dev \
  unzip \
  libfreetype6-dev \ 
  libjpeg62-turbo-dev \
  libpng-dev \
  libjpeg-dev \
  && curl -SL https://deb.nodesource.com/setup_15.x | bash \
  && apt-get install -y nodejs \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install \
  bcmath \
  intl \
  pdo_mysql \
  gd \
  zip \
  && docker-php-ext-configure gd \
  --with-freetype=/usr/include/ \
  --with-jpeg=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work