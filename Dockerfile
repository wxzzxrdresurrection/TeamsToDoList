FROM php:8.3-cli

# Establecer el directorio de trabajo
WORKDIR /app

# Copiar el contenido del proyecto al contenedor
COPY . /app

# Copiar el script de espera
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    netcat-openbsd \
    chromium \
    chromium-driver \
    xvfb \
    npm && \
    docker-php-ext-install zip pcntl pdo_mysql

ENV PATH="/usr/lib/chromium:/usr/lib/chromium/chromedriver:$PATH"

# Instalar dependencias de PHP y npm
RUN composer install
RUN npm install

# Instalar Laravel Dusk
RUN composer require --dev laravel/dusk && php artisan dusk:install

# Configurar permisos
RUN chmod -R 777 storage bootstrap/cache

# Exponer puertos
EXPOSE 8000 5173

# Inicia Xvfb y el servidor
#CMD ["composer run dev"]

CMD /bin/bash
