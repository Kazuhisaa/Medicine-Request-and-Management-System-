// ---------------- Admin ----------------
function initRequestsAdmin(){
    // View modal
    document.querySelectorAll('.btn-view').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const id = btn.dataset.id;
            const row = document.getElementById(`request-${id}`);
            document.getElementById('viewRequestUser').textContent = row.cells[1].textContent;
            document.getElementById('viewRequestMedicine').textContent = row.cells[2].textContent;
            document.getElementById('viewRequestStatus').textContent = row.cells[3].textContent;
            document.getElementById('viewRequestModal').style.display='flex';
        });
    });

    // Accept/Reject buttons
    document.querySelectorAll('.btn-accept, .btn-reject').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const id = btn.dataset.id;
            const status = btn.classList.contains('btn-accept') ? 'accepted' : 'rejected';
            updateRequestStatus(id,status);
        });
    });

    initModalClose(); // Close modals
}

// ---------------- User ----------------
function initRequestsUser(){
    // View modal
    document.querySelectorAll('.btn-view').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            const id = btn.dataset.id;
            const row = document.getElementById(`request-${id}`);
            document.getElementById('viewRequestMedicine').textContent = row.cells[1].textContent;
            document.getElementById('viewRequestStatus').textContent = row.cells[2].textContent;
            document.getElementById('viewRequestModal').style.display='flex';
        });
    });

    // Add request modal
    const addModal = document.getElementById('addRequestModal');
    document.getElementById('btnAddRequest').addEventListener('click', ()=>addModal.style.display='flex');
    addModal.querySelector('.btn-cancel').addEventListener('click', ()=>addModal.style.display='none');

    initModalClose(); // Close modals
}

// ---------------- Update Request Status via AJAX ----------------
function updateRequestStatus(id,status){
    fetch('../process/updateRequestStatus.php',{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`id=${id}&status=${status}`
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            const row = document.getElementById(`request-${id}`);
            row.querySelector('.status').textContent=status;
            row.querySelectorAll('.btn-accept, .btn-reject').forEach(btn=>btn.remove());
        } else alert('Failed to update request status.');
    });
}

// ---------------- Modal Close Function ----------------
function initModalClose(){
    document.querySelectorAll('.close-btn, .btn-close').forEach(btn=>{
        btn.addEventListener('click', ()=>{
            btn.closest('.modal').style.display='none';
        });
    });
    window.addEventListener('click', e=>{
        document.querySelectorAll('.modal').forEach(modal=>{
            if(e.target===modal) modal.style.display='none';
        });
    });
    window.addEventListener('keydown', e=>{
        if(e.key==='Escape'){
            document.querySelectorAll('.modal').forEach(modal=>modal.style.display='none');
        }
    });
}
