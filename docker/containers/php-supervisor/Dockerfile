FROM php:8.4.6-cli

# Arguments defined in docker-compose.yml
ARG UID=1000
ARG GID=2000
ENV UID=${UID}
ENV GID=${GID}

# Установка пакетов
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nano \
    supervisor \
 && docker-php-ext-install \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    sockets \
    opcache \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Оптимизация опкэша
COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/
ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Composer
COPY --from=composer:2.8.8 /usr/bin/composer /usr/bin/composer

# Установка расширения redis
RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/6.2.0.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

########################## Add api User ##########################
RUN groupadd --gid $GID api \
  && useradd --uid $UID --gid www-data --shell /bin/bash --create-home api

########################## SUPERVISOR ##########################
RUN mkdir -p /var/log/supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
WORKDIR /source

CMD ["/usr/bin/supervisord"]
