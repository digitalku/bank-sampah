# Bank Sampah

## Table of Contents

- [Tentang](#tentang)
- [Instalasi](#instalasi)
  - [Persyaratan server](#persyaratan-server)
  - [Unduh source code](#unduh-source-code)
  - [Konfigurasi](#konfigurasi)
    - [Environment](#environment)
    - [Konfigurasi Apache](#konfigurasi-apache)
    - [Konfigurasi Nginx](#konfigurasi-nginx)
    - [Konfigurasi Shared hosting/other](#shared-hostingother)
- [Kontribusi](#kontribusi)
- [License](#license)

## Tentang

Sebuah aplikasi untuk mendorong masyarakat untuk menabung pakai sampah dengan sistem modern yang dibuat dengan laravel.

## Instalasi

### Persyaratan server

Perangkat lunak berikut diperlukan di server Anda untuk menjalankan bank sampah.

- Memiliki access SSH/Terminal (Untuk menjalankan perintah artisan)
- Apache, nginx, IIS, or httpd (Apache preferred)
- PHP >= 7.3
- MariaDB or MysSQL >= 5.5, SQLite alternatively
- Composer
- Git (Untuk clone/update source code) (Optional)
- PHP requirements
  - BCMath PHP Extension
  - Ctype PHP Extension
  - Fileinfo PHP Extension
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

### Unduh source code

Jika Anda ingin mengunduh versi stabil, Anda dapat melihat di [halaman rilis](https://github.com/jayahost/bank-sampah/release).

Anda juga dapat melakukan clone dengan menjalankan command

```sh
# clone bank sampah
git clone https://github.com/jayahost/bank-sampah.git --depth=1
```

### Install `composer` dependencies

```sh
# download composer package
curl -sS https://getcomposer.org/installer | php
# update/install dependencies
php composer.phar install --no-dev --prefer-dist
```

if you was already have composer inside you system, you just run `composer`.

```sh
# update/install dependencies
composer install --no-dev --prefer-dist
```

### Konfigurasi

#### Environment

Buat file `.env` sebagai konfigurasi aplikasi, Anda dapat menyalin contoh dari `.env.example`.

Anda juga dapat menggunakan command berikut

```sh
cp .env.example .env
```

#### Konfigurasi Apache

Untuk menjalankan Bank Sampah di Apache,
Anda perlu membuat file konfigurasi Apache baru di folder konfigurasi Apache Anda (e.g /etc/apache2/sidtes-enabled atau /etc/httpd/sites-enabled)
Atau dengan membuat virtual host baru seperti:

Ganti `example.com` dengan alamat Anda, dan restart apache setelah selesai.

```apache
<VirtualHost *:80>
    ServerName example.com
    ServerAlias example.com

    DocumentRoot "/var/www/bank-sampah/public"
    <Directory "var/www/bank-sampah/public>
        Require all granted
        Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    <Directory>
</VirtualHost>
```

Jika `mode_rewrite` belum diaktifkan, Anda harus mengaktifkanya seperti:

```apache
# enable mode_rewrite
a2enmod rewrite
# restart apache di Ubuntu
# sudo service apache2 restart

# restart apache di Fedora/CentOS
# sudo service httpd restart
```

#### Konfigurasi nginx

Ganti `example.com` dengan alamat Anda. Anda perlu menginstall `php-fpm`:

```sh
sudo apt install php-fpm
```

Jika anda melakukan instalasi LEMP dari ['DigitalOcean']('https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-20-04')

```nginx
# Upstream to abstract backend connection(s) for php
upstream php {
    server unix:/var/run/php-fpm.sock;
    server 127.0.0.1:9000;
}

# HTTP

server {
    listen       *:80;
    root         /var/www/bank-sampah/public;
    index        index.php index.html index.htm;
    server_name  example.com; # Domain yang anda gunakan

#   return 301 https://$server_name$request_uri; # Forces HTTPS, which enables privacy for login credentials.
                                                 # Recommended for public, internet-facing, websites.

    location / {
            try_files $uri $uri/ /index.php$is_args$args;
            # rewrite ^/([a-zA-Z0-9]+)/?$ /index.php?$1;
    }

    location ~ \.php$ {
            try_files $uri =404;
            include /etc/nginx/fastcgi_params;

            fastcgi_pass    php;
            fastcgi_index   index.php;
            fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param   HTTP_HOST       $server_name;
    }
}


# HTTPS

#server {
#   listen              *:443 ssl;
#   ssl_certificate     /etc/ssl/my.crt;
#   ssl_certificate_key /etc/ssl/private/my.key;
#   root                /var/www/bank-sampah/public;
#   index index.php index.html index.htm;
#   server_name         example.com;
#
#   location / {
#           try_files $uri $uri/ /index.php$is_args$args;
#           # rewrite ^/([a-zA-Z0-9]+)/?$ /index.php?$1;
#   }
#
#   location ~ \.php$ {
#           try_files $uri =404;
#           include /etc/nginx/fastcgi_params;
#
#           fastcgi_pass    php;
#           fastcgi_index   index.php;
#           fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
#           fastcgi_param   HTTP_HOST       $server_name;
#   }
#}
```

##### Shared hosting/other

Untuk menjalankan Bank Sampah di shared hostring, anda harus set home directory ke `/PATH_TO_BANK_SAMPAH/public`, jangan di root folder.

Atau jika anda menggunakan cPanel, anda dapat membuat file `.htaccess` seperti berikut untuk menetapkan request ke public directory.

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## Kontribusi

Terimakasih telah mempertimbangkan untuk berkontribusi pada Bank Sampah!

## License

Bank Sampah is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
