<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "medrms";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Manila');
