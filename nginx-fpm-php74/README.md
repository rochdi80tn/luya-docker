# Nginx with PHP 7.4 FPM on Port 80

## docker builds

Example Project Dockerfile

```
FROM luyadev/luya-docker:nginx-fpm-php74
COPY . /app
```

In order to change the NGINX Server Name currently there is only an override solution:

```
ENV NGINX_SERVERNAME=luya.io
RUN envsubst '${NGINX_SERVERNAME}' < /tmp/nginx.template > /etc/nginx/nginx.conf
```

## docker-compose

```yml
  luya_web:
    image: luyadev/luya-docker:nginx-fpm-php74
    ports:
      - "8080:80" 
    volumes:
      - ./:/app
```

Running the luya binaries:

```php
docker-compose run luya_web setup
```

or for a certain command

```php
docker-compose run luya_web luya {MY COMMAND}
```

## Testing

1. Build the image `docker build -t phpfpmimage .`
2. Run the image `docker run -p 1234:80 phpfpmimage`
