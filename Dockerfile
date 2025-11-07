FROM php:8.4-cli-alpine3.22

RUN apk update && \
    apk add --no-cache \
        libzip-dev \
        git \
        openssl-dev && \
    docker-php-ext-install -j$(nproc) \
        zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN apk add --no-cache --virtual .phpize_deps $PHPIZE_DEPS linux-headers && \
    pecl install xdebug-3.4.7 && \
    docker-php-ext-enable xdebug && \
    rm -rf /tmp/pear && \
    apk del .phpize_deps

ENV PATH /var/app/bin:/var/app/vendor/bin:$PATH

WORKDIR /var/app
