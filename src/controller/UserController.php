<?php

namespace Controller;

class UserController {

	public function register(Request $request, Response $response, array $args) {
		$paramMap = $request->getParsedBody();
		if ($paramMap['email'] == null || $paramMap['username'] == null || $paramMap['password'] == null) {
			return Api::getErrorResp($response, "Email, username, or password were not provided.");
		}
		$user = \API\Model\UserQuery::create()->filterByUsername($paramMap['username'])->find()->getFirst();
		if ($user) {
			return Api::getErrorResp($response, "Username in use.");
		}
		$user = \API\Model\UserQuery::create()->filterByEmail($paramMap['email'])->find()->getFirst();
		if ($user) {
			return Api::getErrorResp($response, "Email in use.");
		}
		$user = new User();
		$user->setUsername($paramMap['username']);
		$user->setPassword($paramMap['password']);
		$user->setEmail($paramMap['email']);
		$dateTime = new DateTime();
		$user->setCreatedat($dateTime->getTimestamp());
		$user->save();
		return Api::getOkResp($response, "Registered successfully", Array("token" => Api::generateToken($user)));
	}

	public function login(Request $request, Response $response, array $args) {
		$paramMap = $request->getQueryParams();
		if (is_null($paramMap['username']) || is_null($paramMap['password'])) { 
			return Api::getErrorResp($response, "Username or password were not provided.");
		}
		$user = \API\Model\UserQuery::create()
			->filterByUsername($paramMap['username'])
			->filterByPassword($paramMap['password'])
			->filterByDeletedat(null)
			->find()->getFirst();
		if (!$user) { 
			return Api::getErrorResp($response, "Invalid credentials."); 
		}
		return Api::getOkResp($response, "Valid credentials", Array("token" => Api::generateToken($user)));
	}

	public function getUser(Request $request, Response $response, array $args) {
		$token = $request->getQueryParams()['token'];
		$user = Api::auth($token);
		if (!$user) { 
			return Api::getErrorResp($response, "Token is incorrect."); 
		}
		return Api::getOkResp($response, "Ok", $user->toArray());
	}

	public function updateUser(Request $request, Response $response, array $args){
	    $token = $request->getParsedBody()['token'];
	    $newUser = $request->getParsedBody()['user'];
	    $user = Api::auth($token);
        if (!$user) {
            return Api::getErrorResp($response, "Token is incorrect.");
        }
        $user->setUsername($user->getUsername());
        $user->setEmail($user->getEmail());
        $user->setPassword($user->getPassword());
        $user->setPremium($user->getPremium());
        $user->setImage($user->getImage());
        $user->setDescription($user->getDescription());
        $user->save();
        return Api::getOkResp($response, "User updated successfully", Array("user" => $user->toArray()));
    }

	public function deleteUser(Request $request, Response $response, array $args) {
		$token = $request->getParsedBody()['token'];
		$user = Api::auth($token);
		if (!$user) { 
			return Api::getErrorResp($response, "Token is incorrect."); 
		}
		$dateTime = new DateTime();
		$user->setDeletedat($dateTime);
		$user->save();
		return Api::getOkResp($response, "User deleted successfully.");
	}

} 