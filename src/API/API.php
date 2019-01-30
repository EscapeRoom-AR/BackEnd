<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class API {
  public function helloGET(Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
  }

  public function teacherGET(Request $request, Response $response, array $args) {
    $teachers = \API\Model\TeacherQuery::create()->find();
    $data = $args;
    return $response->withJson($data);
  }

  public function assignmentGET(Request $request, Response $response, array $args) {
    $assignments = \API\Model\AssignmentQuery::create()->find();
    $data = $assignments->toArray();
    return $response->withJson($data);
  }
};
