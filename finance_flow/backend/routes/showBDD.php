<?php

if (!isset($_SESSION)) {
    session_start(); // Assurez-vous que la session est démarrée
}

include '../class/Compte.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// Utilisez $_GET pour récupérer le paramètre id_user
$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if ($id_user === null) {
    echo json_encode(['id_user' => $id_user]);
    die(); // Arrêtez l'exécution du script si id_user n'est pas défini
}

$compte = new Compte();
$compte->showBDD($id_user);
?>
