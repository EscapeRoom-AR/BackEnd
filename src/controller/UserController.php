<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Utils\Token as Token;
use \DateTime as DateTime;
use \Model\User as User;

class UserController extends Controller {

	// Gets user information. (GET: /user)
	// Requires token in header.
	public function getUser(Request $request, Response $response, array $args) {
		$user = Token::auth($request);
		if (!$user) { 
			return $this->getErrorTokenResp($response); 
		}
		return $this->getOkResp($response, $user->toArray());
	}

	// Updates user information. (PUT: /user)
	// Requires token in header.
	// Params in body with form-data format: entire user in json.
	public function updateUser(Request $request, Response $response, array $args){
	    if (!Token::auth($request)) { 
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

	// Deletes user embedded in token. (DELETE: /user)
	// Requires token in header.
	public function deleteUser(Request $request, Response $response, array $args) {
		$user = Token::auth($request);
		if (!$user) { 
			return $this->getErrorTokenResp($response); 
		}
		$dateTime = new DateTime();
		$user->setDeletedat($dateTime);
		$user->save();
		return $this->getOkResp($response);
	}

} 