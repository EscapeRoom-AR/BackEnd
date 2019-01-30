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
    $data = [];
    $status = 200;
    if (isset($args['id'])) {
      $id = $args['id'];
      $teacher = \API\Model\TeacherQuery::create()->findPK($id);
      if (!is_null($teacher)) $data = $teachers->toArray();
      else $status = 404;
    }
    else {
      $teachers = \API\Model\TeacherQuery::create()->find();
      $data = $teachers->toArray();
    }
    return $response->withJson($data, $status);
  }

  public function assignmentGET(Request $request, Response $response, array $args) {
    $assignments = \API\Model\AssignmentQuery::create()->find();
    $data = $assignments->toArray();
    return $response->withJson($data);
  }
};
