

<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if (!isset($_SESSION)) {
    session_start();
}

include '../class/User.php';

// Lire directement le corps de la requête POST
// ...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = file_get_contents("php://input");
    $data = json_decode($content, true);

    $user = new User();
    $user->inscripUser($data);
}
// ...


