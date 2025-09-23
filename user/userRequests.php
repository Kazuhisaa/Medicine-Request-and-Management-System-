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
  <title>Request Medicines | Botika ng Barangay 35</title>
  <link rel="stylesheet" href="../public/css/userRequests.css">
  <link rel="stylesheet" href="../public/css/userDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <a href="userHome.php">🏠 Home</a>
    <a href="userDashboard.php">📊 Dashboard</a>
    <a href="userProfile.php">👤 Profile</a>
    <a href="userRequests.php" class="active">💊 Request Medicine</a>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Request Medicines</div>
    <button onclick="window.location.href='../login.php'">🚪 Logout</button>
  </div>

  <!-- Content -->
  <div class="content">
    <h2>🛒 Your Cart</h2>
    <div id="cart" class="cart">
      <p>No medicines added yet.</p>
      <button onclick="window.location.href='submitRequest.php'" class="btn btn-checkout">
        Go to Checkout
      </button>
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
          data-id="<?= $row['id'] ?>"
          data-name="<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>"
          data-brand="<?= htmlspecialchars($row['brand'], ENT_QUOTES) ?>"
          data-category="<?= htmlspecialchars($row['category'], ENT_QUOTES) ?>"
          data-dosage="<?= htmlspecialchars($row['dosage'], ENT_QUOTES) ?>"
          data-description="<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>"
          data-stock="<?= $row['stock'] ?>"
          data-image="<?= !empty($row['image']) ? '../public/uploads/medicines/' . htmlspecialchars($row['image'], ENT_QUOTES) : '' ?>">

          <!-- Medicine Image -->
          <div class="medicine-image">
            <?php if (!empty($row['image'])): ?>
              <img src="../public/uploads/medicines/<?= htmlspecialchars($row['image']) ?>" alt="Medicine Image">
            <?php else: ?>
              <div class="no-image">No Image</div>
            <?php endif; ?>
          </div>

          <!-- Medicine Info -->
          <div class="medicine-info">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><strong>Brand:</strong> <?= htmlspecialchars($row['brand']) ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
            <p><strong>Dosage:</strong> <?= htmlspecialchars($row['dosage']) ?></p>
            <p class="desc"><?= htmlspecialchars($row['description']) ?></p>
            <p><strong>Stock:</strong> <?= htmlspecialchars($row['stock']) ?></p>
          </div>

          <!-- Actions -->
          <div class="medicine-actions">
            <button class="btn btn-add-cart">➕ Add to Cart</button>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script src="../public/js/userRequests.js"></script>
</body>

</html>