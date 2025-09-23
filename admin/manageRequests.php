<?php
session_start();
include '../config/db.php';

// Fetch all requests grouped by request ID
$requests = $conn->query("
    SELECT 
        r.id, r.status, r.prescription, r.date_requested,
        CONCAT(u.fname,' ',u.lname) AS full_name,
        u.email, u.contact, u.valid_id,
        GROUP_CONCAT(ri.medicine_name SEPARATOR ', ') AS medicines
    FROM requests r
    JOIN users u ON r.user_id = u.id
    JOIN request_items ri ON ri.request_id = r.id
    GROUP BY r.id
    ORDER BY r.date_requested DESC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Requests</title>
  <link rel="stylesheet" href="../public/css/adminDashboard.css">
  <link rel="stylesheet" href="../public/css/requests.css">
  <style>
    /* Simple modal styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 100;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 400px;
      position: relative;
    }

    .close {
      color: #aaa;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: #000;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <a href="adminDashboard.php">🏠 Dashboard</a>
    <a href="manageUsers.php">👥 Users</a>
    <a href="manageMedicines.php">💊 Medicine</a>
    <a href="manageRequests.php" class="active">📋 Requests</a>
    <a href="manageInventory.php">📦 Inventory</a>
    <a href="reports.php">📊 Reports</a>
  </div>

  <div class="navbar">
    <div class="brand">Manage Requests</div>
    <button class="logout-btn">Logout</button>
  </div>

  <div class="content">
    <h1>Requests</h1>
    <table class="styled-table" id="requestsTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Medicines</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($r = $requests->fetch_assoc()): ?>
          <tr id="request-<?= $r['id'] ?>">
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['full_name']) ?></td>
            <td><?= htmlspecialchars($r['medicines']) ?></td>
            <td class="status"><?= htmlspecialchars($r['status']) ?></td>
            <td>
              <button class="btn-view"
                data-fullname="<?= htmlspecialchars($r['full_name']) ?>"
                data-email="<?= htmlspecialchars($r['email']) ?>"
                data-contact="<?= htmlspecialchars($r['contact']) ?>"
                data-validid="<?= htmlspecialchars($r['valid_id']) ?>"
                data-medicines="<?= htmlspecialchars($r['medicines']) ?>">View</button>

              <?php if (strtolower($r['status']) === 'pending'): ?>
                <button class="btn-accept" data-id="<?= $r['id'] ?>">Accept</button>
                <button class="btn-reject" data-id="<?= $r['id'] ?>">Reject</button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div id="viewModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h3>User Request Details</h3>
      <p><strong>Name:</strong> <span id="modalFullName"></span></p>
      <p><strong>Email:</strong> <span id="modalEmail"></span></p>
      <p><strong>Contact:</strong> <span id="modalContact"></span></p>
      <p><strong>Valid ID:</strong><br>
        <img id="modalValidIDImg" src="" alt="Valid ID" style="max-width:100%;border:1px solid #ccc;border-radius:5px;">
      </p>
      <p><strong>Medicines:</strong> <span id="modalMedicines"></span></p>
    </div>
  </div>

  <script>
    // Accept/Reject functionality
    document.querySelectorAll('.btn-accept, .btn-reject').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const status = btn.classList.contains('btn-accept') ? 'Accepted' : 'Rejected';
        const formData = new FormData();
        formData.append('id', id);
        formData.append('status', status);

        fetch('../process/updateRequestStatus.php', {
            method: 'POST',
            body: formData
          })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              const row = document.getElementById(`request-${id}`);
              row.querySelector('.status').textContent = status;
              row.querySelectorAll('.btn-accept, .btn-reject').forEach(b => b.remove());
              alert('✅ Status updated!');
            } else {
              alert('❌ ' + (data.message || 'Failed to update request.'));
            }
          })
          .catch(err => console.error('Fetch error:', err));
      });
    });

    // View modal functionality
    const modal = document.getElementById('viewModal');
    const spanClose = modal.querySelector('.close');

    document.querySelectorAll('.btn-view').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('modalFullName').textContent = btn.dataset.fullname;
        document.getElementById('modalEmail').textContent = btn.dataset.email;
        document.getElementById('modalContact').textContent = btn.dataset.contact;

        // Set image src dynamically
        document.getElementById('modalValidIDImg').src = '../public/uploads/valid_ids/' + btn.dataset.validid;

        document.getElementById('modalMedicines').textContent = btn.dataset.medicines;
        modal.style.display = 'block';
      });
    });


    spanClose.onclick = () => modal.style.display = 'none';
    window.onclick = event => {
      if (event.target == modal) modal.style.display = 'none';
    }
  </script>
</body>

</html>