<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,  // Utilisez true si vous utilisez HTTPS
    'httponly' => true,
    'samesite' => 'None',  // Utilisez 'None' si vous souhaitez permettre les requêtes cross-site
]);

if (!isset($_SESSION)) {
    session_start(); // Assurez-vous que la session est démarrée
}

include '../class/Compte.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = file_get_contents("php://input");
    $data = json_decode($content, true);
    
    if (isset($data['id'])) {
        $compte = new Compte();
        $compte->deleteCompte($data['id']);
    } else {
        echo json_encode(["error" => "L'ID du compte n'a pas été fourni dans la requête."]);
    }
}
?>
