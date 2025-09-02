<?php

include '../config/db.php';



if (isset($_POST['submit'])) {
  $token = $_POST['token'];
  $newPassword = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token =?, AND reset_expires=? > NOW()");
  $stmt->bind_param("s", $token);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $hashedpassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE users SET password=?, reset_token= NULL, reset_expires =NULL, WHERE reset_token=?");
    $update->bind_param("ss", $hashedpassword, $token);
    $update->execute();
  }
}
