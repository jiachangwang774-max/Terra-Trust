FROM php:8.1-apache

# 安装依赖
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl

# 安装 PHP 扩展
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip

# 安装 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 设置工作目录
WORKDIR /var/www/html

# 复制项目文件
COPY . .

# 安装项目依赖
RUN composer install --no-interaction

# 生成应用密钥
RUN php artisan key:generate

# 运行数据库迁移
RUN php artisan migrate --seed

# 设置文件权限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 启用 Apache 重写模块
RUN a2enmod rewrite

# 配置 Apache 虚拟主机
COPY ./public/.htaccess /var/www/html/public/.htaccess

# 启动 Apache
CMD ["apache2-foreground"]