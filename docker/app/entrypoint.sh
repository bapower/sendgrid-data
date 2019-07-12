#!/bin/sh

export DB_HOST=db \
       DB_DATABASE=$STDB_DATABASE \
       DB_USERNAME=$STDB_USER \
       DB_PASSWORD=$STDB_PASSWORD

while ! nc -z db 5432
do
    sleep 1
done

php artisan migrate

exec "$@"
