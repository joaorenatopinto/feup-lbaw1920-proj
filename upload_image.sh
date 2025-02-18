#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw2062 # Replace by your docker hub username
IMAGE_NAME=lbaw2062                 # Replace with your group's image name

# Ensure that dependencies are available
composer install
php artisan clear-compiled
php artisan optimize
php artisan route:clear #clear route cache to prevent crash

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
