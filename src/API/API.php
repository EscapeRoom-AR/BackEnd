<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;

class API extends \Slim\App {

  public function __construct() {
    $settings = [ 'displayErrorDetails' => true ];
    parent::__construct(['settings' => $settings]);

    // Define the ROUTES
    $slim->get('/hello/{name}',            '/API/API/helloGET');
    $slim->get('/json',                    [$this,'jsonGET']);
    $slim->get('/teacher',                 [$this,'teachersGET']);
    $slim->get('/teacher/{id}',            [$this,'teacherGET']);
    $slim->get('/teacher/search/{search}', [$this,'teacherSearchGET']);
    $slim->get('/assignment[/{id}]',       [$this,'assignmentGET']);
  }

  public static function helloGET(Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
  }

  public function jsonGET(Request $request, Response $response, array $args) {
    $data = [ 
      'data' => 'Hello!', 
      'success' => 1 
    ];
    return $response->withJson($data);
  }

  public function teachersGET(Request $request, Response $response, array $args) {
    $teachers = \API\Model\TeacherQuery::create()->find();
    $data = $teachers->toArray();
    return $response->withJson($data);
  }

  public function teacherGET(Request $request, Response $response, array $args) {
    $id = $args['id'];
    $teacher = \API\Model\TeacherQuery::create()->findPK($id);
    if (is_null($teacher)) {
      return $response->withJson([], 404);
    } 
    else {
      $data = $teacher->toArray();
      $data['AssignmentCount'] = $teacher->getAssignmentCount();
      $data['TotalHours'] = $teacher->getTotalHours();
      $data['Assignments'] = $teacher->getAssignments()->toArray();
      return $response->withJson($data);
    }
  }

  public function teacherSearchGET(Request $request, Response $response, array $args) {
    $search = trim($args['search']);
    $search = empty($search) ? '%' : ('%' . $search . '%');
    $teachers = \API\Model\TeacherQuery::create()->filterByName($search, Criteria::LIKE)->orderByName()->find();
    return $response->withJson($teachers->toArray());
  }

  public function assignmentGET(Request $request, Response $response, array $args) {
    $data = [];
    $status = 200;
    if (isset($args['id'])) {
      $id = $args['id'];
      $assignment = \API\Model\AssignmentQuery::create()->findPK($id);
      if (!is_null($assignment)) $data = $assignment->toArray();
      else $status = 404;
    }
    else {
      $assignments = \API\Model\AssignmentQuery::create()->find();
      $data = [];
      foreach($assignments as $assignment) {
        $info = $assignment->toArray();
        $teacher = $assignment->getTeacher();
        if (!is_null($teacher)) {
          $info['Teacher'] = $teacher->toArray();
        }
        $data[] = $info;
      }
    }
    return $response->withJson($data, $status);
  }
};
