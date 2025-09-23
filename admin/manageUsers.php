<?php
session_start();
include '../config/db.php';

// Fetch all users
$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>
  <link rel="stylesheet" href="../public/css/adminDashboard.css">
  <link rel="stylesheet" href="../public/css/manageUser.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="adminDashboard.php">🏠 <span>Dashboard</span></a>
    <a href="manageUsers.php" class="active">👥 <span>Users</span></a>
    <a href="manageMedicines.php">💊 <span>Medicine</span></a>
    <a href="manageRequests.php">📋 <span>Requests</span></a>
    <a href="manageInventory.php">📦 <span>Inventory</span></a>
    <a href="reports.php">📊 <span>Reports</span></a>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Manage Users</div>
    <button class="logout-btn">Logout</button>
  </div>

  <!-- Content -->
  <div class="content">
    <h1>Users</h1>
    <button class="btn btn-add" onclick="openAddForm()">➕ Add User</button>

    <div class="card">
      <h3>User List</h3>
      <table class="styled-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Contact</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $users->fetch_assoc()) {
            $fullName = $row['Fname'] . " " . ($row['Mname'] ? $row['Mname'] . " " : "") . $row['Lname'] . " " . $row['suffix'];
          ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars(trim($fullName)) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['contact']) ?></td>
              <td><?= $row['created_at'] ?></td>
              <td>
                <button class="btn btn"
                  onclick="editUser(
                    <?= $row['id'] ?>,
                    '<?= htmlspecialchars($row['Fname']) ?>',
                    '<?= htmlspecialchars($row['Mname']) ?>',
                    '<?= htmlspecialchars($row['Lname']) ?>',
                    '<?= htmlspecialchars($row['suffix']) ?>',
                    '<?= htmlspecialchars($row['username']) ?>',
                    '<?= htmlspecialchars($row['email']) ?>',
                    '<?= htmlspecialchars($row['contact']) ?>'
                  )">✏️ Edit</button>

                <form action="userProcess.php" method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                  <button type="submit" name="delete" class="btn btn-delete" onclick="return confirm('Delete this user?')">🗑 Delete</button>
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add/Edit Modal -->
  <div id="userModal" class="modal">
    <div class="modal-content">
      <h3 id="modalTitle">Add User</h3>
      <form action="userProcess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="userId">

        <div class="form-group">
          <label>First Name</label>
          <input type="text" name="Fname" id="Fname" required>
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" name="Mname" id="Mname">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" name="Lname" id="Lname" required>
        </div>
        <div class="form-group">
          <label>Suffix</label>
          <input type="text" name="suffix" id="suffix">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
          <label>Contact</label>
          <input type="text" name="contact" id="contact">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" id="password">
          <small id="passwordNote">(Leave blank if not changing)</small>
        </div>
        <div class="form-group">
          <label>Valid ID (jpg/png/pdf)</label>
          <input type="file" name="valid_id" id="valid_id">
        </div>

        <div class="form-actions">
          <button type="submit" name="save" class="btn btn-save">💾 Save</button>
          <button type="button" onclick="closeModal()" class="btn btn-cancel">❌ Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../public/js/manageUser.js"></script>
</body>

</html>