# LUYA DOCKER

Production Ready LUYA Docker Images including Webservers.

Example Project Dockerfile

```
FROM luyadev/luya-docker:nginx-fpm

COPY --chown=nobody . /var/www/html/
```

In order to change the NGINX Server Name currently only have this solution

```
USER root
ENV NGINX_SERVERNAME=luya.io
RUN envsubst '${NGINX_SERVERNAME}' < /tmp/nginx.template > /etc/nginx/nginx.conf
USER nobody
```

## Docker Build Testing

1. Build the image `docker build -t testimage .`
2. Run the image `docker run -p 8080:8080 testimage`
