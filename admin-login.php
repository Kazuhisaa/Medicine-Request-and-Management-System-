<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="public/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="logo">
      <span class="material-symbols-outlined">
        admin_panel_settings
      </span>
    </div>

    <h1>Admin Portal</h1>
    <h2>Barangay 35 - Maypajo - Caloocan City</h2>

    <div class="card">
      <h3>Admin Login</h3>
      <p>Restricted access for authorized personnel</p>

      <form id="loginForm" action="process/adminLogin__process.php" method="POST">
        <input id="identifier" name="identifier" class="search-bar" type="text" placeholder="Admin Email">
        <input id="password" name="password" class="search-bar" type="password" placeholder="Password">

        <button type="submit" id="login" name="login">Login</button>
      </form>
    
        <div class="back">
          <a href="login.php"><span class="material-symbols-outlined">arrow_back</span>Back to Login</a>
        </div>

    </div>
    <div class="footer-msg">
      <span class="material-symbols-outlined">shield</span>Authorized access only. Activity may be monitored.
    </div>
  </div>
  </div>



</body>

</html>