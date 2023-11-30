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

    // Ajoutez une vérification pour vous assurer que $data existe avant de l'utiliser
    if (isset($data['id']) && isset($data['compte_name']) && isset($data['solde']) && $data['compte_name'] !== "" && $data['solde'] !== "") {
        $id_user = $data["id"];
    
        $compte = new Compte();

        $compte->createCompte($data);
        echo json_encode(["result" => "success"]);

    } else {
        echo json_encode(["error" => "User not authenticated"]);
    }
}
?>
