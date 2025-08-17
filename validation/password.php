<?php
if (isset($_POST['password'])) {
  $password = trim($_POST['password']);
  $errors = [];

  if (strlen($password) < 8) {
    $errors[] = "❌ Password too short (min 8 chars)";
  }
  if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "❌ Must include at least 1 uppercase letter";
  }
  if (!preg_match('/[a-z]/', $password)) {
    $errors[] = "❌ Must include at least 1 lowercase letter";
  }
  if (!preg_match('/[0-9]/', $password)) {
    $errors[] = "❌ Must include at least 1 number";
  }

  if (!empty($errors)) {
    foreach ($errors as $err) {
      echo "<span class='status-message taken'>{$err}</span><br>";
    }
  } else {
    echo "<span class='status-message available'>✅ Strong password</span>";
  }
}
