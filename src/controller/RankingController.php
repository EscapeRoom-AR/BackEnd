<?php
/**
 * Created by PhpStorm.
 * User: alexc
 * Date: 03/04/2019
 * Time: 15:37
 */

namespace Controller;


class RankingController extends Controller
{

    public function getRankings()
    {
        $hintTime = 150000; //Time in miliseconds of 2.5minutes
        $games = GameQuery::create()->find();
    }
}