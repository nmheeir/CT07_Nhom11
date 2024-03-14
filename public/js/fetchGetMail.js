function fetchMailByType(type) {

  var selectedValue = type;

  var url =
    "http://localhost/Project/TEST_3/User/fetchMailByType/" +
    encodeURIComponent(selectedValue);

  // Sử dụng Fetch API để thực hiện GET request
  fetch(url, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Truy vấn thành công");
      // Xử lý dữ liệu trả về, có thể là hiển thị trong bảng
      displayData(data);
    })
    .catch((error) => {
      console.error("Error:", error);
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
      case "1":
        style = "table-primary";
        break;
      case "2":
        style = "table-secondary";
        break;
      case "3":
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

function getTypeName(type) {
  switch (type) {
    case "1":
      return "Website";
    case "2":
      return "Đơn hàng";
    case "3":
      return "Dịch vụ";
    default:
      return "Không xác định";
  }
}
