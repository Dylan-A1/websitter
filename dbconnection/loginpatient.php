<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Error</title>
  <link rel="stylesheet" href="../public/css/index/styles.css"> 
</head>
<body>

  <!-- This contains the navigation bar and the buttons -->
  <header>
      <nav class="navbar">
      <div class="logo">BlueCare AgedCare</div>
        <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="../pages/about.html">About</a></li>
        <li><a href="../pages/services.html">Services</a></li>
        <li><a href="../pages/contact.html">Contact</a></li>
        <li><a href="../pages/login.php" class="btn-outline">Login</a></li>
        <li><a href="../pages/register.php" class="btn">Register</a></li>
        </ul>
    </nav>
  </header>
  <!-- Main title section -->
  <section class="hero">
    <h1>Login Error</h1>
    <p>Your login has encountered the following errors</p>
  </section>

  <section class="login-error-session">
    <?php
        require_once "./connectToDB.php";
        connecttodb(function ($connection) {
            // Make sure this page is accessed from submission
            if (isset($_POST['email'])) {
                // List of error messages
                $errormsgs = array();
                // Wait until form is submitted
                if ($_POST['email'] == "") {
                    // If email field is empty
                    array_push($errormsgs, "Email cannot be empty.");
                } else if (@mysqli_num_rows(@mysqli_query($connection, "SELECT `email` FROM patients WHERE `email`='{$_POST['email']}'")) == 0) {
                    // If email is not registered
                    array_push($errormsgs, "Email &#x93;<em>{$_POST['email']}</em>&#x94; is not created.");
                }

                // Password Check
                if ($_POST['password'] == "") {
                    // If password field is empty
                    array_push($errormsgs, "Password cannot be empty.");
                } else if (@mysqli_num_rows(@mysqli_query($connection, "SELECT `email`, `password` FROM patients WHERE `email`='{$_POST['email']}' AND `password`='{$_POST['password']}'")) == 0) {
                    // Password does not match
                    array_push($errormsgs, "Password is incorrect.");
                }

                // Check if any errors occured
                if (sizeof($errormsgs) == 0) {
                    // If there is no errors
                    session_start();
                    $_SESSION['email'] = $_POST['email'];
                    $loggedInUser = mysqli_fetch_row(@mysqli_query($connection, "SELECT `first_name`, `last_name` FROM patients WHERE `email`='{$_POST['email']}'"));
                    $_SESSION['firstname'] = $loggedInUser[0];
                    $_SESSION['lastname'] = $loggedInUser[1];
                    header("Location: ../pages/dashboard.php");
                } else {
                    // If there are errors, list them and do not proceed login
                    echo "<p>Your registration request encountered the following issues:</p><ul>";
                    foreach ($errormsgs as $errormsg) {
                        echo "<li>$errormsg</li>";
                    }
                    echo "</ul><a href='../pages/login.php'>Go Back</a>";
                }
            } else {
                header('Location: ../pages/login.php');
            }
        });
    ?>
  </section>

  <!-- Basic Footer -->
  <footer>
    <p>&copy; 2025 BlueCare AgedCare. All rights reserved.</p>
  </footer>
</body>
</html>

