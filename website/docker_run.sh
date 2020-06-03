#!/bin/bash
set -e

cd /var/www; php artisan config:cache
env >> /var/www/.env
php-fpm7.2 -D
nginx -g "daemon off;"

# add cron job into cronfile
echo "* * * * * cd /var/www && php artisan schedule:run >> /dev/null 2>&1" >> cronfile
# install cron job
crontab cronfile
# rm tmp file
rm cronfile