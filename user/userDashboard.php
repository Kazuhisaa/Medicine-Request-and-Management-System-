<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Botika ng Barangay 35</title>
  <link rel="stylesheet" href="/public/css/userDashboard.css">
</head>

<body>
  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">Botika ng Barangay 35 </div>
    <button>Logout</button>
  </div>

  <div class="d-flex-full">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
      <a href="userHome.php" class="active">🏠 <span>Home</span></a>
      <a href="userDashboard.php">📊<span>Dashboard</span></a>
      <a href="userProfile.php">👤 <span>Profile</span></a>
      <a href="userRequests.php"> 💊<span>Request Medicine</span></a>
    </div>

    <!-- Toggle button -->
    <button id="sidebarToggle">☰</button>

    <!-- Content -->
    <div class="content">
      <h1>Dashboard</h1>
      <div class="card">
        <h3>Quick Stats</h3>
        <p>Pending Requests: 5</p>
        <p>Approved Requests: 12</p>
        <p>Completed Requests: 20</p>
      </div>

      <div class="card">
        <h3>Recent Requests</h3>
        <table>
          <thead>
            <tr>
              <th>Medicine</th>
              <th>User</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Paracetamol</td>
              <td>juan@example.com</td>
              <td>2025-09-20</td>
              <td>Pending</td>
            </tr>
            <tr>
              <td>Amoxicillin</td>
              <td>maria@example.com</td>
              <td>2025-09-19</td>
              <td>Approved</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const links = sidebar.querySelectorAll('a');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });

    links.forEach(link => {
      link.addEventListener('click', function() {
        links.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>
</body>

</html>