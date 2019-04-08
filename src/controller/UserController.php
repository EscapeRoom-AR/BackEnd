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
        $user = Token::auth($request);
        if (!$user) {
            return $this->getErrorTokenResp($response);
        }
        $paramMap = $request->getParsedBody();
	    $newUser = $paramMap['user'];

        //Storing image
        define('UPLOAD_DIR','../../files/');
        $dir = exec('dir');
        $img = $request->base64;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);

        $user->setUsername($user->getUsername());
        $user->setEmail($user->getEmail());
        $user->setPassword($user->getPassword());
        $user->setPremium($user->getPremium());
        $user->setImage($file);
        $user->setDescription($user->getDescription());
        $user->save();
        return $this->getOkResp($response, Array("user" => $dir->toArray()));
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