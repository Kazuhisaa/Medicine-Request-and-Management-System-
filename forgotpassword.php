<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../css/forgetpassword.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />

</head>
<body>
  <div class="container">
    <div id="form-container" class="card-container">

      <div class="header">
            <div class="logo">
<span class="material-symbols-outlined">
lock
</span>
    </div>
        <h1>Forgot Password</h1>
        <h2>Barangay 35 - Maypajo - Caloocan City</h2>
      </div>


      <div class="card">
        <h2>Reset Your Password</h2>
        <p>Enter your email address to receive reset instructions</p>

        <form id="forgotForm">
          <div class="form-group">
            <input type="email" id="email" placeholder="Email address" required>
            <small>Enter the email address registered with your account</small>
          </div>

          <div class="note">
            <strong>Note:</strong>Password reset instructions will be sent via Email. Make sure the Email Address above is registered with your account.
          </div>

          <button type="submit" id="submitBtn">Send Reset Instructions</button>
        </form>
        <hr>

        <div class="back">
        <a href="login.html"><span class="material-symbols-outlined">arrow_back</span>Back to Login</a>
      </div>

      <hr>

      <div class="help">
        Need Help? <a href="#">Contact Barangay Health Center</a>
      </div>
    </div>

    <div class="footer-msg">
      <span class="material-symbols-outlined">shield</span>
      Your information is secure and protected
    </div>
  </div>

    <!-- Success Screen -->
    <div id="success-container" class="card-container hidden">
      <div class="header">
         <div class="logo">
       <span class="material-symbols-outlined">
check
</span>
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
            <div class="icon"><span class="material-symbols-outlined">
mail
</span></div>
          </div>
          <p id="maskedEmail"></p>
          <div class="waiting">Waiting for verification<span class="dots">...</span></div>
        </div>

        <p class="info">
          Didn't receive the email? Check your inbox and spam/junk folder, then try again in a few minutes.
        </p>

        <button id="tryAgainBtn" class="outline-btn">Try Again</button>

        <div class="back">
        <a href="login.html"><span class="material-symbols-outlined">arrow_back</span>Back to Login</a>
      </div>

      <hr>

      <div class="help">
        Need Help? <a href="#">Contact Barangay Health Center</a>
      </div>
    </div>
      </div>
    </div>
  </div>

  <script>
    function maskEmail(value) {
      const [local, domain] = value.split("@");
      if (!domain) return value;
      if (local.length <= 2) {
        return `${local[0] ?? ""}***@${domain}`;
      }
      const first = local[0];
      const last = local[local.length - 1];
      const stars = "*".repeat(Math.max(3, local.length - 2));
      return `${first}${stars}${last}@${domain}`;
    }

    const form = document.getElementById("forgotForm");
    const formContainer = document.getElementById("form-container");
    const successContainer = document.getElementById("success-container");
    const maskedEmailEl = document.getElementById("maskedEmail");
    const tryAgainBtn = document.getElementById("tryAgainBtn");
    const submitBtn = document.getElementById("submitBtn");

    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("email").value.trim();

      if (!email) {
        alert("Please enter your email");
        return;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address");
        return;
      }

      submitBtn.disabled = true;
      submitBtn.innerText = "Sending...";

      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerText = "Send Reset Instructions";
        formContainer.classList.add("hidden");
        successContainer.classList.remove("hidden");
        maskedEmailEl.innerText =
          "An email with password reset instructions has been sent to " +
          maskEmail(email) + ".";
      }, 2000);
    });

    tryAgainBtn.addEventListener("click", () => {
      formContainer.classList.remove("hidden");
      successContainer.classList.add("hidden");
      document.getElementById("email").value = "";
    });
  </script>
</body>
</html>
