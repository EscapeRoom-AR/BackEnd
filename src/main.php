<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

# Useful for paths
define("SRC_DIR", dirname(__FILE__));

# Class autoloader & propelorm config
require_once('../vendor/autoload.php');
require_once('../model/generated-conf/config.php');

# Do the magic
$api = new \API\API();
$api->run();