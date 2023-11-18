<?php

if (!isset($_SESSION)) {
    session_start();
}

include '../class/User.php';


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$user = new User();

// Récupérer les informations de l'utilisateur connecté
$connectedUser = $user->getConnectedUser();
  

// Répondre avec les informations de l'utilisateur connecté au format JSON
// header('Content-Type: application/json');
echo json_encode($connectedUser);
