<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>

   <link rel="stylesheet" href="signup.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

  <div class="container">
    <div class="left">
      <div class="logo"><span class="material-symbols-outlined">health_cross</span></div>
      <h1>Medicine Request System</h1>
      <p>Barangay 35 - Maypajo - Caloocan City</p>
    </div>

    <div class="right">
      <h2>Sign up now</h2>
      <form id="signupForm">
        <div class="form-group">
          <input type="text" id="fname" placeholder="First name" required>
          <input type="text" id="mname" placeholder="Middle name" required>
          <input type="text" id="lname" placeholder="Last name" required>
        </div>

        <input type="text" id="fname" placeholder="Username" required>

        <form id="signupForm">
        <div class="form-group">
          <input type="email" id="email" placeholder="Email address" required>
        <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" id="phone" placeholder="Phone number" required>
        </div>

        <input type="password" id="password" placeholder="Password" type="password" required>

        <input type="password" id="confirmpassword" placeholder="Confirm Password" type="password" required>

        <div class="terms">
          <input class="checkbox" type="checkbox" id="terms" required>
          I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
        </div>

        <button type="submit">Sign up</button>

        <div class="login-link">
        Already have an account? <a href="signup.html">Log in</a>
      </div>
        </div>
      </form>
    </div>
  </div>

<script>
document.getElementById("signupForm").addEventListener("submit", function(event) {
  event.preventDefault();

  let fname = document.getElementById("fname").value.trim();
  let mname = document.getElementById("mname").value.trim();
  let lname = document.getElementById("lname").value.trim();
  let email = document.getElementById("email").value.trim();
  let phone = document.getElementById("phone").value.trim();
  let password = document.getElementById("password").value.trim();
  let confirmpassword = document.getElementById("confirmpassword").value.trim();
  let terms = document.getElementById("terms").checked;

  if (!fname || !mname|| !lname || !email || !phone || !password || !confirmpassword || !terms) {
    Swal.fire({
      title: "Error!",
      text: "Please fill in all required fields and agree to the terms.",
      icon: "error",
      confirmButtonColor: "#d33"
    });
    return;
  }

 
  if (password.length < 8) {
    Swal.fire({
      title: "Weak Password",
      text: "Password must be at least 8 characters long.",
      icon: "warning",
      confirmButtonColor: "#f0ad4e"
    });
    return;
  }

  if (password !== confirmpassword) {
    Swal.fire({
      icon: "error",
      title: "Password Mismatch",
      text: "Passwords do not match!",
      confirmButtonColor: "#d33"
    });
    return;
  }


  Swal.fire({
    icon: "success",
    title: "Account Created!",
    text: "Your account has been created successfully.",
    confirmButtonColor: "#00c853"
  }).then(() => {
    window.location.href = "login.html"; 
  });
});
</script>


</body>
</html>
