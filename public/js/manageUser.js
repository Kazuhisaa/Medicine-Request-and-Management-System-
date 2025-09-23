function openAddForm() {
  document.getElementById("modalTitle").innerText = "Add User";
  document.getElementById("userId").value = "";
  document.getElementById("Fname").value = "";
  document.getElementById("Mname").value = "";
  document.getElementById("Lname").value = "";
  document.getElementById("suffix").value = "";
  document.getElementById("username").value = "";
  document.getElementById("email").value = "";
  document.getElementById("contact").value = "";
  document.getElementById("password").required = true;
  document.getElementById("passwordNote").style.display = "none";
  document.getElementById("userModal").style.display = "flex";
}

function editUser(id, fname, mname, lname, suffix, username, email, contact) {
  document.getElementById("modalTitle").innerText = "Edit User";
  document.getElementById("userId").value = id;
  document.getElementById("Fname").value = fname;
  document.getElementById("Mname").value = mname;
  document.getElementById("Lname").value = lname;
  document.getElementById("suffix").value = suffix;
  document.getElementById("username").value = username;
  document.getElementById("email").value = email;
  document.getElementById("contact").value = contact;
  document.getElementById("password").required = false;
  document.getElementById("passwordNote").style.display = "block";
  document.getElementById("userModal").style.display = "flex";
}

function closeModal() {
  document.getElementById("userModal").style.display = "none";
}
