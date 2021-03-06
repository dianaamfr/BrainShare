#!/bin/bash

docker run -it -p 8000:80 -v $PWD/src:/var/www/html lbaw2152/lbaw2152-piu
