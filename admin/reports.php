<?php
session_start();
include '../config/db.php';

// Fetch all requests
$requests = $conn->query("
    SELECT r.id, r.status, r.date_requested,
           CONCAT(u.fname,' ',u.lname) AS full_name,
           GROUP_CONCAT(ri.medicine_name SEPARATOR ', ') AS medicines
    FROM requests r
    JOIN users u ON r.user_id = u.id
    JOIN request_items ri ON ri.request_id = r.id
    GROUP BY r.id
    ORDER BY r.date_requested DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reports - Requests</title>
  <link rel="stylesheet" href="../public/css/adminDashboard.css">
  <link rel="stylesheet" href="../public/css/reports.css">
</head>

<body>
  <div class="sidebar">
    <a href="adminDashboard.php">🏠 Dashboard</a>
    <a href="manageUsers.php">👥 Users</a>
    <a href="manageMedicines.php">💊 Medicine</a>
    <a href="manageRequests.php">📋 Requests</a>
    <a href="manageInventory.php">📦 Inventory</a>
    <a href="reports.php" class="active">📊 Reports</a>
  </div>

  <div class="navbar">
    <div class="brand">Reports</div>
    <button class="logout-btn">Logout</button>
  </div>

  <div class="content">
    <h1>Requests Report</h1>
    <table class="styled-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Medicines</th>
          <th>Status</th>
          <th>Date Requested</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $requests->fetch_assoc()): ?>
          <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['full_name']) ?></td>
            <td><?= htmlspecialchars($r['medicines']) ?></td>
            <td><?= htmlspecialchars($r['status']) ?></td>
            <td><?= $r['date_requested'] ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <form action="../process/generateReport.php" method="POST" style="margin-top:20px;">
      <button type="submit" name="generate_pdf" class="btn btn-add">🖨️ Generate PDF</button>
    </form>
  </div>
</body>

</html>