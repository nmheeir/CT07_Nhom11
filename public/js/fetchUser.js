function activeUpdate(userId, activeUpdate) {
  // Dữ liệu bạn muốn gửi lên server
  const dataToSend = {
    id: userId,
    active: activeUpdate,
  };
  // Sử dụng Fetch API để thực hiện PUT request
  fetch(`http://localhost/Project/TEST_3/User/activeControl`, {
    method: "PUT",
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
  fetch(`http://localhost/Project/TEST_3/User/deleteUser`, {
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
    .catch((error) => {
      console.error("Error:", error);
    });
}

function updateUser() {
  //xử lí tên file
  var avatarInput = document.getElementById("avatar");
  var selectedFile = avatarInput.files[0].name;
  var fileType = selectedFile.split(".").pop().toLowerCase();

  let dataToSend = {
    id: document.getElementById("id").value,
    fullname: document.getElementById("fullname").value,
    email: document.getElementById("email").value,
    phone: document.getElementById("phone").value,
    avatar: "avt" + "." + fileType,
    // avatar: "ok"
  };

  fetch(`http://localhost/Project/TEST_3/User/activeControl`, {
    method: "PUT",
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
