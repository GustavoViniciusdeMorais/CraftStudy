 #!/bin/bash
# echo "\n 2 135" | ./phpInstallSequence.sh
apt-get update
apt -y install software-properties-common
add-apt-repository ppa:ondrej/php
apt-get update
apt -y install php7.4
apt-get install -y php7.4-cli php7.4-json php7.4-common php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath
apt-get install -y php7.4-fpm
service php7.4-fpm start
service php7.4-fpm status
service nginx start
service --status-all