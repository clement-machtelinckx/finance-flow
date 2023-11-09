<?php

// Route dans votre backend (server.php par exemple)
include '../class/Compte.php';

$compte = new Compte(); // Remplacez Compte par le nom réel de votre classe

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $compte->createCompte($compte_name, $solde);
}

?>
