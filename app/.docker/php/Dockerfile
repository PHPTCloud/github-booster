FROM php:8.3.4-fpm-alpine3.18

WORKDIR /app

RUN apk update \
    && apk add libpq-dev \
      libzip-dev \
      zip \
    && docker-php-ext-install pdo \
      pdo_pgsql \
      opcache \
      pcntl

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
