<?php

namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Propel\Runtime\ActiveQuery\Criteria as Criteria;
use \API\Model\HintQuery as HintQuery;
use \API\Model\RoomQuery as RoomQuery;
use \Utils\Token as Token;

class RoomController extends Controller {

	public function getRooms(Request $request, Response $response, array $args) {
		if (!Token::auth($request->getQueryParams()['token'])) { 
			return $this->getErrorTokenResp($response); 
		}
		$rooms = RoomQuery::create()->find();
		return $this->getOkResp($response, "Ok", $rooms->toArray());
	}

	public function getRoom(Request $request, Response $response, array $args) {
		if (!Token::auth($request->getQueryParams()['token'])) { 
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