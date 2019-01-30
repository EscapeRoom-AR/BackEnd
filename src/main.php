<?php
# DEBUGGING ERRORS (REMOVE IN PRODUCTION)
ini_set("display_errors", 1);
error_reporting(E_ALL | E_STRICT);

# Class autoloader
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$api = new API();
$slim = new \Slim\App();
$slim->get('/hello/{name}', array($api, 'getHello'));
$slim->run();