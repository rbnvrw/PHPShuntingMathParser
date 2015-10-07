#!/usr/bin/env bash
## Filelimit bug in Vagrant (Alleen voor Linux)
ulimit -n 50000

## SERVICES
service php5-fpm status
service php5-fpm stop
service php5-fpm start
service nginx status
service nginx stop
service nginx start