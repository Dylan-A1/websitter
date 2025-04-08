<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - BlueCare AgedCare</title>
  <link rel="stylesheet" href="../public/css/index/styles.css"> 
</head>
<body>
  
  <!-- This contains the navigation bar and the buttons -->
  <header>
    <nav class="navbar">
    <div class="logo">BlueCare AgedCare</div>
      <ul class="nav-links">
        <li><a href="../index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php" class="btn">Login</a></li>
        <li><a href="register.php" class="btn-outline">Register</a></li>
      </ul>
    </nav>
  </header>

  <!-- This is this main title section -->
  <section class="hero">
    <h1>Contact Us</h1>
    <p>We're here to help you 24/7. Get in touch with us today.</p>
  </section>

  <!-- This is the contact form section -->
  <section class="contact-section">
    <div class="contact-form">
      <h2>Send Us a Message</h2>
      <form action="#" method="POST">
        <input type="text" name="firstName" placeholder="Your First Name" required />
        <input type="text" name="lastName" placeholder="Your Last Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
        <button type="submit" class="btn">Submit</button>
      </form>
    </div>

    <!-- This is the other contact information section-->
    <div class="contact-info">
      <h2>Visit Us</h2>
      <p><strong>Address:</strong> 123 Blue Street, Melbourne, VIC 3000</p>
      <p><strong>Phone:</strong> (03) 1234 5678</p>
      <p><strong>Email:</strong> contact@bluecarehospital.com</p>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509301!2d144.95373531586673!3d-37.81627974251679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5778e52b2cb5e8!2sMelbourne%20VIC!5e0!3m2!1sen!2sau!4v1710000000000"
        width="100%"
        height="250"
        style="border:0; border-radius: 10px;"
        allowfullscreen=""
        loading="lazy">
      </iframe>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 BlueCare AgedCare. All rights reserved.</p>
  </footer>
</body>
</html>
