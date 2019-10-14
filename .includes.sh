#!/bin/sh

alias _composer="docker run --rm -it -v `pwd`:/app -w /app composer:latest composer"
alias _phpunit="docker-compose exec fpm php vendor/bin/phpunit"
