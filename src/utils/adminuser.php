<?php

$users = \Model\UserQuery::create()->find()->toArray();
if (count($users) != 0) { return; }
$user = new User();
$user->setUsername("admin");
$user->setPassword("escape.room");
$user->setEmail("escape.room.ar@gmail.com");
$dateTime = new DateTime();
$user->setCreatedat($dateTime->getTimestamp());
$user->save();