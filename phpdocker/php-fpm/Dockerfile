FROM phpdockerio/php:8.3-fpm
WORKDIR "/application"

RUN apt-get update && apt-get -y --no-install-recommends install \
        curl \
        php8.3-mysql \
        php8.3-xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN usermod -u 1000 www-data

RUN mkdir /var/www
RUN mkdir /var/www/.composer
RUN mkdir /var/www/.composer/cache
RUN chown -R www-data:www-data /var/www/.composer

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && curl -L https://www.npmjs.com/install.sh | sh

