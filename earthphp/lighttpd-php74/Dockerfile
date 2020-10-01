FROM phpearth/php:7.4-lighttpd

ENV LUYA_CONFIG_ENV prod

RUN apk add --no-cache php7.4-intl php7.4-pdo_mysql php7.4-gd

COPY docker/example.conf /etc/lighttpd/example.conf
COPY docker/php.ini $PHP_INI_DIR/conf.d/my-app.ini

COPY . /var/www/localhost/htdocs

COPY docker/env.php /var/www/localhost/htdocs/configs/env.php

RUN mkdir -p /var/www/localhost/htdocs/public_html/assets
RUN mkdir -p /var/www/localhost/htdocs/runtime

RUN chmod 0777 /var/www/localhost/htdocs/public_html/assets
RUN chmod 0777 /var/www/localhost/htdocs/runtime
