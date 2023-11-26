<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,  // Utilisez true si vous utilisez HTTPS
    'httponly' => true,
    'samesite' => 'None',  // Utilisez 'None' si vous souhaitez permettre les requêtes cross-site
]);


if (!isset($_SESSION)){session_start();} // Assurez-vous que la session est démarrée

include '../class/Compte.php';
//  var_dump($_SESSION);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = file_get_contents("php://input");
    $data = json_decode($content, true);

    // Ajoutez une vérification pour vous assurer que $_SESSION["id"] existe avant de l'utiliser
    if (isset($_SESSION["id"])) {
        $id_user = $_SESSION["id"];
        echo json_encode(["debug" => $_SESSION["id"]]); // Imprimez la valeur de $_SESSION["id"]
        $compte = new Compte();
        echo json_encode(["debug" => $data, "id_user" => $id_user]);
        $compte->createCompte($data, $id_user);
    } else {
        echo json_encode(["error" => "User not authenticated"]);
    }
}
?>
