FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/

# Install dependencies
RUN apt-get update && apt-get install -y \
    apt-utils \
    zlib1g \
    zip \
    vim \
    unzip \
    curl \
    iputils-ping \
    libpng-dev \
    libonig-dev \
    libxml2-dev \ 
    git \
    libsodium-dev

#libmagickwand-dev 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
#RUN pecl install imagick && docker-php-ext-enable imagick
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl 
RUN docker-php-ext-install gd
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install sodium

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN docker-php-ext-enable sodium

# Change current user to www
USER www

# Expose port 9001 and start php-fpm server
EXPOSE 9001
CMD ["php-fpm"]
