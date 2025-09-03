<?php
if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  if ($password === $confirm_password) {
    echo "<span class='status-message available'>✅ Password match</span>";
  } else {
    echo "<span class='status-message taken'>❌ Password do not match</span>";
  }
}
