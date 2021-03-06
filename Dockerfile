FROM php:8-apache

# Copy static HTML pages (when building a new image)
COPY src /var/www/html

