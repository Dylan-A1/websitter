<?php
session_start();

require_once("check_permissions.php");
hasPermissions(2);

// Escape user data
$name = htmlspecialchars($_SESSION['user_name']);
$email = htmlspecialchars($_SESSION['user_email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BlueCare AgedCare Portal</title>
  <link rel="stylesheet" href="../public/css/dashboard/dashboard.css" />
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div>
      <div class="logo">BlueCare<br>AgedCare</div>
      <nav>
        <a href="#">🧭 Real Time Monitoring</a>
        <a href="#" class="active">📊 Dashboard</a>
        <a href="#">📁 Account Management</a>
        <a href="#">📅 Booking Management</a>
      </nav>
    </div>
    <div class="logout">
      <form action="logout.php" method="POST">
        <button type="submit">↩ Log out</button>
      </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="main">
    <header class="topbar">
      <div>
        <h1>Welcome, <?= $name ?>!</h1>
        <p>Your email is <em><?= $email ?></em></p>
      </div>
      <div class="actions">
        <input type="text" class="search-bar" placeholder="Search"/>
        <button>↩</button>
        <button>↪</button>
        <button>⚙️</button>
        <button class="new-task">New task +</button>
      </div>
    </header>

    <h2>Dashboard</h2>

    <!-- Role Filter -->
    <div class="filter-bar">
      <label for="roleSelect">User Role:</label>
      <select id="roleSelect" onchange="updateVisibility()">
        <option value="admin">Admin</option>
        <option value="staff">Staff</option>
      </select>
    </div>

    <!-- Dashboard Cards -->
    <section class="dashboard-cards">
      <div class="card" id="card-residents">
        <h3>Total Residents</h3>
        <p id="residents-count">0</p>
        <small>As of today</small>
      </div>
      <div class="card" id="card-staff">
        <h3>Staff On Duty</h3>
        <p id="staff-count">0</p>
        <small>Currently active</small>
      </div>
      <div class="card" id="card-appointments">
        <h3>Upcoming Appointments</h3>
        <p id="appointments-count">0</p>
        <small>Next 24 hours</small>
      </div>
      <div class="card" id="card-alerts">
        <h3>System Alerts</h3>
        <p id="alerts-count">0</p>
        <small>New issues</small>
      </div>
    </section>

    <!-- Charts -->
    <div class="chart-container">
      <canvas id="alertsChart" height="100"></canvas>
    </div>
  </main>

  <!-- Dashboard Logic -->
  <script src="../public/js/dashboard.js"></script>
</body>
</html>
