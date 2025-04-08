<?php
require_once 'mfa.php';
require_once 'auth_functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The email is retrieved from session storage which defaults to an empty string if not found
    $email = $_SESSION['otp_email'] ?? '';
    // The OTP code is retrieved from POST data which defaults to an empty string if not found
    $otp = $_POST['otp'] ?? '';
    if ($_OTP->challenge($email, $otp)) {
        // If the OTP is correct, the user will be logged in
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // The user's ID, email and name is stored in the session 
        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name']; // optional
            $_SESSION['role_id'] = $user['role_id']; // useful for role-based access
        
            unset($_SESSION['otp_email']);
        
            header("Location: ../pages/dashboard.php");
            exit();
        }        
    } else {
        $error = $_OTP->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP | BlueCare AgedCare</title>
    <link rel="stylesheet" href="../public/css/index/styles.css">
</head>
<body>
      <!-- This contains the navigation bar and the buttons -->
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

    <div class="otp-container">
        <h2>Enter OTP</h2>
        <?php if (!empty($error)): ?>
            <div class="note error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="otp-form-group">
                <label for="otp">One-Time Password</label>
                <input type="text" id="otp" name="otp" required>
            </div>

            <input type="submit" value="Verify OTP" class="btn">
        </form>
    </div>
</body>
</html>
