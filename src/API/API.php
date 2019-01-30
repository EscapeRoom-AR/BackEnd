<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class API {
  public function getHello(Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
  }

  public function getAssignments(Request $request, Response $response, array $args) {
    $assignments = \API\Model\AssignmentQuery::create()->find();
    $data = $assignments->toJson();
    return $response->withJson($data);
  }
};
