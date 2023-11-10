<?php
include '../class/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user->inscripUser($name, $email, $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Inscription</title>
</head>
<body>

<form method="post" action="">
    <label>
        Nom:
        <input type="text" name="name" value="clement" />
    </label>
    <br />
    <label>
        Email:
        <input type="email" name="email" value="clem@gmail.com" />
    </label>
    <br />
    <label>
        Mot de passe:
        <input type="password" name="password" value="1234" />
    </label>
    <br />
    <button type="submit">Tester l'inscription</button>
</form>

</body>
</html>
