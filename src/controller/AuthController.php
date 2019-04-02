<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Utils\Token as Token;
use \DateTime as DateTime;
use \Model\User as User;
use \Model\UserQuery as UserQuery;

class AuthController extends Controller {

	// Registers a user, returns token and created user. (POST: /register)
	// Params in body in form-data format: email, username, password.
	public function register(Request $request, Response $response, array $args) {
		$params = $request->getParsedBody();
		if (is_null($params['email']) || is_null($params['username']) || is_null($params['password'])) {
			return $this->getErrorResp($response, "Email, username, or password were not provided.");
		}
		$user = UserQuery::create()->filterByUsername($params['username'])->find()->getFirst();
		if ($user) {
			return $this->getErrorResp($response, "Username in use.");
		}
		$user = UserQuery::create()->filterByEmail($params['email'])->find()->getFirst();
		if ($user) {
			return $this->getErrorResp($response, "Email in use.");
		}
		$user = new User();
		$user->setUsername($params['username']);
		$user->setPassword($params['password']);
		$user->setEmail($params['email']);
		$dateTime = new DateTime();
		$user->setCreatedat($dateTime->getTimestamp());
		$user->save();
		return $this->getOkResp($response, ["token" => Token::generateToken($user), "user" => $user->toArray()]);
	}

	// Logs in a user, returns token and the user.  (GET: /login)
	// Params in url: username, password.
	public function login(Request $request, Response $response, array $args) {
		$params = $request->getQueryParams();
		if (is_null($params['username']) || is_null($params['password'])) { 
			return $this->getErrorResp($response, "Username or password were not provided.");
		}
		$user = UserQuery::create()
			->filterByUsername($params['username'])
			->filterByPassword($params['password'])
			->filterByDeletedat(null)
			->find()->getFirst();
		if (!$user) { 
			return $this->getErrorResp($response, "Invalid credentials."); 
		}
		return $this->getOkResp($response, Array("token" => Token::generateToken($user)));
	}


}