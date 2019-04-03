<?php

$app->post('/register',		'\Controller\AuthController:register');

$app->get('/login',			'\Controller\AuthController:login');

$app->get('/user',			'\Controller\UserController:getUser');

$app->delete('/user',		'\Controller\UserController:deleteUser');

$app->put('/user',			'\Controller\UserController:updateUser');

$app->get('/rooms',			'\Controller\RoomController:getRooms');

$app->get('/room/{code}',	'\Controller\RoomController:getRoom');

/*
$app->post('/game',			'API\API::createRoom');


$app->get('/hint/{hint}/{item}','\API\API:tmpAddHint');*/