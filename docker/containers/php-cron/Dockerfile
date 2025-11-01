FROM php:8.4.6-cli

# Arguments defined in docker-compose.yml
ARG UID=1000
ARG GID=2000
ENV UID=${UID}
ENV GID=${GID}

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano

RUN apt-get install -y cron && which cron && \
    rm -rf /etc/cron.*/*

RUN  docker-php-ext-install mysqli pdo_mysql mbstring exif pcntl bcmath sockets opcache
COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

COPY --from=composer:2.8.8 /usr/bin/composer /usr/bin/composer

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/6.2.0.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /source

########################## Add API User ##########################
RUN groupadd --gid $GID api \
  && useradd --uid $UID --gid www-data --shell /bin/bash --create-home api

RUN mkdir /var/log/cron
RUN touch /var/log/cron/cron.log && chmod 666 /var/log/cron/cron.log

########################## CRONTAB ##########################
RUN echo "* * * * * api php /source/artisan schedule:run >> /var/log/cron/cron.log 2>&1" >> /etc/crontab
CMD ["cron","-f", "-l", "2"]
