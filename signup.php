<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>

  <link rel="stylesheet" href="public/css/signup.css">

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


    <div class="right">
      <h2>Sign up now</h2>
      <form id="signupForm" action="process/signup_process.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" id="Fname" name="Fname" placeholder="First name">
          <input type="text" id="Mname" name="Mname" placeholder="Middle name">
          <input type="text" id="Lname" name="Lname" placeholder="Last name">
          <input type="text" id="suffix" name="suffix" placeholder="suffix">

        </div>

        <input type="text" id="username" name="username" placeholder="Username">
        <div id="username_status" class="status-message"></div>

        <div class="form-group">
          <input type="email" id="email" name="email" placeholder="Email address">
          <input type="tel" pattern="^09\d{9}$" id="contact" name="contact" placeholder="Phone number">
        </div>
        <div id="email_status" class="status-message"></div>


        <input type="password" id="password" name="password" placeholder="Password">
        <div id="password_status" class="status-message"></div>


        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
        <div id="confirm_status" class="status-message"></div>

        <div class="upload-box">
          <input type="file" id="valid_id" name="valid_id" accept="image/jpeg,image/png,application/pdf">
          <label for="valid_id">Upload Valid ID</label>
          <p class="upload-note">Accepted formats: JPEG, PNG, PDF (max 2MB)</p>
          <small id="file_name" style="display:block; margin-top:5px; color:gray;"></small>

        </div>


        <div class="terms">
          <input class="checkbox" type="checkbox" id="terms" name="terms">
          I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.
        </div>

        <button type="submit" class="signup">Sign up</button>

        <div class="login-link">
          Already have an account? <a href="login.php">Log in</a>
        </div>
      </form>
    </div>
  </div>


  <script>
    document.getElementById('valid_id').addEventListener('change', function() {
      let fileName = this.files[0] ? this.files[0].name : "No file chosen";
      document.getElementById('file_name').textContent = "Selected file: " + fileName;
    });
  </script>

  <script>
    document.getElementById("signupForm").addEventListener("submit", function(event) {
      event.preventDefault();

      let form = this;
      let formData = new FormData(form);

      let fname = form.Fname.value.trim();
      let mname = form.Mname.value.trim();
      let lname = form.Lname.value.trim();
      let suffix = form.suffix.value.trim();
      let username = form.username.value.trim();
      let email = form.email.value.trim();
      let phone = form.contact.value.trim();
      let password = form.password.value.trim();
      let confirmpassword = form.confirm_password.value.trim();
      let terms = form.terms.checked;
      let validId = form.valid_id.files[0];

      if (!fname || !lname || !username || !email || !phone || !password || !confirmpassword || !terms) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Please fill in all required fields and agree to the terms.",
          confirmButtonColor: "#d33"
        });
        return;
      }


      fetch("process/signup_process.php", {
          method: "POST",
          body: formData
        })
        .then(res => res.text())
        .then(data => {
          if (data.includes("success")) {
            Swal.fire({
              icon: "success",
              title: "Account Created!",
              text: "Your account has been created successfully.",
              confirmButtonColor: "#00c853"
            }).then(() => window.location.href = "login.php");
          } else {
            Swal.fire({
              icon: "error",
              title: "Signup Failed",
              text: data,
              confirmButtonColor: "#d33"
            });
          }
        })
        .catch(err => {
          Swal.fire({
            icon: "error",
            title: "Error!",
            text: "Something went wrong. Try again.",
            confirmButtonColor: "#d33"
          });
          console.error(err);
        });
    });
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./public/js/username.js"></script>
  <script src="./public/js/email.js"></script>
  <script src="./public//js/password.js"></script>
</body>

</html>