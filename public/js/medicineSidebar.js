
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
              <p class="availability">${m.stocks} available • In Stock</p>
              <button class="addBtn">Add to Request</button>
            </div>
          `;

          // Button event -> open modal
          card.querySelector(".addBtn").addEventListener("click", () => {
            selectedMedicine = m;
            modal.style.display = "flex";

            modalName.textContent = m.name;
            modalCategory.textContent = m.category;
            modalDescription.textContent = m.note || "No description";
            modalDosage.textContent = m.dosage;
            modalStocks.textContent = m.stocks;
          });

          medicineList.appendChild(card);
        });
    }

    // Category filter
    categoryButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        document.querySelector(".categories button.active").classList.remove("active");
        btn.classList.add("active");
        renderMedicines(btn.dataset.category, searchInput.value);
      });
    });

    // Search filter
    searchInput.addEventListener("input", () => {
      const activeCategory = document.querySelector(".categories button.active").dataset.category;
      renderMedicines(activeCategory, searchInput.value);
    });

    // Initial render
    renderMedicines();

    function toggleSidebar() {
      document.querySelector(".sidebar").classList.toggle("active");
      document.querySelector(".content").classList.toggle("shift");
    }

    const modal = document.getElementById("medicineModal");
    const closeBtn = document.querySelector(".close");
    const addToSelectedBtn = document.getElementById("addToSelectedBtn");
    const cartCount = document.querySelector(".cart-count");
    const cartModal = document.getElementById("cartModal");
    const closeCart = document.querySelector(".closeCart");
    const cartList = document.getElementById("cartList");

    // Elements sa modal
    const modalName = document.getElementById("modalName");
    const modalCategory = document.getElementById("modalCategory");
    const modalDescription = document.getElementById("modalDescription");
    const modalDosage = document.getElementById("modalDosage");
    const modalStocks = document.getElementById("modalStocks");

    let selectedMedicine = null;
    let selectedMedicines = []; // {name, dosage, category, qty}

    // Close modal
    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; }

    // Open cart popup pag click sa 0
    cartCount.addEventListener("click", () => {
      cartModal.style.display = "flex";
      renderCart();
    });

    // Close cart popup
    closeCart.addEventListener("click", () => {
      cartModal.style.display = "none";
    });
    window.addEventListener("click", (e) => {
      if (e.target === cartModal) cartModal.style.display = "none";
    });

    // Render cart items
    function renderCart() {
      cartList.innerHTML = "";

      if (selectedMedicines.length === 0) {
        cartList.innerHTML = "<p>No medicines selected.</p>";
        return;
      }

      selectedMedicines.forEach((med, index) => {
        const row = document.createElement("div");
        row.className = "cart-item";
        row.innerHTML = `
          <div class="cart-info">
            <strong>${med.name}</strong> (${med.dosage})<br><br>
            <small>${med.category}</small><br><br>
            <strong><span>Qty: ${med.qty}</span></strong>
          </div>
          <button class="removeBtn" data-index="${index}">Remove</button>
        `;
        cartList.appendChild(row);
      });

      // Remove button actions
      document.querySelectorAll(".removeBtn").forEach(btn => {
        btn.addEventListener("click", e => {
          const idx = e.target.dataset.index;
          selectedMedicines.splice(idx, 1);
          updateCartCount();
          renderCart();
        });
      });
    }

    // Update cart number
    function updateCartCount() {
      cartCount.textContent = selectedMedicines.reduce((sum, m) => sum + m.qty, 0);
    }

    // Add medicine from modal
    addToSelectedBtn.addEventListener("click", () => {
      if (selectedMedicine) {
        let existing = selectedMedicines.find(m => m.name === selectedMedicine.name && m.dosage === selectedMedicine.dosage);
        if (existing) {
          existing.qty++;
        } else {
          selectedMedicines.push({...selectedMedicine, qty: 1});
        }
        updateCartCount();
        modal.style.display = "none";
      }
    });
      
    // Initial
    updateCartCount();
