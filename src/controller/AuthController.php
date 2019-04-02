<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Utils\Token as Token;
use \DateTime as DateTime;
use \Model\User as User;

class AuthController extends Controller {

	public function register(Request $request, Response $response, array $args) {
		$paramMap = $request->getParsedBody();
		if ($paramMap['email'] == null || $paramMap['username'] == null || $paramMap['password'] == null) {
			return $this->getErrorResp($response, "Email, username, or password were not provided.");
		}
		$user = \Model\UserQuery::create()->filterByUsername($paramMap['username'])->find()->getFirst();
		if ($user) {
			return $this->getErrorResp($response, "Username in use.");
		}
		$user = \Model\UserQuery::create()->filterByEmail($paramMap['email'])->find()->getFirst();
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
		return $this->getOkResp($response, Array("token" => Token::generateToken($user)));
	}

	public function login(Request $request, Response $response, array $args) {
		$paramMap = $request->getQueryParams();
		if (is_null($paramMap['username']) || is_null($paramMap['password'])) { 
			return $this->getErrorResp($response, "Username or password were not provided.");
		}
		$user = \Model\UserQuery::create()
			->filterByUsername($paramMap['username'])
			->filterByPassword($paramMap['password'])
			->filterByDeletedat(null)
			->find()->getFirst();
		if (!$user) { 
			return $this->getErrorResp($response, "Invalid credentials."); 
		}
		return $this->getOkResp($response, Array("token" => Token::generateToken($user)));
	}


}