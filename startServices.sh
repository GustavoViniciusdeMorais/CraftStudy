 #!/bin/bash
service --status-all
service nginx start
# apt install -y php8.1-fpm
# apt install php8.1-mbstring -y
# apt install php8.1-xml -y
# apt install php8.1-bcmath -y
# apt install php8.1-curl -y
# apt install php8.1-zip -y
# apt install php8.1-intl -y
service php8.1-fpm start
service --status-all