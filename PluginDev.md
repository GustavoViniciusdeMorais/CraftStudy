# Plugin Dev

Created by Gustavo Morais

```sh
```

### Requirements
- [craft make](https://github.com/craftcms/generator)
  - [doc](https://craftcms.com/docs/4.x/extend/generator.html)
  - composer require craftcms/generator --dev
  - php craft make

### Build plugin
```sh
php craft make plugin
```

### Fix the package path inside plugin composer
```json
{
    "name": "gustavo-morais/crafts-citext"
}
```
This is the right way
```json
{
    "name": "gustavomorais/craftscitext"
}
```

### Install plugin example
```sh
cd cms
composer require gustavomorais/craftscitext
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
```