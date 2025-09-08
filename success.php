<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Password Reset Sent</title>
  <link rel="stylesheet" href="public/css/forgetpassword.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
</head>
<body>
  <div class="container">
    <div id="success-container" class="card-container">
      <div class="header">
        <div class="logo">
          <span class="material-symbols-outlined">check</span>
        </div>
        <h1>Request Sent!</h1>
        <h2>Barangay 35 - Maypajo - Caloocan City</h2>
      </div>

      <div class="card">
        <h2>Check Your Email</h2>
        <p>We've sent password reset instructions to your email</p>

        <div class="success-box">
          <div class="icon-wrapper">
            <div class="ping"></div>
            <div class="icon">
              <span class="material-symbols-outlined">mail</span>
            </div>
          </div>
          <p id="maskedEmail"></p>
          <div class="waiting">Waiting for verification<span class="dots">...</span></div>
          <p class="info">
          Didn't receive the email? Check your inbox and spam/junk folder, then try again in a few minutes.
        </p>
        </div>



        <button onclick="window.location.href='forgotpassword.php'" class="outline-btn">Try Again</button>

        <div class="back">
          <a href="login.php"><span class="material-symbols-outlined">arrow_back</span>Back</a>
        </div>

        <hr>
        <div class="help">
          Need Help? <a href="#">Contact Barangay Health Center</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function maskEmail(value) {
      const [local, domain] = value.split("@");
      if (!domain) return value;
      if (local.length <= 2) {
        return `${local[0] ?? ""}***@${domain};
      }
      const first = local[0];
      const last = local[local.length - 1];
      const stars = "*".repeat(Math.max(3, local.length - 2));
      return `${first}${stars}${last}@${domain}`;
    }

    const params = new URLSearchParams(window.location.search);
    const email = params.get("email");
    if (email) {
      document.getElementById("maskedEmail").innerText =
        "An email with password reset instructions has been sent to " + maskEmail(email) + ".";
    }
  </script>
</body>
</html>
