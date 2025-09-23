<?php
session_start();
include '../config/db.php';

// Quick Stats
$statsQuery = $conn->query("
    SELECT status, COUNT(*) as total 
    FROM requests 
    GROUP BY status
");
$statusCount = ['pending' => 0, 'accepted' => 0, 'completed' => 0, 'rejected' => 0];
while ($row = $statsQuery->fetch_assoc()) {
  $statusCount[strtolower($row['status'])] = $row['total'];
}

// Fetch 5 most recent requests
$recentRequests = $conn->query("
    SELECT r.id, r.status, r.date_requested, 
           GROUP_CONCAT(ri.medicine_name SEPARATOR ', ') AS medicines,
           CONCAT(u.fname,' ',u.lname) AS full_name
    FROM requests r
    JOIN users u ON r.user_id = u.id
    JOIN request_items ri ON ri.request_id = r.id
    GROUP BY r.id
    ORDER BY r.date_requested DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Botika ng Barangay 35 - Admin</title>
  <link rel="stylesheet" href="/public/css/adminDashboard.css">
  <link rel="stylesheet" href="/public/css/requests.css">
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Botika ng Barangay 35 - Admin</div>
    <button onclick="window.location.href='../login.php'">🚪 Logout</button>
  </div>

  <div class="d-flex-full">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
      <a href="adminDashboard.php" class="active">🏠 <span>Dashboard</span></a>
      <a href="manageUsers.php">👥 <span>Users</span></a>
      <a href="manageMedicines.php">💊 <span>Medicine</span></a>
      <a href="manageRequests.php">📋 <span>Requests</span></a>
      <a href="manageInventory.php">📦 <span>Inventory</span></a>
      <a href="reports.php">📊 <span>Reports</span></a>
    </div>

    <!-- Toggle button -->
    <button id="sidebarToggle">☰</button>

    <!-- Content -->
    <div class="content">
      <h1>Dashboard</h1>

      <div class="card">
        <h3>Quick Stats</h3>
        <p>Pending Requests: <?= $statusCount['pending'] ?></p>
        <p>Accepted Requests: <?= $statusCount['accepted'] ?></p>
        <p>Rejected Requests: <?= $statusCount['rejected'] ?></p>
      </div>

      <div class="card">
        <h3>Recent Requests</h3>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Medicine</th>
              <th>User</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($r = $recentRequests->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($r['medicines']) ?></td>
                <td><?= htmlspecialchars($r['full_name']) ?></td>
                <td><?= htmlspecialchars($r['date_requested']) ?></td>
                <td class="status"><?= htmlspecialchars(ucfirst($r['status'])) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const links = sidebar.querySelectorAll('a');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });

    links.forEach(link => {
      link.addEventListener('click', function() {
        links.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>
</body>

</html>