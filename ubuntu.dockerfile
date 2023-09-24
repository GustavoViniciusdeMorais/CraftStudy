# FROM ubuntu:jammy
FROM gustavovinicius/craft_nginx:php8

RUN apt update

RUN apt install nginx -y

RUN apt install nano -y

RUN apt install curl -y

RUN apt update

RUN apt install systemctl -y

ADD ./nginx/default.conf /etc/nginx/sites-available/default

# # RUN mkdir /var/www/mysite

# # RUN mkdir /var/www/other

WORKDIR /var/www/html


ENTRYPOINT ["tail", "-f", "/dev/null"]