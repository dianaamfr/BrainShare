#!/bin/bash

docker run -it -p 8000:80 -v $PWD/html:/usr/share/nginx/html lbaw2152/lbaw2152-piu
