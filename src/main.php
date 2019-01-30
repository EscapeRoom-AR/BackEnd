<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);
    $assignments = \Model\AssignmentQuery::create()->find();

# Class autoloader
require '../vendor/autoload.php';

$api = new API();
$slim = new \Slim\App();
$slim->get('/hello/{name}', array($api, 'getHello'));
$slim->get('/assignments', array($api, 'getAssignments'));
$slim->run();