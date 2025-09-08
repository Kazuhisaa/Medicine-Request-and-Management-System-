<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Botika ng Barangay 35</title>
  <link rel="stylesheet" href="../public/css/userDashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  
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
    <!-- 3 lines sa kaliwa -->
    <div class="menu-icon" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
    </div>
    <div>
      <small> <em> <i class="fas fa-tachometer-alt"></i> User Dashboard </em></small>
    </div>
  </div>
</div>

    <!-- Dashboard Content -->
    <div class="dashboard">
      <!-- Request Status Overview -->
      <div class="status-cards">
        <div class="status-card">
          <h3>Pending Requests</h3>
          <p>0</p>
        </div>
        <div class="status-card">
          <h3>Approved Requests</h3>
          <p>0</p>
        </div>
        <div class="status-card">
          <h3>Completed Requests</h3>
          <p>0</p>
        </div>
      </div>

      <!-- Recent Requests Table -->
      <div class="recent-requests">
        <h3>Recent Requests</h3>
        <table>
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Date Requested</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Paracetamol</td>
              <td>2025-08-18</td>
              <td>Approved</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Quick Panels -->
      <div class="quick-panels">
        <div class="panel">
          <h3>Health Tips</h3>
          <p>💊 Always take your medicine on time.</p>
          <p>🥗 Eat healthy and stay hydrated.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleSidebar() {
      document.querySelector(".sidebar").classList.toggle("active");
      document.querySelector(".content").classList.toggle("shift");
    }
  </script>

</body>
</html>
