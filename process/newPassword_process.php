<?php

include '../config/db.php';



if (isset($_POST['submit'])) {
  $Tokens = $_POST['token'];
  $newPassword = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if ($newPassword !== $confirmPassword) {
    die("Passwords do not match.");
  }
  $hashTokens = hash('sha256', $Tokens);

  $stmt = $conn->prepare("SELECT * FROM password_resets WHERE token=? AND expires_at > NOW()");
  $stmt->bind_param("s", $hashTokens);
  $stmt->execute();
  $result = $stmt->get_result();
  $reset = $result->fetch_assoc();

  if ($reset) {
    $hashedpassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $update = $conn->prepare("UPDATE users SET password=? WHERE email=?");
    $update->bind_param("ss", $hashedpassword, $reset['email']);
    $update->execute();

    $del = $conn->prepare("DELETE FROM password_resets where email=?");
    $del->bind_param("s", $reset['email']);
    $del->execute();

    echo "Password succesfully Reset";
    header("location: ../login.php");
    exit;
  } else {
    echo "Invalid or expired Token.";
  }
}
