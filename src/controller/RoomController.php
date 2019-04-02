<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \Model\HintQuery as HintQuery;
use \Model\RoomQuery as RoomQuery;
use \Utils\Token as Token;
use \DateTime as DateTime;
use \Model\User as User;

class RoomController extends Controller {

	// Returns all rooms. (GET: /rooms)
	// Requires token in header.
	public function getRooms(Request $request, Response $response, array $args) {
		if (!Token::auth($request)) { 
			return $this->getErrorTokenResp($response); 
		}
		$rooms = RoomQuery::create()->find();
		return $this->getOkResp($response, $rooms->toArray());
	}

	// Returns a specific room with all related data. (GET: /room/{code})
	// Requires token in header.
	public function getRoom(Request $request, Response $response, array $args) {
		if (!Token::auth($request)) { 
			return $this->getErrorTokenResp($response); 
		}
		$room = RoomQuery::create()->findPK($args['code']);
		if (is_null($room)) {
			return $this->getErrorResp($response, "Invalid room code.");
		} 
		$items = $room->getItems()->toArray();
		for ($i = 0; $i < count($items); $i++) {
			$items[$i]['hints'] = HintQuery::create()->filterByItemCode($items[$i]['Code'])->find()->toArray();	
		}
		$room = $room->toArray();
		$room['items'] = $items;
		return $this->getOkResp($response, $room);
	}

} 