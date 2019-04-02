<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Utils\Token as Token;

class UserController extends Controller {

	public function register(Request $request, Response $response, array $args) {
		$paramMap = $request->getParsedBody();
		if ($paramMap['email'] == null || $paramMap['username'] == null || $paramMap['password'] == null) {
			return $this->getErrorResp($response, "Email, username, or password were not provided.");
		}
		$user = \API\Model\UserQuery::create()->filterByUsername($paramMap['username'])->find()->getFirst();
		if ($user) {
			return $this->getErrorResp($response, "Username in use.");
		}
		$user = \API\Model\UserQuery::create()->filterByEmail($paramMap['email'])->find()->getFirst();
		if ($user) {
			return $this->getErrorResp($response, "Email in use.");
		}
		$user = new User();
		$user->setUsername($paramMap['username']);
		$user->setPassword($paramMap['password']);
		$user->setEmail($paramMap['email']);
		$dateTime = new DateTime();
		$user->setCreatedat($dateTime->getTimestamp());
		$user->save();
		return $this->getOkResp($response, "Registered successfully", Array("token" => $this->generateToken($user)));
	}

	public function login(Request $request, Response $response, array $args) {
		$paramMap = $request->getQueryParams();
		if (is_null($paramMap['username']) || is_null($paramMap['password'])) { 
			return $this->getErrorResp($response, "Username or password were not provided.");
		}
		$user = \API\Model\UserQuery::create()
			->filterByUsername($paramMap['username'])
			->filterByPassword($paramMap['password'])
			->filterByDeletedat(null)
			->find()->getFirst();
		if (!$user) { 
			return $this->getErrorResp($response, "Invalid credentials."); 
		}
		return $this->getOkResp($response, Array("token" => $this->generateToken($user)));
	}

	public function getUser(Request $request, Response $response, array $args) {
		$user = Token::auth($request->getQueryParams()['token']);
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