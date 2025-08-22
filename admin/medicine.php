<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Botika ng Barangay 35</title>
  <link rel="stylesheet" href="../public/css/medicine.css">
</head>
<body>
    <style>
        .categories button.active {
      background: linear-gradient(135deg, #2E7D32, #4CAF50);
      color: white;
    }
    .categories button:hover {
      background: linear-gradient(135deg, #1b5e20, #388e3c);
      color: white;
    }
    </style>
  <!-- Navbar -->
  <div class="navbar">
    <div>
      <h1>Botika ng Barangay 35</h1>
      <small>Online Medicine Request System</small>
    </div>
  </div>

  <div class="header-buttons">
    <button>Request History</button>
    <button>Account</button>
  </div>

  <div class="welcome">
    <p><strong>Request medicines for Barangay 35 </strong></p>
  </div>

  <!-- Search Section -->
  <div class="search-section">
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Search Medicine">
      <button>Upload Prescription</button>
    </div>
    <div class="categories">
      <button class="active" data-category="All">All Categories</button>
      <button data-category="Hypertension">Hypertension</button>
      <button data-category="Diabetes">Diabetes</button>
      <button data-category="Cholesterol">Cholesterol</button>
      <button data-category="Multivitamins">Multivitamins</button>
      <button data-category="Pain Relief">Pain Reliever</button>
      <button data-category="Anti-Ashtma">Anti-Ashtma</button>
      <button data-category="Antibiotic">Antibiotic</button>
    </div>
  </div>

  <!-- Medicines -->
  <div class="medicines" id="medicineList"></div>

  <script>
    const medicines = [
      // Hypertension
      {name:"Losartan", brand:"Losartan", dosage:"50mg", note:"-", category:"Hypertension"},
      {name:"Amlodipine", brand:"Kodapine", dosage:"5mg", note:"-", category:"Hypertension"},
      {name:"Amlodipine", brand:"Genvasc10", dosage:"10mg", note:"-", category:"Hypertension"},
      {name:"Telmisartan", brand:"Beisartan", dosage:"40mg", note:"-", category:"Hypertension"},
      {name:"Metropolol", brand:"Loprexo", dosage:"50mg", note:"-", category:"Hypertension"},

      // Diabetes
      {name:"Metformin", brand:"Glycemet", dosage:"500mg", note:"-", category:"Diabetes"},
      {name:"Sitagpilin", brand:"Sitagard", dosage:"50mg", note:"-", category:"Diabetes"},

      // Cholesterol
      {name:"Atorvastatin", brand:"Lestor", dosage:"40mg", note:"-", category:"Cholesterol"},
      {name:"Simvastatin", brand:"Simvasyn", dosage:"20mg", note:"-", category:"Cholesterol"},

      // Multivitamins
      {name:"B1B6B12Complex", brand:"Nervita", dosage:"100mg/5mg/50mcg", note:"-", category:"Multivitamins"},
      {name:"Multivitamins", brand:"Multivita", dosage:"No Dosage", note:"For Adult", category:"Multivitamins"},
      {name:"Multivitamins", brand:"Myrevit", dosage:"60mg", note:"For Ages 3yro - 12 yro", category:"Multivitamins"},

      // Pain Relief
      {name:"Paracetamol", brand:"Paracetamol", dosage:"500mg", note:"For Adult", category:"Pain Relief"},
      {name:"Mefenamic Acid", brand:"Remef", dosage:"500mg", note:"For Adult - Capsule", category:"Pain Relief"},
      {name:"Diclofenac Sodium", brand:"Boren", dosage:"50mg", note:"For Adult - Tablet", category:"Pain Relief"},

      // Anti-Ashtma
      {name:"Lagundi Leaf", brand:"Lagundi", dosage:"600mg", note:"For Adult", category:"Anti-Ashtma"},
      {name:"Ambroxol", brand:"Couxin", dosage:"30mg", note:"For Adult - Tablet", category:"Anti-Ashtma"},
      {name:"Salbutamol", brand:"Ventrex", dosage:"2mg", note:"For Adult - Tablet", category:"Anti-Ashtma"},
      {name:"Salbutamol", brand:"Salbusaph", dosage:"1mg / 2.5mg", note:"Bronchodilator", category:"Anti-Ashtma"},

      // Antibiotic
      {name:"Amoxicillin", brand:"Axmel", dosage:"500mg", note:"For Adult - Capsule", category:"Antibiotic"},
      {name:"Cotrimaxazole", brand:"Kathrex", dosage:"480mg", note:"Sulfonamide", category:"Antibiotic"},
    ];

    const medicineList = document.getElementById("medicineList");
    const searchInput = document.getElementById("searchInput");
    const categoryButtons = document.querySelectorAll(".categories button");

    function renderMedicines(filterCategory = "All", searchText = "") {
      medicineList.innerHTML = "";
      medicines
        .filter(m => (filterCategory === "All" || m.category === filterCategory))
        .filter(m => m.name.toLowerCase().includes(searchText.toLowerCase()) || m.brand.toLowerCase().includes(searchText.toLowerCase()))
        .forEach(m => {
          const card = document.createElement("div");
          card.className = "card";
          card.innerHTML = `
            <div class="card-placeholder">Pic</div>
            <div class="card-body">
              <h3>${m.name} <span class="badge">${m.category}</span></h3>
              <p>${m.brand} • ${m.dosage}</p>
              <p>${m.note}</p>
              <p class="availability">100 available • In Stock</p>
              <button>Add to Request</button>
            </div>
          `;
          medicineList.appendChild(card);
        });
    }

    // Category
    categoryButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        document.querySelector(".categories button.active").classList.remove("active");
        btn.classList.add("active");
        renderMedicines(btn.dataset.category, searchInput.value);
      });
    });

    // Search
    searchInput.addEventListener("input", () => {
      const activeCategory = document.querySelector(".categories button.active").dataset.category;
      renderMedicines(activeCategory, searchInput.value);
    });

    //render
    renderMedicines();
  </script>
</body>
</html>
