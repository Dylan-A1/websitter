<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Error</title>
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
    <h1>Registration Error</h1>
    <p>Your registration has encountered the following errors</p>
  </section>

  <section class="register-error-session">
    <?php
        require_once "./connectToDB.php";
        connecttodb(function ($connection) {
            // Make sure this page is accessed from submission
            if (isset($_POST['email'])) {
                // List of error messages
                $errormsgs = array();
                // Check input is email format
                if (preg_match("/^\w+\@([A-Za-z\-])+(\.[A-Za-z\-]+)+$/", $_POST['email'])) {
                    // Check email already exist
                    if (@mysqli_num_rows(@mysqli_query($connection, "SELECT `email` FROM patients WHERE `email`='{$_POST['email']}'")) > 0) {
                        // If account with posted email already exist
                        array_push($errormsgs, "User with email &#x93;<em>{$_POST['email']}</em>&#x94; is already created.");
                    }
                } else {
                    // If email is in a invalid format
                    array_push($errormsgs, "Invalid email format. Email must be in the following format:<br>(alphanumeric characters)@(domain).(domain)[.(domain)]");
                }

                // Password Check
                if ($_POST['password'] == "") {
                    // If password field is blank
                    array_push($errormsgs, "Password cannot be empty.");
                }

                // Check if any errors occured
                if (sizeof($errormsgs) == 0) {
                    // If there is no errors
                    // Create new patient
                    @mysqli_query($connection, "INSERT INTO patients VALUES(NULL, '{$_POST['firstName']}', '{$_POST['lastName']}', '{$_POST['dob']}', '{$_POST['email']}', '{$_POST['password']}', 2);");
                    header('Location: ../pages/registered.html');
                } else {
                    // If there are errors, list them and do not proceed registration
                    echo "<p>Your registration request encountered the following issues:</p><ul>";
                    foreach ($errormsgs as $errormsg) {
                        echo "<li>$errormsg</li>";
                    }
                    echo "</ul><a href='../pages/register.php'>Go Back</a>";
                }
            } else {
                header('Location: ../pages/register.php');
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
