FROM php:7.3-apache

RUN apt-get update && apt-get install -y libmcrypt-dev locales locales-all cronolog curl gnupg \
   libjpeg62-turbo-dev libmcrypt-dev libssl-dev libjpeg-dev libpng-dev libfreetype6-dev \
   zip unzip libicu-dev libxslt-dev git cron \
   mariadb-client libmagickwand-dev --no-install-recommends \
   && pecl install imagick \
   && docker-php-ext-enable imagick \
   && docker-php-ext-install pdo_mysql mbstring bcmath soap \
   && docker-php-ext-configure intl \
   && docker-php-ext-install intl \
   && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
   && docker-php-ext-install gd \
   && docker-php-ext-install xsl

RUN a2enmod rewrite

RUN apt-get install -y \
            libzip-dev \
            zip \
      && docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "unlink('composer-setup.php');"

RUN apt-get update
RUN curl -sL https://deb.nodesource.com/setup_12.x  | bash -
RUN apt-get -y install nodejs
