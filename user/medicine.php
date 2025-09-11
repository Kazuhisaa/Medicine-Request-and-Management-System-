<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Medicine</title>
  <link rel="stylesheet" href="../public/css/userMedicine.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <style>
    * {
      text-decoration: none;
    }

    .categories button.active {
      background: linear-gradient(135deg, #2E7D32, #4CAF50);
      color: white;
    }

    .categories button:hover {
      background: linear-gradient(135deg, #1b5e20, #388e3c);
      color: white;
    }
  </style>

  <?php
  //MEDICINES SA DATABASE 
  include "../config/db.php";

  $result = $conn->query("SELECT * FROM medicines");
  $medicines = [];
  while ($row = $result->fetch_assoc()) {
    $medicines[] = $row;
  }
  ?>

  <div class="sidebar">
    <div class="close-btn" onclick="toggleSidebar()">&#8249;</div>

    <!-- Header ng sidebar -->
    <div class="sidebar-header">
      <img src="../public/uploads/514427783_122207432900261758_6664477712173394040_n-removebg-preview.png" alt="Logo" class="logo">

      <h2>BOTIKA NG </h2>
      <small>BARANGAY 35</small>

    </div>

    <ul>
      <li><a href="../user/home.php"><i class="fas fa-home"></i> Home</a></li>
      <li><a href="../user/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="../user/medicine.php"><i class="fas fa-pills"></i> Medicine</a></li>
      <li><a href="../user/profile.php"><i class="fas fa-user"></i> Profile</a></li>
      <li><a href="#"><i class="fas fa-clipboard-list"></i> Request</a></li>
      <li class="logout"><a href="logout.php"><i class="fas fa-right-from-bracket"></i> Logout</a></li>
    </ul>
  </div>

  <!-- Page Content -->
  <div class="content">
    <!-- Navbar -->
    <div class="navbar">
      <div style="display: flex; align-items: center; gap: 20px;">
        <div class="menu-icon" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </div>

        <div>
          <small> <em> <i class="fas fa-pills"></i> Medicine </em></small>
        </div>
      </div>
    </div>
    <div class="welcome">
      <p><strong>Request medicines for Barangay 35 </strong></p>
    </div>

    <!-- Search Section -->
    <div class="search-section">
      <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search Medicine">
        <button>Upload Prescription</button>
      </div>
      <div class="categories">
        <button class="active" data-category="All">All Categories</button>
        <button data-category="Hypertension">Hypertension</button>
        <button data-category="Diabetes">Diabetes</button>
        <button data-category="Cholesterol">Cholesterol</button>
        <button data-category="Multivitamins">Multivitamins</button>
        <button data-category="Pain Relief">Pain Reliever</button>
        <button data-category="Anti-Ashtma">Anti-Ashtma</button>
        <button data-category="Antibiotic">Antibiotic</button>
      </div>
    </div>
    <!-- Cart Popup Modal -->
    <div id="cartModal" class="modal">
      <div class="modal-content">
        <span class="closeCart">&times;</span>
        <h2>Selected Medicines</h2>
        <div id="cartList"></div>
      </div>
    </div>

    <!-- Selected Medicines Section -->
    <div class="selected-medicines">
      <div class="selected-info">
        <span class="cart-icon">🛒</span>
        <strong>Selected Medicines</strong>
        <span class="cart-count">0</span><br><br>
        <p>Click "Proceed to Request" to submit your medicine request.</p>
      </div>
      <button class="proceed-btn">Proceed to Request</button>
    </div>

    <!-- Medicines -->
    <div class="medicines" id="medicineList"></div>
    <!-- Popup Modal -->
    <div id="medicineModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>

        <div class="modal-body">
          <div class="modal-pic">Picture (temporary)</div>
          <h2 id="modalName">Medicine Name</h2>
          <p><strong>Category:</strong> <span id="modalCategory"></span></p>
          <p><strong>Description:</strong> <span id="modalDescription"></span></p>
          <p><strong>Grams:</strong> <span id="modalDosage"></span></p>
          <p><strong>Stocks:</strong> <span id="modalStocks">100</span></p>
        </div>

        <button id="addToSelectedBtn">Add Medicine</button>
      </div>
    </div>

    <script>
      const medicines = <?php echo json_encode($medicines); ?>;
    </script>
    <script src="../public/js/medicineSidebar.js"></script>
</body>

</html>