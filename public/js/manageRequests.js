// ---------- View Request ----------
function openViewRequestModal(card) {
    document.getElementById('viewRequestUser').textContent = card.dataset.username;
    document.getElementById('viewRequestSubject').textContent = card.dataset.subject;
    document.getElementById('viewRequestMessage').textContent = card.dataset.message;
    document.getElementById('viewRequestStatus').textContent = card.dataset.status;
    document.getElementById('viewRequestDate').textContent = card.dataset.date;
    document.getElementById('viewRequestModal').style.display = 'flex';
}
function closeViewRequestModal() {
    const modal = document.getElementById('viewRequestModal');
    if(modal) modal.style.display = 'none';
}

// ---------- Change Status ----------
function changeRequestStatus(id, status) {
    if(!confirm(`Are you sure you want to mark this request as ${status}?`)) return;

    fetch(`../process/manageRequestProcess.php`, {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}&status=${status}`
    })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            alert(res.message);
            location.reload(); // refresh to update status
        } else {
            alert('Failed to update status');
        }
    });
}

// ---------- Close modal when clicking outside ----------
window.addEventListener('click', e => {
    const modal = document.getElementById('viewRequestModal');
    if(modal && e.target === modal) modal.style.display = 'none';
});

// Close with Escape
window.addEventListener('keydown', e => {
    if(e.key==='Escape'){
        const modal = document.getElementById('viewRequestModal');
        if(modal) modal.style.display='none';
    }
});
