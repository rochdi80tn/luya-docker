# luya-docker

LUYA Docker Images for Production Servers

Example Project Dockerfile

```
FROM luyadev/luya-docker:nginx-fpm

COPY --chown=nobody . /var/www/html/
```