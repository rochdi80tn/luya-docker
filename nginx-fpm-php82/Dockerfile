FROM ubuntu:22.10
RUN apt update -y
RUN apt install software-properties-common -y
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php 
RUN apt-get update -y
RUN apt-get install -y php8.2 \
    nginx supervisor gettext-base \
    curl