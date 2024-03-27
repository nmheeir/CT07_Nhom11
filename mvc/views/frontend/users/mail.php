<?
$complainMail = $data['mail'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/Project/CT07_Nhom11/" />
    <script src="../CT07_Nhom11/public/js/fetchGetMail.js"></script>
</head>

<body>
    <h3 class="text-white text-center" style="margin: 50px 100px;">Mail</h3>

    <div class="m-3 xl">
        <form method="post">
            <select class="form-select mb-5" value="0" name="type" id="selectType" style="width: auto" onchange="fetchMailByType(this.value)">
                <option disabled selected hidden>Lựa chọn</option>
                <option value="0">Tất cả</option>
                <option value="1">Website</option>
                <option value="2">Đơn hàng</option>
                <option value="3">Dịch vụ</option>
            </select>
        </form>
        <div id="selectedValue" class="text-white"></div>
        <table class="table table-dark table-hover table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Loại</th>
                    <th scope="col">Tên người gửi</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody id="tBody">
        </table>
    </div>

</body>

</html>