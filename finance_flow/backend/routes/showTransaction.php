<?php

if (!isset($_SESSION)) {
    session_start(); // Assurez-vous que la session est démarrée
}

include '../class/Compte.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// Utilisez $_GET pour récupérer le paramètre id_user
$id_compte = isset($_GET['id_compte']) ? $_GET['id_compte'] : null;

if ($id_compte === null) {
    echo json_encode(['id_compte' => $id_compte]);
    die(); // Arrêtez l'exécution du script si id_user n'est pas défini
}

$compte = new Compte();
$compte->showTransaction($id_compte);
?>
