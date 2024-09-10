# Usa la imagen base de PHP-FPM
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    apache2 \
    supervisor 

# Limpiar los paquetes de apt-get para reducir el tamaño de la imagen
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar las extensiones de PHP
RUN docker-php-ext-configure zip
RUN docker-php-ext-install pdo_mysql mysqli mbstring exif pcntl bcmath gd zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . /var/www/html

RUN chown www-data:www-data -R *
# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader
RUN a2enmod rewrite
# Configurar Nginx
COPY docker/apache/default.conf /etc/apache2/sites-enabled/000-default.conf

# Configurar Supervisor para gestionar PHP-FPM y Nginx
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Crear el directorio para Supervisor
RUN mkdir -p /var/run/supervisor

# Exponer puertos
EXPOSE 80

# Comando por defecto
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
