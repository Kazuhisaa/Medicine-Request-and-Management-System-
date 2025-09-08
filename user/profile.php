<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resident Information Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../public/css/userProfile.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div class="close-btn" onclick="toggleSidebar()">&#8249;</div>
  <div class="sidebar-header">
    <img src="../public/uploads/514427783_122207432900261758_6664477712173394040_n-removebg-preview.png" alt="Logo" class="logo">
    
    <h2>BOTIKA NG </h2>
    <small>BARANGAY 35</small>
  </div>
  <ul>
    <li><a href="../user/home.php"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="../user/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
    <li><a href="../user/medicine.php"><i class="fas fa-pills"></i> Medicine</a></li>
    <li><a href="../user/profile.php"><i class="fas fa-user"></i> Profile</a></li>
    <li><a href="#"><i class="fas fa-clipboard-list"></i> Request</a></li>
    <li class="logout"><a href="logout.php"><i class="fas fa-right-from-bracket"></i> Logout</a></li>
  </ul>
</div>

<!-- CONTENT -->
<div class="content">
  <div class="navbar">
    <div style="display: flex; align-items: center; gap: 20px;">
      <div class="menu-icon" onclick="toggleSidebar()"><i class="fas fa-bars"></i></div>
      <div><em><i class="fas fa-user"></i> USER PROFILE</em></div>
    </div>
  </div>

  <!-- FORM -->
  <div class="container">
    <div class="header">
      <img src="./514427783_122207432900261758_6664477712173394040_n-removebg-preview.png" alt="Profile">
      <h2>HELLO! Juan Dela Cruz (BRGY35-001)</h2>
    </div>

    <form>
      <div class="form-grid">
        <div class="form-group">
          <label for="fname">FIRST NAME</label>
          <input type="text" id="fname" name="fname" required>
        </div>
        <div class="form-group">
          <label for="mname">MIDDLE NAME</label>
          <input type="text" id="mname" name="mname">
        </div>
        <div class="form-group">
          <label for="lname">LAST NAME</label>
          <input type="text" id="lname" name="lname" required>
        </div>
        <div class="form-group">
          <label for="suffix">SUFFIX</label>
          <input type="text" id="suffix" name="suffix">
        </div>

        <div class="form-group">
          <label for="voters">VOTERS</label>
          <select id="voters" name="voters">
            <option value="YES">YES</option>
            <option value="NO">NO</option>
          </select>
        </div>
        <div class="form-group">
          <label for="dob">DATE OF BIRTH</label>
          <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label for="pob">PLACE OF BIRTH</label>
          <input type="text" id="pob" name="pob">
        </div>
        <div class="form-group">
          <label for="age">AGE</label>
          <input type="number" id="age" name="age" required>
        </div>

        <div class="form-group">
          <label for="gender">GENDER</label>
          <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="form-group">
          <label for="civil">CIVIL STATUS</label>
          <select id="civil" name="civil" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
          </select>
        </div>
        <div class="form-group">
          <label for="religion">RELIGION</label>
          <input type="text" id="religion" name="religion">
        </div>
        <div class="form-group">
          <label for="nationality">NATIONALITY</label>
          <input type="text" id="nationality" name="nationality">
        </div>

        <!-- ADDRESS -->
        <div class="address-group">
          <h3>ADDRESS</h3>
          <div class="address-fields">
            <div class="form-floating">
              <input type="text" id="house_no" name="house_no" placeholder=" " required>
              <label for="house_no">House Number</label>
            </div>
            <div class="form-floating">
              <input type="text" id="street" name="street" placeholder=" " required>
              <label for="street">Street</label>
            </div>
            <div class="form-floating">
              <input type="text" id="barangay" name="barangay" placeholder=" " required>
              <label for="barangay">Barangay</label>
            </div>
            <div class="form-floating">
              <input type="text" id="municipality" name="municipality" placeholder=" " required>
              <label for="municipality">Municipality</label>
            </div>
            <div class="form-floating">
              <input type="text" id="zip" name="zip" placeholder=" " required>
              <label for="zip">ZIP Code</label>
            </div>
          </div>
        </div>

        <div class="form-group full-width">
          <label for="email">EMAIL ADDRESS</label>
          <input type="email" id="email" name="email">
        </div>
        <div class="form-group full-width">
          <label for="contact">CONTACT NUMBER</label>
          <input type="tel" id="contact" name="contact" required>
        </div>
      </div>
      <button type="button" class="update-btn" onclick="openModal()">UPDATE PROFILE</button>

    </form>
  </div>
</div>
<!-- POPUP MODAL -->
<div id="updateModal" class="modal">
  <div class="modal-content">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <h2 class="upDate"  style="text-align:center; margin-bottom:50px;" >UPDATE YOUR PROFILE</h2>
    <form>
      <div class="form-grid">
        <div class="form-group">
          <label for="fname">FIRST NAME</label>
          <input type="text" id="fname" name="fname" required>
        </div>
        <div class="form-group">
          <label for="mname">MIDDLE NAME</label>
          <input type="text" id="mname" name="mname">
        </div>
        <div class="form-group">
          <label for="lname">LAST NAME</label>
          <input type="text" id="lname" name="lname" required>
        </div>
        <div class="form-group">
          <label for="suffix">SUFFIX</label>
          <input type="text" id="suffix" name="suffix">
        </div>

        <div class="form-group">
          <label for="voters">VOTERS</label>
          <select id="voters" name="voters">
            <option value="YES">YES</option>
            <option value="NO">NO</option>
          </select>
        </div>
        <div class="form-group">
          <label for="dob">DATE OF BIRTH</label>
          <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label for="pob">PLACE OF BIRTH</label>
          <input type="text" id="pob" name="pob">
        </div>
        <div class="form-group">
          <label for="age">AGE</label>
          <input type="number" id="age" name="age" required>
        </div>

        <div class="form-group">
          <label for="gender">GENDER</label>
          <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="form-group">
          <label for="civil">CIVIL STATUS</label>
          <select id="civil" name="civil" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Widowed">Widowed</option>
          </select>
        </div>
        <div class="form-group">
          <label for="religion">RELIGION</label>
          <input type="text" id="religion" name="religion">
        </div>
        <div class="form-group">
          <label for="nationality">NATIONALITY</label>
          <input type="text" id="nationality" name="nationality">
        </div>

        <!-- ADDRESS -->
        <div class="address-group">
          <h3>ADDRESS</h3>
          <div class="address-fields">
            <div class="form-floating">
              <input type="text" id="house_no" name="house_no" placeholder=" " required>
              <label for="house_no">House Number</label>
            </div>
            <div class="form-floating">
              <input type="text" id="street" name="street" placeholder=" " required>
              <label for="street">Street</label>
            </div>
            <div class="form-floating">
              <input type="text" id="barangay" name="barangay" placeholder=" " required>
              <label for="barangay">Barangay</label>
            </div>
            <div class="form-floating">
              <input type="text" id="municipality" name="municipality" placeholder=" " required>
              <label for="municipality">Municipality</label>
            </div>
            <div class="form-floating">
              <input type="text" id="zip" name="zip" placeholder=" " required>
              <label for="zip">ZIP Code</label>
            </div>
          </div>
        </div>

        <div class="form-group full-width">
          <label for="email">EMAIL ADDRESS</label>
          <input type="email" id="email" name="email">
        </div>
        <div class="form-group full-width">
          <label for="contact">CONTACT NUMBER</label>
          <input type="tel" id="contact" name="contact" required>
        </div>
      </div>
      <button type="submit" class="update-btn">SAVE CHANGES</button>
    </form>
  </div>
</div>

<script>
  function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
    document.querySelector(".content").classList.toggle("shift");
  }
    // Trigger animation kapag fully loaded na page
  window.addEventListener("load", () => {
    document.body.classList.add("loaded");
  });
  function openModal() {
  document.getElementById("updateModal").style.display = "block";
}
function closeModal() {
  document.getElementById("updateModal").style.display = "none";
}
// Isara kapag nag-click sa labas ng modal
window.onclick = function(event) {
  let modal = document.getElementById("updateModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>
