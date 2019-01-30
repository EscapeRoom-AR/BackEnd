<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

# Class autoloader & propelorm config
require_once('../vendor/autoload.php');
require_once('../model/generated-conf/config.php');

# Slim init
$settings['displayErrorDetails'] = true;
$slim = new \Slim\App(['settings' => $settings]);

# Routes
$api = new \API\API();
$slim->get('/hello/{name}', array($api, 'helloGET'));
$slim->get('/json', array($api, 'jsonGET'));
$slim->get('/teacher', array($api, 'teachersGET'));
$slim->get('/teacher/{id}', array($api, 'teacherGET'));
$slim->get('/teacher/search/{id}', array($api, 'teacherSearchGET'));
$slim->get('/assignment[/{id}]', array($api, 'assignmentGET'));

# Execute the request
$slim->run();