<?php
session_start();
include '../config/db.php';

// Cart
$cart = $_SESSION['cart'] ?? [];

// User info with valid_id
$userId = $_SESSION['user_id'] ?? 0;
$userQuery = $conn->prepare("SELECT fname, lname, email, contact, valid_id FROM users WHERE id = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Submit Request | Botika ng Barangay 35</title>
  <link rel="stylesheet" href="../public/css/submitRequests.css">
</head>

<body>
  <div class="checkout-wrapper">
    <h1>💊 Medicine Request Checkout</h1>

    <!-- Cart Section -->
    <div class="card-section">
      <h2>🛒 Your Cart</h2>
      <?php if (empty($cart)): ?>
        <p class="empty-cart">No medicines in your cart.</p>
      <?php else: ?>
        <ul class="cart-list">
          <?php foreach ($cart as $id => $item): ?>
            <li>
              <span><?= htmlspecialchars($item['name']) ?> (x<?= $item['quantity'] ?>)</span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

    <!-- User Info Section -->
    <div class="card-section">
      <h2>👤 Personal Information</h2>
      <form action="../process/saveRequest.php" method="POST" enctype="multipart/form-data" class="checkout-form">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" value="<?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?>" readonly>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="text" value="<?= htmlspecialchars($user['email']) ?>" readonly>
        </div>

        <div class="form-group">
          <label>Contact</label>
          <input type="text" value="<?= htmlspecialchars($user['contact']) ?>" readonly>
        </div>
    </div>

    <!-- Uploads Section -->
    <div class="card-section">
      <h2>📄 Required Documents</h2>

      <!-- Valid ID -->
      <div class="form-group">
        <label>Valid ID <span class="required">*</span></label><br>
        <?php if (!empty($user['valid_id'])): ?>
          <p>✅ Already uploaded:</p>
          <img src="../public/uploads/valid_ids/<?= htmlspecialchars($user['valid_id']) ?>"
            alt="Valid ID" style="max-width:250px;border:1px solid #ccc;border-radius:8px;margin-bottom:10px;">
          <p>You may update your valid ID:</p>
        <?php else: ?>
          <p>No valid ID uploaded yet. Please upload:</p>
        <?php endif; ?>
        <input type="file" name="valid_id" accept="image/*">
      </div>

      <!-- Prescription -->
      <div class="form-group">
        <label>Prescription (Optional)</label>
        <input type="file" name="prescription" accept="image/*,application/pdf">
      </div>
    </div>

    <!-- Submit -->
    <div class="card-section submit-box">
      <button type="submit" class="btn-submit">✅ Confirm & Submit</button>
    </div>
    </form>
  </div>
</body>

</html>