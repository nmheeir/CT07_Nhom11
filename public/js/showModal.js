var myModal; // Khai báo biến myModal ở phạm vi toàn cục để nó có thể được truy cập từ mọi hàm

function showModalWithCallBack(message, callback, ...params) {
    var container = document.querySelector('.container');
    var modal = document.createElement('div');
    modal.classList.add('modalContainer')
    modal.innerHTML = `
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    ${message}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="updateButton">Cập nhật</button>
                </div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(modal);
    myModal = new bootstrap.Modal(document.getElementById('staticBackdrop')); // Lưu tham chiếu đến modal
    myModal.show(); // Hiển thị modal
    
    // Gắn sự kiện click cho nút "Cập nhật"
    document.getElementById('updateButton').addEventListener('click', function() {
        closeModal(); // Đóng modal
        callback(...params); // Gọi callback
    });
}


function showModalWithoutCallBack(message) {
    console.log("cc")
    var container = document.querySelector('.container');
    var modal = document.createElement('div');
    modal.classList.add('modalContainer')
    modal.innerHTML = `
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    ${message}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal()">Đóng</button>
                </div>
                </div>
            </div>
        </div>
    `;
    container.appendChild(modal);
    myModal = new bootstrap.Modal(document.getElementById('staticBackdrop')); // Lưu tham chiếu đến modal
    myModal.show(); // Hiển thị modal
}


function closeModal() {
    if (myModal) { // Kiểm tra nếu modal đã được khởi tạo
        myModal.hide(); // Ẩn modal
        // Xóa modal khỏi DOM
        var modalElement = document.querySelector('.modalContainer');
        modalElement.parentNode.removeChild(modalElement);
    }
}

