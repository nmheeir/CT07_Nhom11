function showToast(message) {
    var container = document.querySelector('.container');
    var toast = document.createElement('div');
    toast.classList.add('toast', 'show', 'w-100');
    toast.innerHTML = `
        <div class="toast-header">
            <strong class="me-auto">Toast Header</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body">
            <p>${message}</p>
        </div>
    `;
    container.appendChild(toast);

    var bootstrapToast = new bootstrap.Toast(toast);

    // Ẩn toast sau 3 giây
    setTimeout(function() {
        bootstrapToast.hide();
    }, 3000);
}