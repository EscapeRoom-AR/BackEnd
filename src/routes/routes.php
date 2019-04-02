<?php

$app->post('/register',		'\Controller\AuthController:register');

$app->get('/login',			'\Controller\AuthController:login');

$app->get('/user',			'\Controller\UserController:getUser');

$app->delete('/user',		'\Controller\UserController:deleteUser');

$app->get('/rooms',			'\Controller\RoomController:getRooms');

$app->get('/room/{code}',	'\Controller\RoomController:getRoom');

/*$app->put('/user',			'\API\API::updateUser');

$app->post('/game',			'API\API::createRoom');


$app->get('/hint/{hint}/{item}','\API\API:tmpAddHint');*/