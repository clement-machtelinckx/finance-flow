<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


if (!isset($_SESSION)) {session_start();}
// Route dans votre backend (server.php par exemple)
include '../class/Compte.php';

$compte = new Compte(); // Remplacez Compte par le nom réel de votre classe

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $compte->createCompte($compte_name, $solde);
}

?>
