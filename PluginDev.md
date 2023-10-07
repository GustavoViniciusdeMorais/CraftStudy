# Plugin Dev

Created by Gustavo Morais

```sh
```

```sh
cd cms
composer require gustavomorais/craftexporter
php craft plugin/list
php craft plugin/install
handle: _exporter
```
### Troubleshooting commands
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