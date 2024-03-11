function fetchMailByType() {
  var selectedValue = document.getElementById("selectType").value;
  // Dữ liệu bạn muốn gửi lên server
  const dataToSend = {
    type: selectedValue,
  };

  // Sử dụng Fetch API để thực hiện POST request
  fetch("http://localhost/Project/TEST_3/User/fetchMailByType", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(dataToSend),
  })
    .then((response) => response.json())
    .then((data) => {
      // Xử lý dữ liệu trả về, có thể là hiển thị trong bảng
      displayData(data);
    })
    .catch((error, data) => {
      console.error("Error:", error);
      console.log(data);
      // Xử lý lỗi (nếu cần)
    });
}

function displayData(data) {
  // Xóa các dòng dữ liệu cũ trong bảng
  const tableBody = document.querySelector("tBody");
  tableBody.innerHTML = "";

  // Duyệt qua dữ liệu và thêm vào bảng
  data.forEach((mail) => {
    let style = "";
    switch (mail.type) {
      case 1:
        style = "table-primary";
        break;
      case 2:
        style = "table-secondary";
        break;
      case 3:
        style = "table-warning";
        break;
      default:
        style = "";
    }

    // Tạo một dòng mới cho mỗi mục dữ liệu
    const row = `
            <tr class="${style}">
                <td>${getTypeName(mail.type)}</td>
                <td>${mail.username}</td>
                <td>${mail.content}</td>
                <td>${mail.complain_time}</td>
            </tr>
        `;
    // Thêm dòng vào tbody của bảng
    tableBody.innerHTML += row;
  });
}
