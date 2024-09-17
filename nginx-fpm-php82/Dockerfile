FROM ubuntu:22.04
ENV TZ=Africa/Tunis
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get -y update --fix-missing && apt-get -y upgrade
RUN apt install software-properties-common ca-certificates lsb-release apt-transport-https -y
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php 
RUN apt-get update -y

RUN apt-get install -y php8.2-fpm  php8.2-mysql php8.2-curl php8.2-memcached \
    php8.2-dom  php8.2-intl  php8.2-xml  php8.2-mbstring php8.2-gd php8.2-zip \
    nginx supervisor gettext-base \
    curl
RUN apt-get install -y php8.2-ldap
RUN apt-get clean autoclean
RUN apt-get autoremove --yes

# Configure nginx
COPY config/nginx.conf /tmp/nginx.template
ENV NGINX_SERVERNAME="LUYAPROD"
RUN envsubst '${NGINX_SERVERNAME}' < /tmp/nginx.template > /etc/nginx/nginx.conf

COPY config/fpm-pool.conf /etc/php/8.2/fpm/pool.d/www.conf
COPY config/php.ini /etc/php/8.2/fpm/conf.d/zzz_custom.ini

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
