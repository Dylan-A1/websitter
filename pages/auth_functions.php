<?php
session_start();

require_once("initialise_databases.php");

if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', 'iam_database');
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8mb4');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');

// Constructs the data source name string using constants for database host, name and character set
try {
    $pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
	
	// Initialise the tables
	$pdo->exec($create_roles_table);
	$stmt = $pdo->prepare("SELECT * FROM roles");
	$stmt->execute();
	$result = $stmt->fetchColumn(); 
	if ($result == false) {
		$pdo->exec($add_roles);
	}
	$pdo->exec($create_user_table);
	$pdo->exec($create_otp_table);
} catch (PDOException $e) {
    die("Connection to database has failed: " . $e->getMessage());
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectIfLoggedIn() {
    if (isLoggedIn()) {
        header("Location: dashboard.php");
        exit();
    }
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}
