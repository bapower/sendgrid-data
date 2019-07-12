#!/bin/sh

set -e

if [ -f "vendor/STAMP" ]; then
    old=`cat vendor/STAMP`
    new=`cat /tmp/vendor/STAMP`
    if [ $old -ne $new ]; then
        echo "replacing vendor directory..."
        rm -rf vendor
        cp -r /tmp/vendor /html/
        composer install
        echo "vendor directory replaced."
    fi
else
    echo "placing vendor directory in working copy..."
    rm -rf vendor
    cp -r /tmp/vendor /html/
    composer install
    echo "vendor directory placed."
fi

exec entrypoint.sh "$@"
