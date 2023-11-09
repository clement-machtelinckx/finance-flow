<?php
session_start();
include '../class/User.php';

$user = new User;

$email = "holal";    

$userInfo = $user->getUserInfos($email); // Utilisez une variable distincte pour éviter de réécrire $user

header('Content-Type: application/json');
$userInfoJSON = json_encode($userInfo); // Utilisez la variable correcte ici
echo $userInfoJSON;
