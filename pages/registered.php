<?php
$title = "Account Registered - BlueCare AgedCare";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
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
        <li><a href="login.html" class="btn">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Account Registered Message section -->
  <section class="success-message">
    <h2>🎉 Account Successfully Registered!</h2>
    <p>You will be redirected to the Home page shortly.</p>
    <a href="../index.php">Return to Home Now</a>
  </section>

  <!-- Simple redirect and timeout to index.php -->
  <script>
    setTimeout(() => {
      window.location.href = '../index.php';
    }, 5000);
  </script>
</body>
</html>
