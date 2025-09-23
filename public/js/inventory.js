// Add modal
const addModal = document.getElementById("addInventoryModal");
function openAddModal() { addModal.style.display = "block"; }
function closeAddModal() { addModal.style.display = "none"; }

// Edit modal
const editModal = document.getElementById("editInventoryModal");
function openEditModal(id, name, brand, category, quantity, unit, expiry, supplier, medicine_id) {
    editModal.style.display = "block";
    document.getElementById("editInventoryId").value = id;
    document.getElementById("editMedicineName").value = name;
    document.getElementById("editBrand").value = brand;
    document.getElementById("editCategory").value = category;
    document.getElementById("editQuantity").value = quantity;
    document.getElementById("editUnit").value = unit;
    document.getElementById("editExpiryDate").value = expiry;
    document.getElementById("editSupplier").value = supplier;
    document.getElementById("editMedicineId").value = medicine_id;
}
function closeEditModal() { editModal.style.display = "none"; }

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target == addModal) closeAddModal();
    if (event.target == editModal) closeEditModal();
}
