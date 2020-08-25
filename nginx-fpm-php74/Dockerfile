FROM ubuntu:20.04
ENV TZ=Europe/Berlin
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update

RUN apt-get install -y php php-fpm php-mysqli php-json php-curl \
    php-xml php-intl php-dom \
    php-mbstring php-gd php-zip
RUN apt-get install -y nginx supervisor curl nano gettext-base

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
RUN mkdir -p /app/public_html/

RUN mkdir -p /app/public_html/assets
RUN chmod 777 /app/public_html/assets
RUN mkdir -p /app/runtime
RUN chmod 777 /app/runtime

WORKDIR /app

COPY config/env.php /app/configs/env.php

RUN mkdir -p /var/run/php

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
