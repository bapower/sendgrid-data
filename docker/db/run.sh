#!/bin/sh

export POSTGRES_USER="$STDB_USER" \
       POSTGRES_PASSWORD="$STDB_PASSWORD" \
       POSTGRES_DB="$STDB_DATABASE"

exec /docker-entrypoint.sh "$@"
