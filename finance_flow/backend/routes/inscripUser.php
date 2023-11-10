<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if (!isset($_SESSION)) {
    session_start();
}
include '../class/User.php';

$content = trim(file_get_contents("php://input"));
$data = json_decode($content, true);

$user = new User();


    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];

    $user->inscripUser($name, $email, $password);



?>
