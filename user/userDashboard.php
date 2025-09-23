<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'] ?? 0;

// Quick stats from requests table
$stats = $conn->query("
    SELECT
        IFNULL(COUNT(CASE WHEN status='Pending' THEN 1 END), 0) AS Pending,
        IFNULL(COUNT(CASE WHEN status='Accepted' THEN 1 END), 0) AS Accepted,
        IFNULL(COUNT(CASE WHEN status='Rejected' THEN 1 END), 0) AS Rejected
    FROM requests
    WHERE user_id = $user_id
")->fetch_assoc();

// Recent requests with medicines
$recent = $conn->query("
    SELECT 
        r.id,
        GROUP_CONCAT(ri.medicine_name SEPARATOR ', ') AS medicines,
        r.date_requested,
        r.status
    FROM requests r
    JOIN request_items ri ON ri.request_id = r.id
    WHERE r.user_id = $user_id
    GROUP BY r.id
    ORDER BY r.date_requested DESC
    LIMIT 5
");



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="/public/css/userDashboard.css">
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
      <div class="card">
        <h3>Quick Stats</h3>
        <p>Pending Requests: <?= $stats['Pending'] ?? 0 ?></p>
        <p>Approved Requests: <?= $stats['Accepted'] ?? 0 ?></p>
        <p>Rejected Requests: <?= $stats['Rejected'] ?? 0 ?></p>
      </div>

      <div class="card">
        <h3>Recent Requests</h3>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Medicines</th>
              <th>Date Requested</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $recent->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['medicines']) ?></td>
                <td><?= htmlspecialchars($row['date_requested']) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
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