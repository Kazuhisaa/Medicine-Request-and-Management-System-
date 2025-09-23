<?php
session_start();
include "../config/db.php";

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}

// Get user full name from session
$full_name = $_SESSION['resident_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Home</title>
  <link rel="stylesheet" href="/public/css/userDashboard.css">
  <style>
    .welcome-card {
      background-color: #f1f1f1;
      padding: 30px;
      margin: 50px auto;
      border-radius: 10px;
      max-width: 500px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .welcome-card h2 {
      margin-bottom: 20px;
    }

    .welcome-card button {
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    .welcome-card button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <div class="brand">Botika ng Barangay 35</div>
    <button onclick="window.location.href='../login.php'">🚪 Logout</button>
  </div>

  <div class="d-flex-full">
    <div id="sidebar" class="sidebar">
      <a href="userHome.php" class="active">🏠 Home</a>
      <a href="userDashboard.php">📊 Dashboard</a>
      <a href="userProfile.php">👤 Profile</a>
      <a href="userRequests.php">💊 Request Medicine</a>
    </div>

    <div class="content">
      <div class="welcome-card">
        <h1>Welcome, <?= htmlspecialchars($full_name) ?>!</h1>
        <p>Start requesting your medicines below.</p>
        <button onclick="window.location.href='userRequests.php'">Request Medicine 💊</button>
      </div>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const links = sidebar.querySelectorAll('a');
    links.forEach(link => {
      link.addEventListener('click', function() {
        links.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>

</body>

</html>