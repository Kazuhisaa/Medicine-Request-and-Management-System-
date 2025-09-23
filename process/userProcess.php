<?php
include '../config/db.php';

// Add or Edit User
if (isset($_POST['save'])) {
  $id = $_POST['id'];
  $fname = trim($_POST['Fname']);
  $mname = trim($_POST['Mname']);
  $lname = trim($_POST['Lname']);
  $suffix = trim($_POST['suffix']);
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $contact = trim($_POST['contact']);

  // file upload (optional kapag edit)
  $valid_id = null;
  if (isset($_FILES['valid_id']) && $_FILES['valid_id']['error'] === 0) {
    $targetDir = "../public/uploads/";
    $fileName = uniqid() . "_" . basename($_FILES["valid_id"]["name"]);
    $targetFile = $targetDir . $fileName;

    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array($fileType, $allowedTypes)) {
      if (move_uploaded_file($_FILES["valid_id"]["tmp_name"], $targetFile)) {
        $valid_id = $fileName;
      }
    }
  }

  if ($id) {
    // Update User
    if ($valid_id) {
      $stmt = $conn->prepare("UPDATE users SET Fname=?, Mname=?, Lname=?, suffix=?, username=?, email=?, contact=?, valid_id=? WHERE id=?");
      $stmt->bind_param("ssssssssi", $fname, $mname, $lname, $suffix, $username, $email, $contact, $valid_id, $id);
    } else {
      $stmt = $conn->prepare("UPDATE users SET Fname=?, Mname=?, Lname=?, suffix=?, username=?, email=?, contact=? WHERE id=?");
      $stmt->bind_param("sssssssi", $fname, $mname, $lname, $suffix, $username, $email, $contact, $id);
    }
    $stmt->execute();
  } else {
    // Insert New User (default password = "123456")
    $hashed_password = password_hash("123456", PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (Fname, Mname, Lname, suffix, username, email, contact, password, valid_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $fname, $mname, $lname, $suffix, $username, $email, $contact, $hashed_password, $valid_id);
    $stmt->execute();
  }

  header("Location: ../dashboard.php?page=manageUsers");
  exit;
}

// Delete User
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  header("Location: ../dashboard.php?page=manageUsers");
  exit;
}
