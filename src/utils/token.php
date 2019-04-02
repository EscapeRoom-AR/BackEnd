<?php

namespace Utils;

use \API\Model\User as User;

class Token {

	private static $secret_key = '^cbV&Q@DeA4#pHuGaaVx';

	// Generates a token from a User object.
	public static function generateToken(User $user) {
		$header= Token::base64url_encode(json_encode(array('alg'=> 'HS256', 'typ'=> 'JWT')) );
		$payload = Token::base64url_encode($user->getCode());
		$signature= Token::base64url_encode(hash_hmac('sha256', $header. '.'. $payload, Token::$secret_key, true));
		return $header. '.'. $payload. '.'. $signature;
	}

	// Returns false if token is incorrect, a User object otherwise.
	public static function auth($token) {
		if (!isset($token) || $token == "") { 
			return false; 
		}
		$jwt_values = explode('.', $token);
		$signature = Token::base64url_encode(hash_hmac('sha256', $jwt_values[0]. '.'. $jwt_values[1], Token::$secret_key, true));
		if ($jwt_values[2] != $signature) { 
			return false; 
		}
		$user = \API\Model\UserQuery::create()->findPK(Token::base64url_decode($jwt_values[1]));
		if ($user->getDeletedat() != null) { 
			return false; 
		}
		return $user;
	}

	// Encode to base64 in a uri friendly way.
	public static function base64url_encode($data) {
	  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
	}

	// Decode from uri friendly base64. 
	public static function base64url_decode($data) {
	  return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
	} 
}