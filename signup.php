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



<body>
  <div class="content">
    <div class="box">
      <p class="Login">Sign Up</p>
      <form action="">
        <p>Name</p>
        <input id="name" name="name" class="search-bar" type="text" placeholder="Enter Name" required>
        <p>Usename</p>
        <input id="Username" name="User" class="search-bar" type="text" placeholder="Enter Username" required>
        <p>Email</p>
        <input id="email" name="email" class="search-bar" type="email" placeholder="Enter Email" required> <br>
        <p>Address</p>
        <input id="address" name="address" class="search-bar" type="text" placeholder="Enter Address" required> <br>
        <p>Contact</p>
        <input id="phone" name="phone" class="search-bar" type="tel" placeholder="Enter Contact Number" required> <br>
        <p>Password</p>
        <input id="password" name="password" class="search-bar" type="password" placeholder="Enter Password" required> <br>
        <p>Confirm Password</p>
        <input id="confirm-password" name="confirm_password" class="search-bar" type="password" placeholder="Confirm Password" required> <br>
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
  <script src="public/js/username.js"></script>



</body>
</html>