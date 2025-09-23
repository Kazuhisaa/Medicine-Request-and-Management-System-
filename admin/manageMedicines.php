<?php
session_start();
include '../config/db.php';

// Fetch categories
$categories = $conn->query("SELECT DISTINCT category FROM medicines ORDER BY category ASC");
// Fetch medicines
$medicines = $conn->query("SELECT * FROM medicines ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Medicines</title>
  <link rel="stylesheet" href="../public/css/adminDashboard.css">
  <link rel="stylesheet" href="../public/css/manageMedicine.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="adminDashboard.php">🏠 <span>Dashboard</span></a>
    <a href="manageUsers.php">👥 <span>Users</span></a>
    <a href="manageMedicines.php" class="active">💊 <span>Medicine</span></a>
    <a href="manageRequests.php">📋 <span>Requests</span></a>
    <a href="manageInventory.php">📦 <span>Inventory</span></a>
    <a href="reports.php">📊 <span>Reports</span></a>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Manage Medicines</div>
    <button class="logout-btn">🚪 Logout</button>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="header-actions">
      <h1>💊 Medicines</h1>
    </div>

    <!-- Category Filter -->
    <div class="category-bar">
      <button class="filter-btn active" data-category="all">All</button>
      <?php while ($cat = $categories->fetch_assoc()): ?>
        <button class="filter-btn" data-category="<?= htmlspecialchars($cat['category']) ?>">
          <?= htmlspecialchars($cat['category']) ?>
        </button>
      <?php endwhile; ?>
    </div>

    <!-- Medicine Grid -->
    <div class="medicine-grid">
      <?php while ($row = $medicines->fetch_assoc()): ?>
        <div class="medicine-card"
          data-name="<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>"
          data-brand="<?= htmlspecialchars($row['brand'], ENT_QUOTES) ?>"
          data-category="<?= htmlspecialchars($row['category'], ENT_QUOTES) ?>"
          data-dosage="<?= htmlspecialchars($row['dosage'], ENT_QUOTES) ?>"
          data-description="<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>"
          data-stock="<?= $row['stock'] ?>"
          data-image="<?= !empty($row['image']) ? '../public/uploads/medicines/' . htmlspecialchars($row['image'], ENT_QUOTES) : '' ?>"
          data-date="<?= $row['created_at'] ?>"
          onclick="openViewModal(this)">

          <div class="medicine-image">
            <?php if (!empty($row['image'])): ?>
              <img src="../public/uploads/medicines/<?= htmlspecialchars($row['image']) ?>" alt="Medicine Image">
            <?php else: ?>
              <div class="no-image">No Image</div>
            <?php endif; ?>
          </div>
          <div class="medicine-info">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><strong>Brand:</strong> <?= htmlspecialchars($row['brand']) ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
            <p><strong>Dosage:</strong> <?= htmlspecialchars($row['dosage']) ?></p>
            <p class="desc"><strong>Description:</strong> <?= htmlspecialchars($row['description']) ?></p>
            <p><strong>Stock:</strong> <?= htmlspecialchars($row['stock']) ?></p>
            <p class="date">📅 <?= $row['created_at'] ?></p>
          </div>
          <div class="medicine-actions">
            <button class="btn btn-edit"
              onclick="event.stopPropagation(); openEditModal(
              <?= $row['id'] ?>,
              '<?= htmlspecialchars($row['name']) ?>',
              '<?= htmlspecialchars($row['brand']) ?>',
              '<?= htmlspecialchars($row['category']) ?>',
              '<?= htmlspecialchars($row['dosage']) ?>',
              '<?= htmlspecialchars($row['description']) ?>',
              <?= $row['stock'] ?>
            )">✏️ Edit</button>
            <button class="btn btn-delete"
              onclick="event.stopPropagation(); openDeleteModal(<?= $row['id'] ?>)">🗑️ Delete</button>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  </div>

  <!-- Edit Modal -->
  <div id="editMedicineModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeEditModal()">&times;</span>
      <h3>Edit Medicine</h3>
      <form id="editMedicineForm" action="../process/addMedicineProcess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="editMedicineId">
        <input type="text" name="name" id="editMedicineName" required>
        <input type="text" name="brand" id="editMedicineBrand" required>
        <input type="text" name="dosage" id="editMedicineDosage" required>
        <input type="text" name="category" id="editMedicineCategory" required>
        <textarea name="description" id="editMedicineDescription"></textarea>
        <input type="" name="stock" id="editMedicineStock" required>
        <div class="form-actions">
          <button type="submit" class="btn btn-edit" name="update">💾 Update</button>
          <button type="button" onclick="closeEditModal()" class="btn btn-cancel">❌ Cancel</button>
        </div>
      </form>

    </div>
  </div>

  <!-- Delete Modal -->
  <div id="deleteMedicineModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeDeleteModal()">&times;</span>
      <h3>Delete Medicine</h3>
      <form id="deleteMedicineForm" action="../process/addMedicineProcess.php" method="POST">
        <input type="hidden" name="id" id="deleteMedicineId">
        <p>Are you sure you want to delete this medicine?</p>
        <div class="form-actions">
          <button type="submit" class="btn btn-delete" name="delete">🗑 Delete</button>
          <button type="button" onclick="closeDeleteModal()" class="btn btn-cancel">❌ Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- View Modal -->
  <div id="viewMedicineModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeViewModal()">&times;</span>
      <h3>Medicine Information</h3>
      <div class="view-body">
        <img id="viewMedicineImage" src="" alt="Medicine Image" style="max-width:150px; margin-bottom:15px; border-radius:8px;">
        <p><strong>Name:</strong> <span id="viewMedicineName"></span></p>
        <p><strong>Brand:</strong> <span id="viewMedicineBrand"></span></p>
        <p><strong>Category:</strong> <span id="viewMedicineCategory"></span></p>
        <p><strong>Description:</strong> <span id="viewMedicineDescription"></span></p>
        <p><strong>Stock:</strong> <span id="viewMedicineStock"></span></p>
        <p><strong>Created At:</strong> <span id="viewMedicineDate"></span></p>
      </div>
      <div class="form-actions">
        <button type="button" onclick="closeViewModal()" class="btn btn-cancel">❌ Close</button>
      </div>
    </div>
  </div>

  <script src="../public/js/manageMedicine.js"></script>
</body>

</html>