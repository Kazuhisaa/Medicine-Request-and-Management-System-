<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Common inputs
  $id = $_POST['id'] ?? null;
  $name = $_POST['name'] ?? '';
  $brand = $_POST['brand'] ?? '';
  $category = $_POST['category'] ?? '';
  $description = $_POST['description'] ?? '';
  $dosage = $_POST['dosage'] ?? '';
  $note = $_POST['note'] ?? '';
  $stock = intval($_POST['stock'] ?? 0);

  // File upload (optional)
  $image_name = null;
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $uploadDir = '../public/uploads/medicines/';
    $image_name = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $image_name;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      $_SESSION['error'] = "Failed to upload image.";
      header("Location: ../admin/manageMedicines.php");
      exit;
    }
  }

  // ✅ ADD MEDICINE
  if (isset($_POST['save'])) {
    $stmt = $conn->prepare("INSERT INTO medicines (name, brand, category, description, dosage, note, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $name, $brand, $category, $description, $dosage, $note, $stock, $image_name);

    if ($stmt->execute()) {
      $_SESSION['success'] = "Medicine added successfully!";
    } else {
      $_SESSION['error'] = "Failed to add medicine.";
    }
    $stmt->close();
  }

  // ✅ UPDATE MEDICINE
  elseif (isset($_POST['update'])) {
    if ($image_name) {
      // Update with new image
      $stmt = $conn->prepare("UPDATE medicines SET name=?, brand=?, category=?, description=?, dosage=?, note=?, stock=?, image=? WHERE id=?");
      $stmt->bind_param("ssssssisi", $name, $brand, $category, $description, $dosage, $note, $stock, $image_name, $id);
    } else {
      // Update without changing image
      $stmt = $conn->prepare("UPDATE medicines SET name=?, brand=?, category=?, description=?, dosage=?, note=?, stock=? WHERE id=?");
      $stmt->bind_param("ssssssii", $name, $brand, $category, $description, $dosage, $note, $stock, $id);
    }

    if ($stmt->execute()) {
      $_SESSION['success'] = "Medicine updated successfully!";
    } else {
      $_SESSION['error'] = "Failed to update medicine.";
    }
    $stmt->close();
  }

  // ✅ DELETE MEDICINE
  elseif (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM medicines WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
      $_SESSION['success'] = "Medicine deleted successfully!";
    } else {
      $_SESSION['error'] = "Failed to delete medicine.";
    }
    $stmt->close();
  }

  $conn->close();
  header("Location: ../admin/manageMedicines.php");
  exit;
}
