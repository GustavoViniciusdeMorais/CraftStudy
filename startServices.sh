 #!/bin/bash
service --status-all
service nginx start
service php7.4-fpm start
service --status-all