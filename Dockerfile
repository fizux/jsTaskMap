FROM php:7-apache
MAINTAINER <https://github.com/fizux/jsTaskMap>
# fork of <https://github.com/GlidingWeb/jsTaskMap>
ADD . /var/www/html
# ENV gmaps_api_token=
## You need to set an api token or the map will fail. Get one here:
## https://developers.google.com/maps/documentation/javascript/get-api-key
EXPOSE 80