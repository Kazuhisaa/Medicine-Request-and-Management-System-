<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "medrms";


$conn = mysqli_connect($host, $user, $pass, $db);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn, "SET time_zone = '+00:00'");
