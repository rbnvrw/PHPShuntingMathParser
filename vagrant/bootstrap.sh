#!/usr/bin/env bash

apt-get update
apt-get install -y apache2 php5 libapache2-mod-php5 git curl
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer global require "phpunit/phpunit=4.7.*"
