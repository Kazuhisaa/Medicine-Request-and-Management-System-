<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fullname = trim($_POST['fullname']);
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  $confirm_password = $_POST['confirm_password'];

  if ($password !== $confirm_password) {
    die("Passwords do not match!");
  }

  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    die("Username already taken.");
  }

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (fullname, username, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $fullname, $username, $hashed_password);

  if ($stmt->execute()) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $conn->error;
  }
}
