<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "medrms";

mysqli_query($conn, "SET time_zone = '+00:00'");

$conn = mysqli_connect($host, $user, $pass, $db);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
