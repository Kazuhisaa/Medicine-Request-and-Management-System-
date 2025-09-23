// ---------- Add Modal ----------
function openAddModal() {
  const modal = document.getElementById('addMedicineModal');
  if (!modal) return;
  modal.querySelector('form').reset();
  modal.style.display = 'flex';
}
function closeAddModal() {
  const modal = document.getElementById('addMedicineModal');
  if(modal) modal.style.display = 'none';
}

// ---------- Edit Modal ----------
function openEditModal(id, name, brand, category, dosage, description, stock) {
  const modal = document.getElementById('editMedicineModal');
  if (!modal) return;

  document.getElementById('editMedicineId').value = id;
  document.getElementById('editMedicineName').value = name;
  document.getElementById('editMedicineBrand').value = brand;
  document.getElementById('editMedicineCategory').value = category;
  document.getElementById('editMedicineDosage').value = dosage;
  document.getElementById('editMedicineDescription').value = description;
  document.getElementById('editMedicineStock').value = stock;

  modal.style.display = 'flex';
}
function closeEditModal() {
  const modal = document.getElementById('editMedicineModal');
  if(modal) modal.style.display = 'none';
}

// ---------- Delete Modal ----------
function openDeleteModal(id) {
  const modal = document.getElementById('deleteMedicineModal');
  if (!modal) return;
  document.getElementById('deleteMedicineId').value = id;
  modal.style.display = 'flex';
}
function closeDeleteModal() {
  const modal = document.getElementById('deleteMedicineModal');
  if(modal) modal.style.display = 'none';
}
function openViewModal(card) {
  document.getElementById('viewMedicineName').textContent = card.dataset.name;
  document.getElementById('viewMedicineBrand').textContent = card.dataset.brand;
  document.getElementById('viewMedicineCategory').textContent = card.dataset.category;
  document.getElementById('viewMedicineDosage').textContent = card.dataset.dosage;
  document.getElementById('viewMedicineDescription').textContent = card.dataset.description;
  document.getElementById('viewMedicineStock').textContent = card.dataset.stock;
  document.getElementById('viewMedicineDate').textContent = card.dataset.date;

  const imgEl = document.getElementById('viewMedicineImage');
  if(card.dataset.image) {
    imgEl.src = card.dataset.image;
    imgEl.style.display = 'block';
  } else {
    imgEl.style.display = 'none';
  }

  document.getElementById('viewMedicineModal').style.display = 'flex';
}
function closeViewModal() {
  const modal = document.getElementById('viewMedicineModal');
  if(modal) modal.style.display = 'none';
}



// ---------- Close modal when clicking outside ----------
window.addEventListener('click', e => {
  ['addMedicineModal','editMedicineModal','deleteMedicineModal','viewMedicineModal'].forEach(id=>{
    const modal = document.getElementById(id);
    if(modal && e.target===modal) modal.style.display='none';
  });
});

// ---------- Close with Escape ----------
window.addEventListener('keydown', e => {
  if(e.key==='Escape'){
    ['addMedicineModal','editMedicineModal','deleteMedicineModal','viewMedicineModal'].forEach(id=>{
      const modal = document.getElementById(id);
      if(modal) modal.style.display='none';
    });
  }
});




// ----------------- Category Filter -----------------
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const category = btn.getAttribute('data-category').toLowerCase();
    document.querySelectorAll('.medicine-card').forEach(card => {
      const cardCat = card.getAttribute('data-category').toLowerCase();
      card.style.display = (category === 'all' || cardCat === category) ? 'flex' : 'none';
    });
  });
});

// ----------------- Close modals on click outside -----------------
window.addEventListener('click', e => {
  ['addMedicineModal','editMedicineModal','deleteMedicineModal','viewMedicineModal'].forEach(id => {
    const modal = document.getElementById(id);
    if (modal && e.target === modal) modal.style.display = 'none';
  });
});

// Close with Escape
window.addEventListener('keydown', e => {
  if(e.key === 'Escape'){
    ['addMedicineModal','editMedicineModal','deleteMedicineModal','viewMedicineModal'].forEach(id => {
      const modal = document.getElementById(id);
      if(modal) modal.style.display = 'none';
    });
  }
});
