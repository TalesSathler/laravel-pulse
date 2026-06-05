# Stage 1: Base dependencies
FROM php:8.5-fpm AS base
RUN apt-get update && apt-get install -y \
    curl git unzip libpq-dev libpng-dev libicu-dev libzip-dev supervisor \
    && docker-php-ext-install pdo_pgsql pgsql gd intl zip bcmath pcntl \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www

# Stage 2: Local Development Environment
FROM base AS development
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

ENV PATH="/root/.config/composer/vendor/bin:${PATH}"

COPY docker/app/start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start
CMD ["start"]

# Stage 3: Asset Building
FROM development AS build
COPY . /var/www
RUN composer install --no-dev --optimize-autoloader \
    && npm install && npm run build

# Stage 4: Production Environment
FROM base AS production
COPY --from=build --chown=www-data:www-data /var/www /var/www
USER www-data
EXPOSE 9000
CMD ["php-fpm"]