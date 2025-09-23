<?php
session_start();
include "../config/db.php";

$identifier = $_POST['identifier'] ?? '';
$password = $_POST['password'] ?? '';

$adminUsername = 'admin';
$adminPassword = 'Adminbrgy35';

if ($identifier === $adminUsername && $password === $adminPassword) {
  $_SESSION['user_role'] = 'admin';
  $_SESSION['username'] = $adminUsername;
  echo 'admin'; // return special response for admin

}
if (isset($_POST['identifier']) && isset($_POST['password'])) {
  $identifier = trim($_POST['identifier']);
  $password = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT id, username, email, password, Fname, Mname, Lname FROM users WHERE username=? OR email=? LIMIT 1");
  $stmt->bind_param("ss", $identifier, $identifier);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      // set session with full name
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['Fname'] = $user['Fname'];
      $_SESSION['Mname'] = $user['Mname'];
      $_SESSION['Lname'] = $user['Lname'];
      $_SESSION['resident_name'] = $user['Fname'] . ' ' . $user['Mname'] . ' ' . $user['Lname'];

      echo "success";
    } else {
      echo "Invalid Username or Password.";
    }
  }
}
