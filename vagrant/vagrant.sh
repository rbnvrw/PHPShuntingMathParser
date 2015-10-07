#!/usr/bin/env bash

## TIMEZONE
ln -sf /usr/share/zoneinfo/Europe/Amsterdam /etc/localtime

## Select nl mirrors for faster download
sed -i 's/us.archive/nl.archive/g' /etc/apt/sources.list

## PACKAGES
apt-get update
apt-get install -y python-software-properties
curl -sL https://deb.nodesource.com/setup_iojs_3.x | sudo -E bash -
apt-get update
apt-get install -y nginx php5-fpm curl php5-curl php5-json php5-mysql php5-cli php5-imap php-pear php5-dev php5-xdebug default-jre php5-gd ghostscript iojs git php5-memcached memcached
locale-gen nl_NL.UTF-8
locale-gen de_DE.UTF-8
update-locale

## NGINX CONFIG
rm /etc/nginx/sites-enabled/default
ln -s /vagrant/vagrant.nginx /etc/nginx/sites-enabled/default

mkdir /vagrant/logs

if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

if ! [ -L /bin/phpunit ]; then
  ln -fs /vagrant/vendor/bin/phpunit /bin/phpunit
fi

## PHP Settings
upload_max_filesize=16M
post_max_size=16M
max_execution_time=60
short_open_tag=On
max_input_vars=100000


# short_open_tag for CLI
sed -i "s/short_open_tag = .*/short_open_tag = On/" /etc/php5/cli/php.ini

## Fix timezone errors
pecl install timezonedb
echo 'extension=timezonedb.so'> /etc/php5/mods-available/timezonedb.ini
ln -sf /etc/php5/mods-available/timezonedb.ini /etc/php5/fpm/conf.d/30-timezonedb.ini

for key in upload_max_filesize post_max_size max_execution_time short_open_tag max_input_vars
do
  sed -i "s/^\($key\).*/\1 $(eval echo =\${$key})/" /etc/php5/fpm/php.ini
done

echo "xdebug.remote_enable = on" >> /etc/php5/fpm/php.ini
echo "xdebug.remote_connect_back = on" >> /etc/php5/fpm/php.ini
echo "xdebug.profiler_enable = 0" >> /etc/php5/fpm/php.ini
echo "xdebug.profiler_enable_trigger = 1" >> /etc/php5/fpm/php.ini
echo "xdebug.profiler_output_dir = \"/vagrant/logs\"" >> /etc/php5/fpm/php.ini

# creating swap
sudo fallocate -l 4G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo "/swapfile   none    swap    sw    0   0" | sudo tee -a /etc/fstab
sudo sysctl vm.swappiness=10
echo "vm.swappiness=10" | sudo tee -a /etc/sysctl.conf
sudo sysctl vm.vfs_cache_pressure=50
echo "vm.vfs_cache_pressure=50" | sudo tee -a /etc/sysctl.conf
