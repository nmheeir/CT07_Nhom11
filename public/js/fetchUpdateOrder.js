function completedOrderUpdate(orderId, isCompleted) {
  // Dữ liệu bạn muốn gửi lên server
  const dataToSend = {
    id: orderId,
    is_completed: isCompleted == 0 ? 1 : 0,
  };
  // Sử dụng Fetch API để thực hiện PUT request
  fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  })
    .then(() => {
      location.reload();
    })
    .catch((error) => {
      console.error("Error:", error);
      // Xử lý lỗi (nếu cần)
    });
}

function updateOrder() {
  // Dữ liệu bạn muốn gửi lên server
  let dataToSend = {
    company_id: document.getElementById("company_id").value,
    shipper_id: document.getElementById("shipper_id").value,
    description: document.getElementById("description").value,
    latitude: document.getElementById("latitude").value,
    longitude: document.getElementById("longitude").value,
    address: document.getElementById("searchAddress").value,
    deadline: document.getElementById("deadline").value,
  };
  if (document.getElementById("orderId")) {
    dataToSend["id"] = document.getElementById("orderId").value;
  }
  console.log(dataToSend);
  // Sử dụng Fetch API để thực hiện PUT request
  fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  })
    .then((response) => response.json()) // Chuyển đổi phản hồi sang JSON
    .then((data) => {
      showToast(data.message);
    })
    .catch((error) => {
      showToast(
        "Có lỗi, hãy đảm bảo đã điền đủ thông tin và chọn địa chỉ ở phần gợi ý."
      );
    });
}
