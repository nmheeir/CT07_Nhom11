<?
$data = $data['user'][0];
if (isset($data)) {
    $phone = $data['phone'];
    $email = $data['email'];
    $fullname = $data['fullname'];
    $avatar = $data['avatar'];
    $company = $data['company_id'];
    $id = $data['id'];
    $username = $data['username'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .container {
            color: white;
            text-align: center;
            margin: 200px auto;
        }

        form {
            display: inline-block;
        }

        label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button[name='submit'] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[name='submit']:hover {
            background-color: #45a049;
        }
    </style>
    <script src="../TEST_3/public/js/fetchUser.js"></script>
</head>

<body>
    <div class="container" style="color: white">
        <h3 class="text-white text-center">
            Chỉnh sửa thông tin
        </h3>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" id="id" value="<? echo $id ?>">
            <label for="fullname">Họ và tên:</label>
            <input type="text" id="fullname" name="fullname" value="<? echo $fullname ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<? echo $email ?>" required>

            <label for="number">Điện thoại di động:</label>
            <input type="text" id="phone" name="phone" value="<? if (isset($phone)) echo $phone ?>">
            <label for="avatar">Avatar</label>
            <input type="file" id="avatar" name="avatar">

            <button name='submit' onclick="updateUser(); return false">Submit</button>
        </form>
    </div>
</body>

</html>

<?
if (isset($_POST['submit'])) {
    checkImageFile("avatar", "avatars", $username);
}
?>