FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    software-properties-common \
    npm
RUN npm install npm@latest -g && \
    npm install n -g && \
    n latest

# Set working directory
WORKDIR /var/www/hospital


# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install node
#RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
#RUN apt-get install nodejs -y

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/hospital

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/hospital

# Change current user to www
USER www

RUN composer install
RUN php artisan optimize:clear
#RUN npm install
#RUN npm run dev

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
