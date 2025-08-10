<?php
include 'config/db.php';

$sql = "INSERT INTO users (full_name, username, password) 
        VALUES ('Test User','testuser','12345')";

if (mysqli_query($conn, $sql)) {
  echo "New record inserted successfully";
} else {
  echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

?>;