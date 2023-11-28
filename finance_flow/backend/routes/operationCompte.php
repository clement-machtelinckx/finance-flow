<?php

if (!isset($_SESSION)) {
    session_start(); // Assurez-vous que la session est démarrée
}

include '../class/Compte.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$content = file_get_contents("php://input");
$data = json_decode($content, true);

if (isset($data['id'], $data['montant'], $data['operationType'])) {
    // Récupérer les valeurs des clés
    $id_compte = $data['id'];
    $montant = $data['montant'];
    $operationType = $data['operationType'];
    
    // Instancier votre classe ou appeler votre fonction
    $compte = new Compte();
    
    // Appeler la méthode operationBDD avec les données reçues
    $compte->operationBDD($id_compte, $montant, $operationType);
} elseif ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Répondre avec une erreur si la requête n'est pas de type POST
    echo json_encode(["error" => "Méthode non autorisée"]);
} else {
    // Répondre avec une erreur si des clés sont manquantes
    echo json_encode(["error" => "Données manquantes"]);
}

?>
