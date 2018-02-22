FROM php:7.0-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y nodejs libicu-dev git mysql-client libz-dev wget nano \
    && rm -rf /var/lib/apt/lists/*r
RUN docker-php-ext-install intl opcache zip mbstring
RUN wget https://getcomposer.org/composer.phar && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer

ADD docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
ADD docker/php.ini /usr/local/etc/php/php.ini
ADD . /var/www/symfony

COPY docker/development_entrypoint.sh /usr/bin/development_entrypoint.sh
RUN chmod +x /usr/bin/development_entrypoint.sh

WORKDIR /var/www/symfony

RUN cp app/config/parameters.yml.dist app/config/parameters.yml && \
    rm -f /var/www/symfony/web/app_dev.php

RUN chmod -R 777 ./var/
RUN chown -R www-data:www-data /var/www/symfony

ENTRYPOINT ["/usr/bin/development_entrypoint.sh"]

