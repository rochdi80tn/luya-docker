# LUYA DOCKER

Production Ready LUYA Docker Images including Webservers.

Example Project Dockerfile

```
FROM luyadev/luya-docker:nginx-fpm

COPY --chown=nobody . /var/www/html/
```

In order to change the NGINX Server Name currently there is only an override solution:

```
USER root
ENV NGINX_SERVERNAME=luya.io
RUN envsubst '${NGINX_SERVERNAME}' < /tmp/nginx.template > /etc/nginx/nginx.conf
USER nobody
```

## ENV

|Variable|Values|Descrption|
|--------|------|----------|
|`LUYA_CONFIG_ENV`|`prod`|The enviroment which should be taken, this must be assigned on runtime and is required in env.php

## Docker Build Testing

1. Build the image `docker build -t testimage .`
2. Run the image `docker run -p 8080:8080 testimage`
