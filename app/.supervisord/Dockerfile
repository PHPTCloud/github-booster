FROM php:8.3.4-fpm-alpine3.18 as php-fpm

WORKDIR /app

RUN apk update \
    && apk add libpq-dev \
      libzip-dev \
      zip \
    && docker-php-ext-install pdo \
      pdo_pgsql \
      opcache \
      pcntl


FROM php-fpm as php-supervisor

RUN apk add supervisor

RUN mkdir -p /var/log/supervisor

COPY ./conf.d /etc/supervisor/conf.d

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

