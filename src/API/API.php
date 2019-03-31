<?php

namespace API;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \DateTime as DateTime;
use \API\Model\User as User;

class API extends \Slim\App {

	public function __construct() {
		$settings = [ 'displayErrorDetails' => true ];
		parent::__construct(['settings' => $settings]);
		
		$this->post('/register',				'\Api\API:register');
		$this->get('/login',					'\Api\API:login');
		$this->delete('/user',					'\Api\API:deleteUser');


		/*
		$this->get('/room/{code}/{name}',				        '\API\API:tmpAddRoom');
		$this->get('/item/{code}/{room}/{name}/{qr}',			'\API\API:tmpAddItem');
		$this->get('/hint/{hint}/{item}',							'\API\API:tmpAddHint');
		$this->get('/room/{code}',								'\API\API:getRoom');
		$this->get('/rooms',									'\API\API:getRooms');
		$this->get('/items/{room}',								'\API\API:getItems');
		$this->get('/hints/{item}',								'\API\API:getHints');
		$this->get('/hello/{name}',								'\API\API:helloGET');
		$this->get('/json',										[$this,'jsonGET']);
		$this->get('/teacher',									[$this,'teachersGET']);
		$this->get('/teacher/{id}',								[$this,'teacherGET']);
		$this->get('/teacher/search/{search}',					[$this,'teacherSearchGET']);
		$this->get('/assignment[/{id}]',						[$this,'assignmentGET']);
		$this->get('/table',									[$this,'tableGET']);
		*/
	}

	public static function register(Request $request, Response $response, array $args) {
		$paramMap = $request->getParsedBody();
		if ($paramMap['email'] == null || 
			$paramMap['username'] == null || 
			$paramMap['password'] == null) 
		{
			return $response->withJson([], 404);
		}
		$user = new User();
		$user->setUsername($paramMap['username']);
		$user->setPassword($paramMap['password']);
		$user->setEmail($paramMap['email']);
		$dateTime = new DateTime();
		$user->setCreatedat($dateTime->getTimestamp());
		$user->save();
		return $response->withJson(Array("token" => \API\API::generateToken($user)),200);
	}

	public static function login(Request $request, Response $response, array $args) {
		$paramMap = $request->getQueryParams();
		if ($paramMap['username'] == null || $paramMap['password'] == null) { return $response->withJson([], 404); }
		$user = \API\Model\UserQuery::create()
			->filterByUsername($paramMap['username'])
			->filterByPassword($paramMap['password'])
			->find()->getFirst();
		if (!$user) { return $response->withJson([], 404); }
		return $response->withJson(Array("token" => \API\API::generateToken($user)),200);
	}

	public static function deleteUser(Request $request, Response $response, array $args) {
		$paramMap = $request->getParsedBody();
		$token = $paramMap['token'];
		$user = \API\API::checkAuthentication($token);
		if (!$user) { return $response->withJson(["code" => 0], 404); }
		$user = \API\Model\UserQuery::create()->findPK($user->getCode());
		if (!$user) { return $response->withJson(["code" => 0], 404); }
		$dateTime = new DateTime();
		$user->setDeletedat($dateTime);
		$user->save();
		return $response->withJson(["code" => 1, "message" => "User deleted successfully"], 200);
	}

	public static function generateToken(User $user) {
		$header= base64_encode(json_encode(array('alg'=> 'HS256', 'typ'=> 'JWT')) );
		$payload= base64_encode(json_encode($user->toArray()));
		$secret_key= '^cbV&Q@DeA4#pHuGaaVx';
		$signature= base64_encode(hash_hmac('sha256', $header. '.'. $payload, $secret_key, true));
		$jwt_token= $header. '.'. $payload. '.'. $signature;
		return $jwt_token;
	}

	public static function checkToken($token) {
		$secret_key= '^cbV&Q@DeA4#pHuGaaVx';
		$jwt_values= explode('.', $token);
		$header=$jwt_values[0];
		$payload= $jwt_values[1];
		$signature= $jwt_values[2];
		$resultedsignature= base64_encode(hash_hmac('sha256', $header. '.'. $payload, $secret_key, true));
		return $resultedsignature == $signature;
	}

	public static function checkAuthentication($token){
		if (isset($token) && $token != "" && \API\API::checkToken($token))
		{
			$jwt_values = explode('.', $token);
			$payload = base64_decode($jwt_values[1]);
			$user = new User();
			$user->fromArray(json_decode($payload,true));
			return $user;
		}
		return false;
	}

	public static function payloadToUser($payload) {
		
	}

	/*
  public static function getRoom(Request $request, Response $response, array $args) {
	$code = $args['code'];
	$room = \API\Model\RoomQuery::create()->filterByCode($code)->find();
	if (is_null($room) || empty($room)) {
      return $response->withJson([], 404);
  } 
	return $response->withJson($room->toArray()[0]);
  }

  public static function getRooms(Request $request, Response $response, array $args) {
	$rooms = \API\Model\RoomQuery::create()->find();
	if (is_null($rooms) || empty($rooms)) {
      return $response->withJson([], 404);
  } 
	return $response->withJson($rooms->toArray());
  }

  public static function getItems(Request $request, Response $response, array $args) {
	$items = \API\Model\ItemQuery::create()->filterByRoomId($args['room'])->find();
	if (is_null($items) || empty($items)) {
      return $response->withJson([], 404);
    } 
	return $response->withJson($items->toArray());
  }

  public static function getHints(Request $request, Response $response, array $args) {
	$hints = \API\Model\RoomQuery::create()->filterByRoomId($args['id'])->find();
	if (is_null($hints) || empty($hints)) {
      return $response->withJson([], 404);
    } 
	return $response->withJson($hints->toArray());
  }
  

  public static function tmpAddRoom(Request $requuest, Response $response, array $args) {
  	  $room = new \API\Model\Room();
	  $room->setCode($args['code']);
	  $room->setName($args['name']);
	  $room->setPremium(true);
	  $room->save();
	  $response->getBody()->write("Room: ".$args['code'].",".$args['name']);
	  return $response;
  }

  public static function tmpAddItem(Request $requuest, Response $response, array $args) {
  	  $item = new \API\Model\Item();
	  $item->setCode($args['code']);
	  $item->setRoomId($args['room']);
	  $item->setName($args['name']);
	  $item->setQrCode($args['qr']);
	  $item->save();
	  $response->getBody()->write("Item: ".$args['code'].",".$args['name']);
	  return $response;
  }

    public static function tmpAddHint(Request $requuest, Response $response, array $args) {
  	  $room = new \API\Model\Room();
	  $room->setCode($args['code']);
	  $room->setName($args['name']);
	  $room->setPremium(true);
	  $room->save();
	  $response->getBody()->write("Room: ".$args['code'].",".$args['name']);
	  return $response;
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

  public function tableGET($request, $response, $args) {
    $loader = new \Twig_Loader_Filesystem(SRC_DIR . '/templates');
    $twig = new \Twig_Environment($loader, ['cache' => false]);
    $assignments = \API\Model\AssignmentQuery::create()->find();
    $rows = [];
    foreach($assignments as $assignment) {
      $info = $assignment->toArray();
      $teacher = $assignment->getTeacher();
      $info['Teacher'] = !is_null($teacher) ? $teacher->getName() : '-';
      $rows[] = $info;
    }
    $params = ['Assignments' => $rows];
    $html = $twig->render('table.html', $params);
    $response->getBody()->write($html);
    return $response;
  }*/

};
