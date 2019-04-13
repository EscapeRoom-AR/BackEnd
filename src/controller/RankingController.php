<?php

namespace Controller;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class RankingController extends Controller
{

    public function getRankings(Request $request, Response $response, array $args)
    {
        define('hintTime', 150000); //Time in miliseconds of 2.5minutes

        $games = GameQuery::create()->find();
        for ($i = 0; $i < count($games); $i++) {
            $games[i]->time = $games[i]->time + ($games[i]->hintsUsed * hintTime);
        }
        usort($games, 'gamesComparator');

        return $games;
    }

    private function gamesComparator($game1, $game2)
    {
        return $game1->time - $game2->time;
    }
}