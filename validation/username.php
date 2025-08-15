<?php
require_once "../config/db.php";

if (isset($_POST['username'])) {
  $username = trim($_POST['username']);

  if ($username === "") {
    echo "<span style='color: red;'>❌ Username is required</span>";
    exit;
  }

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    echo "<span class = 'status-message taken'>❌ Username is already taken</span>";
  } else {
    echo "<span class = 'status-message available'>✅ Username is available</span>";
  }

  $stmt->close();
}
