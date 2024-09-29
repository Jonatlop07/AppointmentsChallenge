FROM php:8.1-fpm

RUN apt-get update

# Install useful tools
RUN apt-get -y install apt-utils nano wget dialog vim

# Install system dependencies
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-install \
    exif \
    pcntl \
    bcmath \
    ctype \
    curl \
    pcntl \
    zip 

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/

# Copy composer files and download dependencies
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Copy the app
COPY . .

# Execute autoload and optimize compose installation
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port
EXPOSE 9000

CMD ["php-fpm"]