<?php
session_start();
include "../config/db.php";

if (isset($_POST['identifier']) && isset($_POST['password'])) {
  $identifier = trim($_POST['identifier']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username=? OR email=? LIMIT 1");
  $stmt->bind_param("ss", $identifier, $identifier);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {

      // fetch full name
      $stmt2 = $conn->prepare("SELECT Fname, Mname, Lname FROM users WHERE id = ?");
      $stmt2->bind_param("i", $user['id']);
      $stmt2->execute();
      $res = $stmt2->get_result();
      $nameData = $res->fetch_assoc();
      $fullName = $nameData['Fname'] . ' ' . $nameData['Mname'] . ' ' . $nameData['Lname'];

      // set session
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['resident_name'] = $fullName;

      echo "success";
    } else {
      echo "Invalid Username or Password.";
    }
  }
}
