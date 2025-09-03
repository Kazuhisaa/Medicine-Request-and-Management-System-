<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "medrms";

date_default_timezone_set('UTC');

$conn = mysqli_connect($host, $user, $pass, $db);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
