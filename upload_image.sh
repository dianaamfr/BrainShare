#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=YOUR_DOCKER_ACCOUNT # Replace by your docker hub username
IMAGE_NAME=lbaw21GG-piu

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
