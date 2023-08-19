#!/bin/bash

## Set COMPOSER HOME env var ##
export COMPOSER_HOME=/var/cache/.composer

## Composer Install ##
composer update --no-interaction

sleep 10

## drop database ##
php bin/console doctrine:database:drop --if-exists --force --no-interaction

## create database ##
php bin/console doctrine:database:create --if-not-exists --no-interaction

## Run database migrations ##
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration 

## Wait for database container be up ##
sleep 10

## Run database migrations prod ##
php bin/console doctrine:fixtures:load --no-interaction

## Start PHP-FPM in Foreground mode ##
php-fpm -F