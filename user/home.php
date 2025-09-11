<?php
// --- SESSION AT DB CONNECTION ---
session_start();
include "../config/db.php";
$conn = new mysqli("localhost", "root", "", "notification");
// Dummy session values kung walang naka-login pa
if (!isset($_SESSION['resident_name'])) {
  $_SESSION['resident_name'] = "Juan Dela Cruz";
  $_SESSION['barangay_id'] = "BRGY35-001";
}

$resident_id = $_SESSION['barangay_id'];

// Kunin notifications mula sa database
$notifications = [];
$sql = "SELECT message FROM notifications WHERE resident_id = '$resident_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $notifications[] = $row['message'];
  }
} else {
  $notifications[] = "No new notifications.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Barangay 35 | Botika</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../public/css/userHome.css">
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="left">
      <img src="../public/uploads/514427783_122207432900261758_6664477712173394040_n-removebg-preview.png" alt="Logo" style="height:40px; margin-right:8px; vertical-align:middle;">
      👤 HELLO! <?php echo $_SESSION['resident_name']; ?> (<?php echo $_SESSION['barangay_id']; ?>)
    </div>
    <div class="right">
      <i class="fas fa-bell" id="notifBtn" title="NOTIFICATION"></i>
      <a href="logout.php" title="LOG-OUT">
        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
      </a>
    </div>
  </div>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h1><span class="nano">BOTIKA</span> NG <span class="mega">BARANGAY </span></h1>
      <p>“Serbisyong may malasakit! Libreng gamot para sa lahat ng residente ng Brgy. 35.”</p>
      <button class="request-btn" onclick="window.location.href='medicine.php'">Request Medicine</button>
    </div>
    <div class="hero-img">
      <img src="../public/uploads/514427783_122207432900261758_6664477712173394040_n-removebg-preview.png" alt="Barangay Logo">
    </div>
  </section>

  <!-- Notifications Modal -->
  <div id="notifModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Notifications</h2>
      <?php foreach ($notifications as $note): ?>
        <p><?php echo $note; ?></p>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    const notifBtn = document.getElementById("notifBtn");
    const modal = document.getElementById("notifModal");
    const closeBtn = document.querySelector(".close");

    notifBtn.onclick = function() {
      modal.style.display = "flex";
    }
    closeBtn.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>