<?php
session_start();
include '../config/db.php';

// Check kung may laman ang cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  die("❌ No items in cart.");
}

// Check kung may user
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
  die("❌ You must be logged in.");
}

// Kunin user info
$userQuery = $conn->prepare("SELECT fname, lname, valid_id FROM users WHERE id = ?");
$userQuery->bind_param("i", $user_id);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();
$userQuery->close();

if (!$user) {
  die("❌ User not found.");
}

$fullname = $user['fname'] . " " . $user['lname'];

// ✅ Upload Valid ID (kung may bago)
$validIdFile = $user['valid_id']; // existing file
if (isset($_FILES['valid_id']) && $_FILES['valid_id']['error'] == 0) {
  $uploadDir = "../public/uploads/valid_ids/";
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  $fileName = time() . "_" . basename($_FILES['valid_id']['name']);
  $targetFile = $uploadDir . $fileName;

  if (move_uploaded_file($_FILES['valid_id']['tmp_name'], $targetFile)) {
    $validIdFile = $fileName;

    // Update users table
    $update = $conn->prepare("UPDATE users SET valid_id = ? WHERE id = ?");
    $update->bind_param("si", $validIdFile, $user_id);
    $update->execute();
    $update->close();
  }
}

// ✅ Upload Prescription (optional)
$prescriptionPath = null;
if (isset($_FILES['prescription']) && $_FILES['prescription']['error'] == 0) {
  $uploadDir = "../public/uploads/prescriptions/";
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
  }

  $fileName = time() . "_" . basename($_FILES['prescription']['name']);
  $targetFile = $uploadDir . $fileName;

  if (move_uploaded_file($_FILES['prescription']['tmp_name'], $targetFile)) {
    $prescriptionPath = $fileName;
  }
}

// ✅ Save main request (requests table)
$stmt = $conn->prepare("INSERT INTO requests (user_id, fullname, prescription, date_requested) 
                        VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $user_id, $fullname, $prescriptionPath);
$stmt->execute();
$request_id = $stmt->insert_id; // kunin ID ng bagong request
$stmt->close();

// ✅ Save medicines (request_items table)
$stmt = $conn->prepare("INSERT INTO request_items (request_id, medicine_name) VALUES (?, ?)");
foreach ($_SESSION['cart'] as $item) {
  $medicineName = $item['name'];
  $stmt->bind_param("is", $request_id, $medicineName);
  $stmt->execute();
}
$stmt->close();

// Clear cart
unset($_SESSION['cart']);

// ✅ Success message
echo "<div style='font-family: Arial; max-width:600px; margin:50px auto; padding:20px; border:1px solid #ddd; border-radius:10px; text-align:center;'>";
echo "<h2 style='color:green;'>✅ Request Submitted Successfully!</h2>";
echo "<p>Thank you, <strong>{$fullname}</strong>. Your request has been recorded.</p>";

if (!empty($validIdFile)) {
  echo "<p>Your Valid ID:</p>";
  echo "<img src='../public/uploads/valid_ids/{$validIdFile}' style='max-width:250px; border:1px solid #ccc; border-radius:8px;'>";
}

echo "<br><a href='../user/userRequests.php' style='display:inline-block; margin-top:20px; padding:10px 20px; background:#007BFF; color:white; text-decoration:none; border-radius:5px;'>🔙 Back to Request Page</a>";
echo "</div>";
