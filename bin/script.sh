#!/bin/sh
echo "PULLING..........."
git pull
echo "DELETING MIGRATIONS............"
rm -rf model/generated-migrations/*
echo "EXECUTING COMPOSER............."
composer update
echo "EXECUTING UPDATE..............."
srvUpdateSchema
echo "...........DONE!..............."
