#!/usr/bin/env bash

echo -e "\n--- Installing Composer for PHP package management ---\n"
curl --silent https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod 777 /usr/local/bin/composer

# cd to vagrant on SSH
echo "cd /vagrant" >> ~/.bashrc