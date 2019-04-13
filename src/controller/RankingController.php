<?php

namespace Controller;


use Model\GameQuery;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class RankingController extends Controller
{

    public function getRankings(Request $request, Response $response, array $args)
    {
        define('hintTime', 150000); //Time in miliseconds of 2.5minutes
        if (!Token::auth($request)) {
            return $this->getErrorTokenResp($response);
        }

        $games = GameQuery::create()->find();

        if (count($games) > 0) {

            for ($i = 0; $i < count($games); $i++) {
                $games[i]->setTime($games[i]->getTime() + ($games[i]->getHintsUsed() * hintTime));
            }
            usort($games, 'gamesComparator');
        }
        return $this->getOkResp($response, $games->toArray());
    }

    private function gamesComparator($game1, $game2)
    {
        return $game1->getTime() - $game2->getTime();
    }
}