# NINX with php fpm

Nginx with PHP 7.4 FPM on Port 80

## docker-compose

```yml
  luya_web:
    image: luyadev/luya-docker-nginx:php
    ports:
      - "8080:80" 
    volumes:
      - ./:/app
```


## Testing

1. Build the image `docker build -t phpfpmimage .`
2. Run the image `docker run -p 1234:80 phpfpmimage`
