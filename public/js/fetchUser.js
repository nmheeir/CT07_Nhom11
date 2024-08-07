function activeUpdate(userId, activeUpdate) {

    console.log("cập nhật active")
    const dataToSend = {
        id: userId,
        active: activeUpdate
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/CT07_Nhom11/User/activeControl`, {
    method: 'PUT',
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  }).then(() => {
    location.reload();
  });
  console.log("Oke").catch((error) => {
    console.error("Error:", error);
    // Xử lý lỗi (nếu cần)
  });
}

function deleteUser(userId) {
  // Dữ liệu bạn muốn gửi lên server
  const dataToSend = {
    id: userId,
  };
  // Sử dụng Fetch API để thực hiện PUT request
  fetch(`http://localhost/CT07_Nhom11/User/deleteUser`, {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  })
    .then((response) => response.json()) // Chuyển đổi phản hồi sang JSON
    .then((data) => {
      console.log(data.message);
    })
    .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
    .then(data => {
        console.log(data.message)
        window.location.href = "http://localhost/CT07_Nhom11/User/companyMember";
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateRole(userId) {
    console.log(userId);
    const dataToSend = {
        id: userId
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/CT07_Nhom11/User/updateRole`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(response => response.json()) // Chuyển đổi phản hồi sang JSON
    .then(data => {
        console.log(data.message)
        showModalWithoutCallBack("Đã thay đổi chức vụ thành công")
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateUser(event) {
  event.preventDefault();
  //xử lí tên file
  var avatarInput = document.getElementById("avatar");
  if (avatarInput.files.length > 0) {
    var selectedFile = avatarInput.files[0].name;
    var fileType = selectedFile.split(".").pop().toLowerCase();
  }

  let dataToSend = {
    id: document.getElementById("id").value,
    fullname: document.getElementById("fullname").value,
    email: document.getElementById("email").value,
    phone: document.getElementById("phone").value.length > 0 ? document.getElementById("phone").value : null,
    avatar: avatarInput.files.length > 0 ? "avt" + "." + fileType : null,
  };

  fetch(`http://localhost/CT07_Nhom11/User/updateUser`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  }).then(() => {
    window.location.reload(true);
  });
  console.log("Oke").catch((error) => {
    console.error("Error:", error);
    // Xử lý lỗi (nếu cần)
  });
}