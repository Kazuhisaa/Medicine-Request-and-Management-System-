<?php
require_once "../config/db.php";

if (isset($_POST['email'])) {
  $email = trim($_POST['email']);

  if ($email === "") {
    echo "<span style='color: red;'>❌ Email is required</span>";
    exit;
  }

  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo "<span class = 'status-message taken'>❌ Email is already taken</span>";
  } else {
    echo "<span class = 'status-message available'>✅ Email is available</span>";
  }

  $stmt->close();
}
