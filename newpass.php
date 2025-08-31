<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password</title>
  <link rel="stylesheet" href="href="../css/newpass.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="logo">
      <span class="material-symbols-outlined">
lock_open
</span>
    </div>

    <h1>Change Password</h1>
    <h2>Barangay 35 - Maypajo - Caloocan City</h2>

    <div class="card">
      <h2>Update Your Password</h2>
      <p>Choose a strong password to keep your account secure</p>

      <form id="loginForm" action="" method="POST">
      <div class="input-wrapper">

        <input id="identifier" name="identifier" class="search-bar" type="password" placeholder="New Password" required>

        <input id="identifier" name="identifier" class="search-bar" type="password" placeholder="Confirm Password" required>
        <small>Enter the Email Address registered with your Account</small>

        <div class="note">
          <strong>Password Tips:</strong> <br>
• Use a unique password you don't use elsewhere <br>
• Mix uppercase, lowercase, numbers, and symbols <br>
• Avoid personal information like birthdays or names <br>
        </div>

<a href="newpass.html" class="btn-link">Submit</a>

      </form>

      <div class="back">
        <a href="login.php"><span class="material-symbols-outlined">arrow_back</span>Back to Login</a>
      </div>

      <hr>

      <div class="help">
        Need Help? <a href="#">Contact Barangay Health Center</a>
      </div>
    </div>
</div>
    <div class="footer-msg">
      <span class="material-symbols-outlined">shield</span>
      Your information is secure and protected
    </div>
  </div>
</body>

</html>
