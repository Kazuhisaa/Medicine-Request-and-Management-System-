<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/signup.css">

</head>
<style>
  .status-message {
    font-size: 13px;
    margin: 0 0 10px 0;
    padding: 0;
    text-align: left;

  }

  .status-message.taken {
    color: #d8000c;
  }

  .status-message.available {
    color: #4f8a10;
  }
</style>


<body>

  <div class="content">
    <div class="box">
      <p class="Login">Sign Up</p>
      <form id="sigupForm" action="process/signup_process.php" method="POST" enctype="multipart/form-data">
        <p>First Name</p>
        <input id="Fname" name="Fname" class="search-bar" type="text" placeholder="First Name" required>
        <p>Last Name</p>
        <input id="Lname" name="Lname" class="search-bar" type="text" placeholder="Last Name" required>
        <p>Middle Name</p>
        <input id="Mname" name="Mname" class="search-bar" type="text" placeholder="Middle Name" required>
        <p>Suffix</p>
        <input id="suffix" name="suffix" class="search-bar" type="text" placeholder="(Jr,)">

        <p>Username</p>
        <input id="username" name="username" class="username-bar" type="text" placeholder="Enter Username" required>
        <div id="username_status" class="status-message"></div>

        <p>Email</p>
        <input id="email" name="email" class="email-bar" type="email" placeholder="Enter Email" required> <br>
        <div id="email_status" class="status-message"></div>

        <p>Address</p>
        <input id="address" name="address" class="search-bar" type="text" placeholder="Enter Address" required> <br>
        <p>Contact</p>
        <input id="contact" name="contact" class="search-bar" type="tel" placeholder="Enter Contact Number" required> <br>

        <p>Password</p>
        <input id="password" name="password" class="email-bar" type="password" placeholder="Enter Password" required> <br>
        <div id="password_status" class="status-message"></div>

        <p>Confirm Password</p>
        <input id="confirm_password" name="confirm_password" class="email-bar" type="password" placeholder="Confirm Password" required> <br>
        <div id="confirm_status" class="status-message"></div>

        <p class="brgyp">Barangay ID</p>
        <div class="file">
          <input id="barangay-id" name="barangay_id" type="file" accept=".jpg,.png,.pdf">
        </div>
        <br>

        <input class="signup" type="submit" value="Sign Up">
      </form>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./public/js/username.js"></script>
  <script src="./public/js/email.js"></script>
  <script src="./public//js/password.js"></script>




</body>

</html>