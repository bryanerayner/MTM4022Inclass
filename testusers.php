<?php


require_once("includes/db.inc.php");
require_once("includes/users.php");


$newUser = new User(array("userName"=>"frank", "pass"=>"ddd",	"email"=>"querty", "playName"=>"ddd", "country"=>"ddd", "credit"=>"ddd", "characterType"=>1), $pdo);
$newUser->save();


$newUser = new User(12, $pdo);
$newUser->user_username = "Modified this!";
$newUser->save();


?>