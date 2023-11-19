<?php
// Start the session
session_start();

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
// Debug statement
echo "Déconnexion appelée";

// Destroy all sessions
session_destroy();

// Debug statement
echo "Session détruite";

// Redirect the user to the login page or any other desired page

exit();
