FROM nginx:stable-alpine

RUN apk add openrc --no-cache
RUN mkdir -p /run/openrc
RUN touch /run/openrc/softlevel

ADD ./nginx/default.conf /etc/nginx/conf.d/default.conf