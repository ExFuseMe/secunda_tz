FROM nginx:1.20

RUN mkdir -p /etc/nginx/cert && \
	mkdir -p /etc/nginx/conf.d

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano \
    htop \
    apache2-utils

COPY ./conf.d/ /etc/nginx/conf.d/
COPY ./etc/html /usr/share/nginx/html
COPY ./etc/json-errorpages /usr/share/nginx/json-errorpages
COPY ./etc/errorpages.conf /etc/nginx/errorpages.conf
COPY ./etc/nginx.conf /etc/nginx/nginx.conf

ARG BASIC_USERNAME
ARG BASIC_PASSWORD
RUN htpasswd -bnB ${BASIC_USERNAME} ${BASIC_PASSWORD} > /etc/nginx/conf.d/.htpasswd
