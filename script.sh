#!/bin/sh
echo "PULLING....."
git pull
echo "DELETING MIGRATIONS............"
rm -rf model/generated-migrations/*
composer update
srvUpdateSchema
