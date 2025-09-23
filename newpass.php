  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="public/css/newpass.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>

  <style>
    .status-message {
      font-size: 13px;
      margin-top: -10px;
      margin-bottom: 10px;
      display: block;
      transition: color 0.3s ease, transform 0.2s ease;
    }

    /* kapag valid / available */
    .status-message.available {
      color: #4CAF50;
      /* green */
      font-weight: 500;
    }

    /* kapag invalid / taken */
    .status-message.taken {
      color: #e53935;
      /* red */
      font-weight: 500;
    }
  </style>

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

        <form id="loginForm" action="process/newPassword_process.php" method="POST">
          <div class="input-wrapper">
            <?php $token = isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>
            <input type="hidden" name="token" value="<?= $token ?>">
            <input id="password" class="search-bar" type="password" name="password" placeholder="New Password" required>
            <div id="password_status" class="status-message"></div>


            <input id="confirm_password" class="search-bar" type="password" name="confirmPassword" placeholder="Confirm Password" required>
            <div id="confirm_status" class="status-message"></div>

            <small>Enter the Email Address registered with your Account</small>

            <div class="note">
              <strong>Password Tips:</strong> <br>
              • Use a unique password you don't use elsewhere <br>
              • Mix uppercase, lowercase, numbers, and symbols <br>
              • Avoid personal information like birthdays or names <br>
            </div>

            <button type="submit" class="btn-link" name="submit">Submit</button>

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./public/js/password.js"></script>

  </html>