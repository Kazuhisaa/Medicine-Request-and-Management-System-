<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=pill" />

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

      <form id="loginForm">
        <input id="email" name="email" class="search-bar" type="email" placeholder="Email Address" required>

        <input id="password" name="password" class="search-bar" type="password" placeholder="Password" required>

        <button type="submit">Login</button>
      </form>

      <div class="forgot-password">
        <a href="">Forgot Password?</a>
      </div>

      <div class="signup-link">
        Don't have an account? <a href="signup.html">Sign up here</a>
      </div>
    </div>
    <div class="footer-msg">
      Your information is secure and protected
    </div>
    </div>
  </div>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
      event.preventDefault(); 

      Swal.fire({
        title: "Successfully Logged In!",
        text: "Welcome back!",
        icon: "success",
        confirmButtonColor: "#4CAF50"
      });
    });
  </script>
</body>
</html>

