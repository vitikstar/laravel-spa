
# Використовуємо офіційний образ Ubuntu 22.04 LTS
FROM ubuntu:22.04

# Оновлюємо пакети та встановлюємо необхідні інструменти
RUN apt-get update && apt-get install -y software-properties-common

# Встановлюємо репозиторій Ondrej Sury для PHP 8.1
RUN add-apt-repository ppa:ondrej/php

ENV DEBIAN_FRONTEND=noninteractive


# Встановлюємо Apache, PHP 8.0 та необхідні розширення PHP
RUN apt-get update && apt-get install -y apache2 php8.2 libapache2-mod-php8.2 php8.2-mysql php8.2-xml git php8.2-curl php8.2-zip unzip



# Встановлюємо Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Копіюємо конфігурацію Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

COPY .docker/db/init.sql /docker-entrypoint-initdb.d/init.sql

RUN a2ensite 000-default

# Увімкнення Apache-модулів
RUN a2enmod rewrite
RUN a2enmod headers

# Встановлюємо стандартну робочу директорію
# Копіюємо джерело вашої бібліотеки в контейнер
COPY . /var/www


# Встановлюємо залежності та генеруємо автозавантажувач Composer
WORKDIR /var/www

RUN cd /var/www && composer install


# Встановлюємо порт 80
EXPOSE 80

# Запускаємо Apache-сервер при старті контейнера
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]


