#!/bin/sh
git pull
rm -rf model/generated-migrations/*
composer update
srvUpdateSchema
