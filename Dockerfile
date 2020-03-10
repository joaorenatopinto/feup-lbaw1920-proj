FROM php:7.2-apache
COPY src/ /var/www/html/

# Start command
COPY docker_run.sh /docker_run.sh
CMD sh /docker_run.sh
