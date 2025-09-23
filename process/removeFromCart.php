<?php
session_start();

if (!isset($_POST['id'])) {
  echo json_encode(['success' => false, 'message' => 'No medicine ID provided']);
  exit;
}

$medId = intval($_POST['id']);

if (isset($_SESSION['cart'][$medId])) {
  unset($_SESSION['cart'][$medId]);
}

echo json_encode(['success' => true, 'cart' => $_SESSION['cart'] ?? []]);
