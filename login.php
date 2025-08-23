<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="public/css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=pill" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div class="container">
    <div class="logo">
      <span class="material-symbols-outlined">
        pill
      </span>
    </div>

    <h1>Medicine Request System</h1>
    <h2>Barangay 35 - Maypajo - Caloocan City</h2>

    <div class="card">
      <h3>Welcome Back</h3>
      <p>Sign in to your account to request medicines</p>

      <form id="loginForm" action="/process/login_process.php" method="POST">
        <input id="identifier" name="identifier" class="search-bar" type="text" placeholder=" Username / Email Address">
        <input id="password" name="password" class="search-bar" type="password" placeholder="Password">

        <button type="submit" id="login" name="login">Login</button>
      </form>

      <div class="forgot-password">
        <a href="forgotpassword.php">Forgot Password?</a>
      </div>

      <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign up here</a>
      </div>
    </div>
    <div class="footer-msg">
      Your information is secure and protected
    </div>
  </div>
  </div>

  <script>
    $(document).ready(function() {
      $("#loginForm").on("submit", function(e) {
        e.preventDefault(); // prevent normal form submit

        var identifier = $("#identifier").val().trim();
        var password = $("#password").val().trim();

        if (identifier === "" || password === "") {
          Swal.fire({
            icon: "warning",
            title: "Missing Fields",
            text: "Please fill in both fields."
          });
          return;
        }

        $.ajax({
          url: "process/login_process.php", // path sa PHP
          method: "POST",
          data: {
            identifier: identifier,
            password: password
          },
          success: function(response) {
            // response galing sa PHP
            if (response === "success") {
              Swal.fire({
                icon: "success",
                title: "Login Successful!",
                text: "Welcome back!",
                confirmButtonColor: "#4CAF50"
              }).then(() => window.location.href = "user/dashboard.php");
            } else {
              Swal.fire({
                icon: "error",
                title: "Login Failed",
                text: response
              });
            }
          },
          error: function() {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Something went wrong. Try again later."
            });
          }
        });
      });
    });
  </script>

</body>

</html>