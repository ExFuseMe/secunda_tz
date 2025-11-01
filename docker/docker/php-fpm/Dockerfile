FROM php:8.4.6-fpm

# Arguments defined in docker-compose.yml
ARG UID=1000
ARG GID=2000
ENV UID=${UID}
ENV GID=${GID}

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nano \
    libssl-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mbstring exif pcntl bcmath sockets opcache zip

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/6.2.0.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && docker-php-ext-install redis

COPY docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD www.conf /usr/local/etc/php-fpm.d/www.conf

COPY --from=composer:2.8.8 /usr/bin/composer /usr/bin/composer

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd --gid $GID api \
    && useradd --uid $UID --gid $GID --shell /bin/bash --create-home api \
    && mkdir -p /home/api/.composer \
    && chown -R api:api /home/api

WORKDIR /source
RUN chown -R api:api /source

CMD ["php-fpm"]
