#!/bin/bash
set -e

# Render sets $PORT at runtime. Default to 10000 if not set.
PORT=${PORT:-10000}

echo "Starting Apache on port $PORT..."

# Replace the port in Apache config at RUNTIME (not build time)
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/g" /etc/apache2/sites-available/000-default.conf

# Ensure Apache can read PHP env vars (for DB credentials)
for VAR in DB_HOST DB_NAME DB_USER DB_PASS DB_PORT AIVEN_PASS; do
    VALUE="${!VAR}"
    if [ -n "$VALUE" ]; then
        echo "SetEnv $VAR $VALUE" >> /etc/apache2/conf-enabled/environment.conf
    fi
done

exec apache2-foreground
