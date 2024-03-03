function fetchAddOrder() {
    // Sử dụng Fetch API để thực hiện PUT request
    console.log(document.getElementById('deadline').value)
    var order = {
        'company_id': document.getElementById('company_id').value,
        'shipper_id': document.getElementById('shipper_id').value,
        'description': document.getElementById('description').value,
        'latitude': document.getElementById('latitude').value,
        'longitude': document.getElementById('longitude').value,
        'address': document.getElementById('searchAddress').value,
        'deadline': document.getElementById('deadline').value
    };
    fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(order),
    })
    .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
    .then(data => {
        showToast(data.message)
        clearInputs();
    })
    .catch(error => {
        showToast("Có lỗi, hãy đảm bảo đã điền đủ thông tin và chọn địa chỉ ở phần gợi ý.");
    });
}