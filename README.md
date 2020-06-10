# LUYA DOCKER

Production Ready LUYA Docker Images including Webservers.

Example Project Dockerfile

```
FROM luyadev/luya-docker:nginx-fpm

COPY --chown=nobody . /var/www/html/
```

## Docker Build Testing

1. Build the image `docker build -t testimage .`
2. Run the image `docker run -p 8080:8080 testimage`