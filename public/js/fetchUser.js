function activeUpdate(userId, activeUpdate) {
    console.log("cập nhật active")
    const dataToSend = {
        id: userId,
        active: activeUpdate
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/User/activeControl`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(() => {
        location.reload()
    })
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi (nếu cần)
    });
}

function deleteUser(userId) {
    // Dữ liệu bạn muốn gửi lên server
    const dataToSend = {
        id: userId
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/User/deleteUser`, {
    method: 'DELETE',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
    .then(data => {
        console.log(data.message)
        window.location.href = "http://localhost/Project/TEST_3/User/companyMember";
    })
    .catch(error => {
        console.error('Error:', error);
    });
}