#!/bin/bash

if [ ! -d "${WORKDIR}/var" ]; then
    mkdir -p "${WORKDIR}/var"
    chmod 777 "${WORKDIR}/var"
fi

# # check database host availability
# $(pwd)/docker/shell/wait-for-it.sh "${POSTGRES_HOST}:5432" -s -t 30
# retval=$?

# # migrate database if host is available
# if [ $retval -eq 0 ]; then
#   php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration 1>&2
#   retval=$?

#   if [ $retval -ne 0 ]; then
#     exit $retval
#   fi
# fi

# start supervisor
supervisord -n -c /etc/supervisord.conf