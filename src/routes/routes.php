<?php

$app->post('/register',		'\Controller\UserController:register');

$app->get('/login',			'\Controller\UserController:login');

/*$app->get('/user',			'\Api\API:getUser');

$app->delete('/user',		'\Api\API:deleteUser');

$app->get('/rooms',			'\API\API:getRooms');

$app->get('/room/{code}',	'\API\API:getRoom');

$app->put('/user',			'\API\API::updateUser');

$app->post('/game',			'API\API::createRoom');


$app->get('/hint/{hint}/{item}','\API\API:tmpAddHint');*/