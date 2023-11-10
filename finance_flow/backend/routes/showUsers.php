<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if (!isset($_SESSION)) {session_start();}

include '../class/User.php';

$user = new User;

$email = "holal";    

$userInfo = $user->getUserInfos($email); // Utilisez une variable distincte pour éviter de réécrire $user

header('Content-Type: application/json');
$userInfoJSON = json_encode($userInfo); // Utilisez la variable correcte ici
echo $userInfoJSON;
