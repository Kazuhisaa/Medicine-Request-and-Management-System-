<?php
include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fname = trim($_POST['Fname']);
  $lname = trim($_POST['Lname']);
  $mname = trim($_POST['Mname']);
  $suffix = trim($_POST['suffix']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $contact = trim($_POST['contact']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  $valid_id = null;

  if (isset($_FILES['valid_id']) && $_FILES['valid_id']['error'] === 0) {
    $targetDir = "../public/uploads/";
    $fileName = uniqid() . "_" . basename($_FILES["valid_id"]["name"]);
    $targetFile = $targetDir . $fileName;

    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    if (!in_array($fileType, $allowedTypes)) {
      die("❌ Only JPG, JPEG, PNG, PDF files are allowed.");
    }

    if (!move_uploaded_file($_FILES["valid_id"]["tmp_name"], $targetFile)) {
      die("❌ Error uploading valid ID.");
    }

    $valid_id = $fileName; // store filename only in DB
  }

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conn->prepare("INSERT INTO users (Fname, Mname, Lname, suffix, username, email, contact, password, valid_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param(
    "sssssssss",
    $fname,
    $mname,
    $lname,
    $suffix,
    $username,
    $email,
    $contact,
    $hashed_password,
    $valid_id
  );

  if ($stmt->execute()) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $conn->error;
  }
}
