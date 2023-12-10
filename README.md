# Craft Project

Created by: Gustavo Morais

https://hub.docker.com/r/gustavovinicius/craft_nginx

The framework code is now at the cms folder

```
sudo docker commit 5906b1c1ecc1 craftstudybkp

in docker file FROM craftstudybkp

service --status-all
service nginx start
service php8.1-fpm start
service --status-all

```

### Troubleshooting commands
```sh
apt install -y php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-zip
apt install php8.1-imagick -y
service php8.1-fpm stop
service php8.1-fpm start
```
or
```sh
apt update
apt install php8.1-mbstring -y
apt install php8.1-xml -y
apt install php8.1-bcmath -y
apt install php8.1-curl -y
apt install php8.1-zip -y
apt install php8.1-intl -y
service php8.1-fpm stop
service php8.1-fpm start
composer install
```

### Create craft command
```
### Allow anonimous calls
```php
public array|bool|int $allowAnonymous = true;
```
### Create craft command
```sh
composer create-project craftcms/craft=^1 cms
```

### Docker NGINX Ubuntu Craft
```sh
docker pull gustavovinicius/craft_nginx:latest

# Build just the mysql container with the following credentials

```

### MySQL container
```yaml
mysql:
    image: mysql:5.7
    restart: always
    container_name: craftmysql
    ports:
        - 3306:3306
    environment:
        MYSQL_DATABASE: laravel
        MYSQL_ROOT_PASSWORD: laravel
    volumes:
        - ./dockerDBData:/var/lib/mysql
    networks:
        craft-app-network:
            ipv4_address: 12.0.0.8
```

### PHP Setup
```sh
apt-get update
apt -y install software-properties-common
add-apt-repository ppa:ondrej/php
apt-get update
apt -y install php8.1
apt-get install -y php8.1-cli php8.1-json php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath
apt-get install -y php8.1-fpm
service php8.1-fpm start
service php8.1-fpm status
service nginx start
service --status-all

```

### NGINX Setup
```sh
nano /etc/nginx/sites-available/gus
rm -rf /etc/nginx/sites-available/default
mv /etc/nginx/sites-available/gus /etc/nginx/sites-available/default
```

### NGINX Config sites-available/defaul
```
server {
    listen 80;
    server_name _;

    root /var/www/html/web;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt { access_log off; log_not_found off; }
    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Craft commands
```sh
php craft setup
https://localhost/index.php?p=admin/install # access and log as admin@email.com
```
### Try Catch Register Log Example
```php
try {
    // code ...
} catch (\Exception $e) {
    Craft::error([
    'type' => 'chamados-zendesk-senat',
    'message' => "{$e->getMessage()}",
    'file' => $e->getFile(),
    'line' => $e->getLine(),
    'details' => $e->getTrace(),
    ]);
}
```
