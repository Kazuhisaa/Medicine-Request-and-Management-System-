<?php
session_start();
include '../config/db.php';

if (!isset($_POST['id'])) {
  echo json_encode(["success" => false, "message" => "No medicine ID provided"]);
  exit;
}

$medicineId = intval($_POST['id']);

// Kunin yung medicine details
$stmt = $conn->prepare("SELECT id, name FROM medicines WHERE id = ?");
$stmt->bind_param("i", $medicineId);
$stmt->execute();
$result = $stmt->get_result();
$medicine = $result->fetch_assoc();
$stmt->close();

if (!$medicine) {
  echo json_encode(["success" => false, "message" => "Medicine not found"]);
  exit;
}

// Initialize cart
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Add / increment
if (!isset($_SESSION['cart'][$medicineId])) {
  $_SESSION['cart'][$medicineId] = [
    "id" => $medicineId,
    "name" => $medicine['name'],
    "quantity" => 1
  ];
} else {
  $_SESSION['cart'][$medicineId]['quantity']++;
}

echo json_encode([
  "success" => true,
  "message" => "Added to cart",
  "cart" => $_SESSION['cart']
]);
