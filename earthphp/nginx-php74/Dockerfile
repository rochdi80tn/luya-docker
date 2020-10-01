FROM phpearth/php:7.4-nginx

ENV LUYA_CONFIG_ENV prod

RUN apk add --no-cache php7.4-intl php7.4-pdo_mysql php7.4-gd

COPY docker/default.conf /etc/nginx/conf.d/default.conf
COPY docker/php.ini $PHP_INI_DIR/conf.d/my-app.ini

COPY . /var/www/html

COPY docker/env.php /var/www/html/configs/env.php

RUN mkdir -p /var/www/htmlpublic_html/assets
RUN mkdir -p /var/www/htmlruntime

RUN chmod 0777 /var/www/htmlpublic_html/assets
RUN chmod 0777 /var/www/htmlruntime
