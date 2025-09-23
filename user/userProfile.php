<?php
session_start();
include '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $suffix = $_POST['suffix'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $birthday = $_POST['birthday'];
  $address = $_POST['address'];

  $updateStmt = $conn->prepare("UPDATE users SET fname=?, mname=?, lname=?, suffix=?, username=?, email=?, contact=?, birthday=?, address=? WHERE id=?");
  $updateStmt->bind_param("sssssssssi", $fname, $mname, $lname, $suffix, $username, $email, $contact, $birthday, $address, $user_id);
  $updateStmt->execute();
  $updateStmt->close();

  // Refresh page to see updates
  header("Location: userProfile.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Botika ng Barangay 35</title>
  <link rel="stylesheet" href="/public/css/userDashboard.css">
  <link rel="stylesheet" href="/public/css/userProfile.css">
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Botika ng Barangay 35 </div>
    <button onclick="window.location.href='../login.php'">🚪 Logout</button>
  </div>

  <div class="d-flex-full">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
      <a href="userHome.php" class="active">🏠 <span>Home</span></a>
      <a href="userDashboard.php">📊<span>Dashboard</span></a>
      <a href="userProfile.php">👤 <span>Profile</span></a>
      <a href="userRequests.php"> 💊<span>Request Medicine</span></a>
    </div>

    <!-- Toggle button -->
    <button id="sidebarToggle">☰</button>

    <div class="profile-card">
      <h2>My Profile</h2>
      <form method="POST">
        <div class="profile-field">
          <label for="fname">First Name:</label>
          <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($user['Fname']) ?>" required>
        </div>

        <div class="profile-field">
          <label for="mname">Middle Name:</label>
          <input type="text" id="mname" name="mname" value="<?= htmlspecialchars($user['Mname']) ?>">
        </div>

        <div class="profile-field">
          <label for="lname">Last Name:</label>
          <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($user['Lname']) ?>" required>
        </div>

        <div class="profile-field">
          <label for="suffix">Suffix:</label>
          <input type="text" id="suffix" name="suffix" value="<?= htmlspecialchars($user['suffix']) ?>">
        </div>

        <div class="profile-field">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>

        <div class="profile-field">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="profile-field">
          <label for="contact">Contact:</label>
          <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($user['contact']) ?>" required>
        </div>

        <div class="profile-field">
          <label for="birthday">Birthday:</label>
          <input type="date" id="birthday" name="birthday" value="<?= htmlspecialchars($user['birthday'] ?? '') ?>">
        </div>

        <div class="profile-field">
          <label for="address">Address:</label>
          <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>">
        </div>

        <button type="submit" name="update" class="btn-save">💾 Update Information</button>
      </form>
    </div>
    <button class="btn-edit" onclick="alert('Edit profile coming soon!')">✏️ Edit Profile</button>
  </div>

</body>

</html>