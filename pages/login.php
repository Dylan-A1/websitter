<?php
require_once 'mfa.php';
require_once 'auth_functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gets submitted email and password from the POST data, defaulting to an empty string when it is not provided
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Develops an SQL query to retrieve user data that corresponds to the specified email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verifies the existence of a user and confirms whether the provided password 
        // corresponds to the stored hashed password
        if ($user && password_verify($password, $user['password'])) {
            // OTP is generated and is sent to the user's email
            if ($_OTP->generate($email)) {
                // Stores the user's email in the session for future verification
                $_SESSION['otp_email'] = $email;
                // Directs the user to the OTP verification page
                header("Location: enterotp.php?action=login");
                exit();
            } else {
                $error = $_OTP->error;
            }
        } else {
            $error = "Email or password is not valid";
        }
    } catch (PDOException $e) {
        $error = "Database error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BlueCare AgedCare</title>
    <link rel="stylesheet" href="../public/css/index/styles.css">  <!-- External CSS file -->
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">BlueCare AgedCare</div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="login.php" class="btn">Login</a></li>
            <li><a href="register.php" class="btn-outline">Register</a></li>
        </ul>
    </nav>
</header>

<div class="main-content">
    <div class="hero">
        <h1>Welcome</h1>
        <p>Access your BlueCare AgedCare account</p>
    </div>
    
    <div class="login-section">
        <div class="login-box">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <div class="note error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form method="post" action="login.php">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Login" class="btn">
            </form>
            
            <p class="register-link">
                Don't have an account? <a href="register.php">Register here</a>
            </p>
        </div>
    </div>
</div>

<footer>
    &copy;  2025 BlueCare AgedCare. All rights reserved.
</footer>
</body>
</html>