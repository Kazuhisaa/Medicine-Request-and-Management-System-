<?php
session_start();

// Hardcoded admin credentials
$admin_email = "admin@barangay35.com";
$admin_password = "123456"; // plain text (pwede mong gawing password_hash para mas secure)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']);
    $password   = trim($_POST['password']);

    if ($identifier === $admin_email && $password === $admin_password) {
        // Create session
        $_SESSION['admin_email'] = $admin_email;

        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire('Success', 'Login successful!', 'success')
                .then(() => { window.location.href = '../admin/dashboard.php'; });
              </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire('Error', 'Invalid email or password!', 'error')
                .then(() => { window.history.back(); });
              </script>";
    }
}
