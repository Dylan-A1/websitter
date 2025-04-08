<?php
require_once 'mfa.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request OTP | BlueCare AgedCare</title>
    <link rel="stylesheet" href="../public/css/index/styles.css"> 
    <style>
        * {
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        html, body {
            height: 100%;
        }
        
        body {
            background-color: #f5f9ff;
            color: #333;
            display: flex;
            flex-direction: column;
        }
        
    
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        nav {
            display: flex;
            gap: 1.5rem;
        }
        
        nav a {
            color: white;
            text-decoration: none;
        }
        
        .auth-buttons {
            display: flex;
            gap: 1rem;
        }
        
        .auth-buttons a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
        }
        
        .auth-buttons a:last-child {
            background-color: white;
            color: #1a73e8;
        }
        
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
           
        }
        
        .main-content {
            flex: 1;
        }
        
        .container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .container h2 {
            color: #1a73e8;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        label {
            font-weight: bold;
            color: #555;
        }
        
        input[type="email"] {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        input[type="submit"] {
            background-color: #1a73e8;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }
        
        input[type="submit"]:hover {
            background-color: #0d5bba;
        }
        
        .note {
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 4px;
            text-align: center;
        }
        
        .success {
            background-color: #e6ffed;
            color: #22863a;
        }
        
        .error {
            background-color: #ffebee;
            color: #b71c1c;
        }
        
        footer {
            background-color: #1a73e8; 
            color: white;
            text-align: center;
            padding: 2.2rem;
            margin-top: auto;
            font-size: 0.875rem; 
            line-height: 1.5;
            font-weight: 400; 
            letter-spacing: 0.25px; /
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
        <div class="logo">BlueCare AgedCare</div>
        <nav>
            <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="login.html" class="btn">Login</a></li>
            <li><a href="register.html" class="btn-outline">Register</a></li>
            <li><a href="one_time_request.php">Request OTP</a></li>
            <li><a href="enterotp.php">OTP Verification</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="main-content">
        <div class="hero">
            <h1>Secure Account Verification</h1>
            <p>Enter your email to get a verification code.</p>
        </div>
        
        <div class="container">
            <h2>Request OTP</h2>
            <form method="post" target="_self"> 
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <input type="submit" value="Request OTP">
            </form>

            <?php
            // Verifies whether an email was submitted through a POST request
            if (isset($_POST["email"])) {
                // An OTP is generated and is sent to the provided email address
                if ($_OTP->generate($_POST["email"])) {
                    echo "<div class='note success'>OTP sent successfully!</div>";
                } else {
                    echo "<div class='note error'>".$_OTP->error."</div>";
                }
            }
            ?>
        </div>
    </div>
    
    <footer>
        &copy;  2025 BlueCare AgedCare. All rights reserved.
    </footer>
</body>
</html>
