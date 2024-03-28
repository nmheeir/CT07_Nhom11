<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="http://localhost/CT07_Nhom11/" />
    <link rel="stylesheet" href="../CT07_Nhom11/public/css/base.css" />
    <link rel="stylesheet" href="../CT07_Nhom11/public/css/login.css">
    <link rel="stylesheet" href="../CT07_Nhom11/vendor/bootstrap/css/bootstrap.css" />
    <style>
        /* Thêm CSS cho hiển thị thông báo lỗi */
        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Đăng nhập</h2>
        <form method="post" action="http://localhost/CT07_Nhom11/Authenciation/login">
            <div class="user-box">
                <input type="text" autocomplete="off" name="username" required <? if (isset($_SESSION["session_login"])) echo "value={$_SESSION['session_login']['username']}" ?>>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required <? if (isset($_SESSION["session_login"])) echo "value={$_SESSION['session_login']['password']}" ?>>
                <label>Mật khẩu</label>
            </div>

            <?
            if (isset($_SESSION["error_login"])) {
                echo "<div class='error-message'>{$_SESSION["error_login"]}</div>";
                unset($_SESSION["error_login"]);
            }
            ?>

            <div class="d-flex justify-content-around align-items-center">
                <button type="submit" name="btnSubmit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Đăng nhập
                </button>
                <a href="http://localhost/CT07_Nhom11/Authenciation/register" class="link-info">Đăng kí</a>
            </div>
            <div class="text-center mt-4">
                <a href="http://localhost/CT07_Nhom11/Authenciation/recoverAccount" class="link-info">Quên mật khẩu</a>
            </div>
        </form>
    </div>

    <script src="../CT07_Nhom11/bootstrap/js/bootstrap.js"></script>
    <script src="../CT07_Nhom11/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>