<?php
require_once 'auth_functions.php';

// Resets the $_SESSION variables to an empty array
$_SESSION = array();

// Ends the current session and deletes every session data from the SQL server
session_destroy();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
    );
}

// The user is redirected to the login page
header("Location: ../index.php");
exit();
?>
