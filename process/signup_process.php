<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $firstname = trim($_POST['Fname']);
  $lastname = trim($_POST['Lname']);
  $middlename = trim($_POST['Mname']);
  $suffix = trim($_POST['suffix']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $contact = trim($_POST['contact']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);
  $barangay_id = $_FILES['barangay_id'] = null;

  if (isset($_FILES['barangay_id']) && $_FILES['barangay_id']['error'] === 0) {
    $targetDir = "../uploads/";
    $uniq_name = uniqid() . "_" . basename($_FILES["barangay_id"]["name"]);
    $targetfile = $targetDir . $uniq_name;
    if (move_uploaded_file($_FILES["barangay_id"]["tmp_name"], $targetfile)) {
      $barangay_id = $targetfile;
    }
  }




  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("
    INSERT INTO users 
    (Fname, Lname, Mname, suffix, username, email, contact, password, barangay_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

  $stmt->bind_param(
    "sssssssss",
    $firstname,
    $lastname,
    $middlename,
    $suffix,
    $username,
    $email,
    $contact,
    $hashed_password,
    $barangay_id
  );


  if ($stmt->execute()) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $conn->error;
  }
}
