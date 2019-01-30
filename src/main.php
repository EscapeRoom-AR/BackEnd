<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

# Class autoloader & propelorm config
require_once('../vendor/autoload.php');
require_once('../model/generated-conf/config.php');

$api = new \API\API();
$slim = new \Slim\App();
$slim->get('/hello/{name}', array($api, 'getHello'));
$slim->get('/assignments', array($api, 'getAssignments'));
$slim->run();