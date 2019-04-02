<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

# Useful for paths
define("SRC_DIR", dirname(__FILE__));

# Autoload dependencies
require_once('../vendor/autoload.php');

# Propel configuration
require_once('../model/generated-conf/config.php');

# Autoload controllers
require_once('controller/autoload.php');

# Create instance of slim app (configured to show errors)
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);

# Add API routes
require_once('routes/routes.php');

# Insert admin if no users registered
require_once('utils/adminuser.php');

# Bootstrap application
$app->run();