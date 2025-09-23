<?php
session_start();
include '../config/db.php';

// Fetch inventory
$inventory = $conn->query("SELECT * FROM inventory ORDER BY date_added DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin - Inventory</title>
  <link rel="stylesheet" href="../public/css/adminDashboard.css">
  <link rel="stylesheet" href="../public/css/inventory.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="adminDashboard.php">🏠 Dashboard</a>
    <a href="manageUsers.php">👥 Users</a>
    <a href="manageMedicines.php">💊 Medicine</a>
    <a href="manageRequests.php">📋 Requests</a>
    <a href="manageInventory.php" class="active">📦 Inventory</a>
    <a href="reports.php">📊 Reports</a>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Inventory</div>
    <button onclick="window.location.href='../login.php'">🚪 Logout</button>
  </div>

  <!-- Content -->
  <div class="container">
    <h1>📦 Inventory</h1>
    <button onclick="openAddModal()">➕ Add Inventory</button>

    <table>
      <thead>
        <tr>
          <th>Medicine Name</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Quantity</th>
          <th>Unit</th>
          <th>Expiry Date</th>
          <th>Supplier</th>
          <th>Date Added</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $inventory->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['medicine_name']) ?></td>
            <td><?= htmlspecialchars($row['brand']) ?></td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= htmlspecialchars($row['unit']) ?></td>
            <td><?= htmlspecialchars($row['expiry_date']) ?></td>
            <td><?= htmlspecialchars($row['supplier']) ?></td>
            <td><?= htmlspecialchars($row['date_added']) ?></td>
            <td>
              <button onclick="openEditModal(<?= $row['id'] ?>)">✏️ Edit</button>
              <button onclick="openDeleteModal(<?= $row['id'] ?>)">🗑 Delete</button>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Add Inventory Modal -->
  <div id="addInventoryModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeAddModal()">&times;</span>
      <h3>Add Inventory</h3>
      <form id="addInventoryForm" action="../process/inventoryProcess.php" method="POST">
        <input type="text" name="medicine_name" placeholder="Medicine Name" required>
        <input type="text" name="brand" placeholder="Brand" required>
        <input type="text" name="category" placeholder="Category" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="text" name="unit" placeholder="Unit (e.g., mg, ml)" required>
        <input type="date" name="expiry_date" placeholder="Expiry Date" required>
        <input type="text" name="supplier" placeholder="Supplier" required>
        <input type="text" name="medicine_id" placeholder="Medicine ID" required>
        <div class="form-actions">
          <button type="submit" name="add" class="btn btn-add">💾 Save</button>
          <button type="button" onclick="closeAddModal()" class="btn btn-cancel">❌ Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Edit Inventory Modal -->
  <div id="editInventoryModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeEditModal()">&times;</span>
      <h3>Edit Inventory</h3>
      <form id="editInventoryForm" action="../process/inventoryProcess.php" method="POST">
        <input type="hidden" name="id" id="editInventoryId">
        <input type="text" name="medicine_name" id="editMedicineName" placeholder="Medicine Name" required>
        <input type="text" name="brand" id="editBrand" placeholder="Brand" required>
        <input type="text" name="category" id="editCategory" placeholder="Category" required>
        <input type="number" name="quantity" id="editQuantity" placeholder="Quantity" required>
        <input type="text" name="unit" id="editUnit" placeholder="Unit (e.g., mg, ml)" required>
        <input type="date" name="expiry_date" id="editExpiryDate" placeholder="Expiry Date" required>
        <input type="text" name="supplier" id="editSupplier" placeholder="Supplier" required>
        <input type="text" name="medicine_id" id="editMedicineId" placeholder="Medicine ID" required>
        <div class="form-actions">
          <button type="submit" name="update" class="btn btn-edit">💾 Update</button>
          <button type="button" onclick="closeEditModal()" class="btn btn-cancel">❌ Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../public/js/inventory.js"></script>
</body>

</html>