<?
$complainMail = $data['mail'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/Project/TEST_3/" />
    <script src="../TEST_3/public/js/fetchGetMail.js"></script>
</head>

<body>
    <h3 class="text-white text-center" style="margin: 50px 100px;">Mail</h3>

    <div class="m-3">
        <form method="post">
            <select class="form-select" name="type" id="selectType" onchange="fetchMailByType()">
                <option value="0" selected>Tất cả</option>
                <option value="1">Website</option>
                <option value="2">Đơn hàng</option>
                <option value="3">Dịch vụ</option>
            </select>
        </form>
        <div id="selectedValue" class="text-white"></div>
        <table class="table table-dark table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Loại</th>
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Thời gian</th>
                </tr>
            </thead>
            <tbody id="tBody">
        </table>
    </div>

</body>

</html>