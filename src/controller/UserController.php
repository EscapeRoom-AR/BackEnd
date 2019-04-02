<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Utils\Token as Token;
use \DateTime as DateTime;
use \Model\User as User;

class UserController extends Controller {

	public function getUser(Request $request, Response $response, array $args) {
		//$user = Token::auth($request->getQueryParams()['token']);
		$user = Token::auth($request->getHeader('Authorization')[0]);
		//return $response->withJson(["code" => 1, "message" => "Ok", "data" => ["token" => $request->getHeader('Authorization')]], 200);
		if (!$user) { 
			return $this->getErrorTokenResp($response); 
		}
		return $this->getOkResp($response, $user->toArray());
	}

	public function updateUser(Request $request, Response $response, array $args){
	    if (!Token::auth($request->getParsedBody()['token'])) { 
			return $this->getErrorTokenResp($response); 
		}
	    $newUser = $request->getParsedBody()['user'];
        $user->setUsername($user->getUsername());
        $user->setEmail($user->getEmail());
        $user->setPassword($user->getPassword());
        $user->setPremium($user->getPremium());
        $user->setImage($user->getImage());
        $user->setDescription($user->getDescription());
        $user->save();
        return $this->getOkResp($response, Array("user" => $user->toArray()));
    }

	public function deleteUser(Request $request, Response $response, array $args) {
		$user = Token::auth($request->getParsedBody()['token']);
		if (!$user) { 
			return $this->getErrorTokenResp($response); 
		}
		$dateTime = new DateTime();
		$user->setDeletedat($dateTime);
		$user->save();
		return $this->getOkResp($response);
	}

} 