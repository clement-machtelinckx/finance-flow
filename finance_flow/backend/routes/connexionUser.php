<?php

if (!isset($_SESSION)) {
    session_start();
}

include '../class/User.php';

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// Vérifier si des données POST ont été envoyées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le contenu JSON de la requête
    $content = file_get_contents("php://input");
    // Décoder le JSON en un tableau associatif
    $data = json_decode($content, true);

    // Créer une instance de la classe User
    $user = new User();

    // Appeler la méthode connectUser avec les données POST
    $user->connecUser($data);
}
