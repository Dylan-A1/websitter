<?php
require_once 'mfa.php';
require_once 'auth_functions.php';

$error = '';
$success = false;

// Gets submitted email, password and name from the POST data, defaulting to an empty string when it is not provided
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $firstName = $_POST['firstName'] ?? '';
  $lastName = $_POST['lastName'] ?? '';
  $dob = $_POST['dob'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? 'patient'; // default role

  // Validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Email format is not correct";
  } elseif (strlen($password) < 8) {
      $error = "Password should have a minimum of 8 characters";
  } elseif (!in_array($role, ['patient', 'staff', 'doctor', 'nurse', 'admin'])) {
      $error = "Invalid role selected";
  } else {
      // Get role_id from roles table
      $roleStmt = $pdo->prepare("SELECT id FROM roles WHERE role_name = ?");
      $roleStmt->execute([$role]);
      $roleRow = $roleStmt->fetch();
      $roleId = $roleRow['id'] ?? null;

      if (!$roleId) {
          $error = "Could not determine role ID.";
      } else {
          // Check if user already exists
          $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
          $stmt->execute([$email]);

          if ($stmt->rowCount() > 0) {
              $error = "Email has already been registered";
          } else {
              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
              $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, date_of_birth, email, password, role_id) VALUES (?, ?, ?, ?, ?, ?)");

              if ($stmt->execute([$firstName, $lastName, $dob, $email, $hashedPassword, $roleId])) {
                  if ($_OTP->generate($email)) {
                      $_SESSION['otp_email'] = $email;
                      header("Location: enterotp.php?action=register");
                      exit();
                  } else {
                      $error = $_OTP->error;
                  }
              } else {
                  $error = "Registration could not be completed.";
              }
          }
      }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BlueCare AgedCare</title>
    <link rel="stylesheet" href="../public/css/index/styles.css"> 
</head>
<body>
  <!-- Navigation Bar -->
  <header>
    <nav class="navbar">
      <div class="logo">BlueCare AgedCare</div>
      <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="login.php" class="btn">Login</a></li>
        <li><a href="register.php" class="btn-outline active">Register</a></li>
      </ul>
    </nav>
  </header>

    <!-- Title Section -->
  <section class="hero">
    <h1>Create a New Account</h1>
    <p>Please fill out the form below to register as a patient.</p>
  </section>

  <!-- Main Form -->
  <section class="register-section">
    <div class="register-box">
      <h2>Create a New Account</h2>

      <?php if ($error): ?>
        <div class="note error"><?= htmlspecialchars($error) ?></div>
      <?php elseif ($success): ?>
        <div class="note success">Registration successful! <a href="registered.php">Login now</a>.</div>
      <?php endif; ?>

      <?php if (!$success): ?>
        <form method="POST" class="patient-form">
          <input type="text" name="firstName" placeholder="First Name" required value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>"/>
          <input type="text" name="lastName" placeholder="Last Name" required value="<?= htmlspecialchars($_POST['lastName'] ?? '') ?>"/>
          <input type="date" name="dob" placeholder="Date of Birth" required value="<?= htmlspecialchars($_POST['dob'] ?? '') ?>"/>
          <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"/>
          <input type="password" name="password" placeholder="Password (min 8 characters)" required />
          <button type="submit" class="btn">Register</button>
        </form>
        <p class="login-link">Already have an account? <a href="login.php">Login here</a>.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 BlueCare AgedCare. All rights reserved.</p>
  </footer>
</body>
</body>
</html>
