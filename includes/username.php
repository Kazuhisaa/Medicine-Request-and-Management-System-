<?php
include 'config/db.php';

if (isset($_POST['username'])) {
  $username = trim($_POST['username']);
}
