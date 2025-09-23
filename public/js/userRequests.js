const cartDiv = document.getElementById('cart');
const cartTitle = document.querySelector("h2"); // 🛒 Your Cart header

// Add to Cart buttons
document.querySelectorAll('.btn-add-cart').forEach(btn => {
  btn.addEventListener('click', e => {
    const card = e.target.closest('.medicine-card');
    const medId = card.dataset.id;

    console.log("Adding to cart (FormData), ID:", medId);

    const formData = new FormData();
    formData.append("id", medId);

    fetch("../process/addToCart.php", {
      method: "POST",
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          updateCartDisplay(data.cart);
        } else {
          alert("Error adding to cart: " + data.message);
        }
      })
      .catch(err => console.error("Fetch error:", err));
  });
});

// Remove from Cart
function removeFromCart(id) {
  const formData = new FormData();
  formData.append("id", id);

  fetch("../process/removeFromCart.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        updateCartDisplay(data.cart);
      } else {
        alert("Error removing item: " + data.message);
      }
    })
    .catch(err => console.error("Fetch error:", err));
}


// Update cart preview
function updateCartDisplay(cart) {
  if (Object.keys(cart).length === 0) {
    cartDiv.innerHTML = "<p>No medicines added yet.</p>";
  } else {
    let html = "<ul>";
    for (let id in cart) {
      const item = cart[id];
      html += `
        <li>
          ${item.name} (x${item.quantity})
          <button onclick="removeFromCart(${id})" class="btn btn-remove">❌</button>
        </li>
      `;
    }
    html += "</ul>";
    html += `
      <form id="checkoutForm" action="submitRequest.php" method="POST" enctype="multipart/form-data">
        <label>Upload Prescription (optional):</label>
        <input type="file" name="prescription">
        <button type="submit" class="btn btn-checkout">Submit Request</button>
      </form>
    `;
    cartDiv.innerHTML = html;
  }
}

// Toggle cart visibility kapag pinindot yung title
cartTitle.addEventListener("click", () => {
  cartDiv.classList.toggle("show");
});

// Category filtering
document.querySelectorAll('.filter-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const cat = btn.dataset.category;
    document.querySelectorAll('.medicine-card').forEach(card => {
      card.style.display = (cat === 'all' || card.dataset.category === cat) ? 'block' : 'none';
    });
  });
});
