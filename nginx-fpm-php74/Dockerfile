FROM ubuntu:20.04
ENV TZ=Europe/Berlin
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get -y update --fix-missing
RUN apt-get install -y php php-fpm php-mysqli php-pgsql php-json php-curl php-memcached \
    php-xml php-intl php-dom \
    php-mbstring php-gd php-zip \
    nginx supervisor gettext-base \
    curl

RUN apt-get clean autoclean
RUN apt-get autoremove --yes

RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && architecture=$(case $(uname -m) in i386 | i686 | x86) echo "i386" ;; x86_64 | amd64) echo "amd64" ;; aarch64 | arm64 | armv8) echo "arm64" ;; *) echo "amd64" ;; esac) \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/$architecture/$version \
    && mkdir -p /tmp/blackfire \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get ('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > /etc/php/7.4/fpm/conf.d/blackfire.ini \
    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz

# Configure nginx
COPY config/nginx.conf /tmp/nginx.template
ENV NGINX_SERVERNAME="LUYAPROD"
RUN envsubst '${NGINX_SERVERNAME}' < /tmp/nginx.template > /etc/nginx/nginx.conf

COPY config/fpm-pool.conf /etc/php/7.4/fpm/pool.d/www.conf
COPY config/php.ini /etc/php/7.4/fpm/conf.d/zzz_custom.ini

COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY ./luya.sh /usr/local/bin/luya
COPY ./setup.sh /usr/local/bin/setup

RUN chmod +x /usr/local/bin/luya
RUN chmod +x /usr/local/bin/setup 

RUN mkdir -p /app
RUN mkdir -p /app/public_html

RUN mkdir -p /app/public_html/assets
RUN mkdir -p /app/runtime

RUN chmod 777 /app/public_html/assets
RUN chmod 777 /app/runtime

WORKDIR /app

COPY config/env.php /app/configs/env.php

RUN mkdir -p /var/run/php

#USER www-data:www-data

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
