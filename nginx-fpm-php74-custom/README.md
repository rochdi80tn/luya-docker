https://github.com/wemakewaves/php-docker-bench/tree/master/custom-fpm

based on https://medium.com/@wemakewaves/migrating-our-php-applications-to-docker-without-sacrificing-performance-1a69d81dcafb

## TESTING

docker build -t phpcustom . && docker run -p 1234:80 phpcustom