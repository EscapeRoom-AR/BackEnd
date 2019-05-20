<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Controller {
	
	// Generates success response, to always have the same format.
	public function getOkResp(Response $response, array $data = []) {
		return $response->withJson(["code" => 1, "message" => "Ok", "data" => $data], 200);
	}

	// Generates error response, to always have the same format.
	public function getErrorResp(Response $response, string $message) {
		return $response->withJson(["code" => 0, "message" => $message], 200);
	}

	// Generates token error response.
	public function getErrorTokenResp(Response $response) {
		return $this->getErrorResp($response, "Invalid token");
	}

}