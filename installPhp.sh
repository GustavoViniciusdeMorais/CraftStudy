 #!/bin/bash
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