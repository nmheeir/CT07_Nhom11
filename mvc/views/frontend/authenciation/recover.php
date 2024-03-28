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
</head>
<style>
    .header:after {
        clear: both;
        content: '.';
        display: block;
        font-size: 0;
        height: 0;
        line-height: 0;
        visibility: hidden;
    }
</style>

<body>
    <div class="login-box">
        <h2>Hỗ trợ tài khoản</h2>
        <p>Nhập email đăng kí để chúng tôi tìm tài khoản của bạn. <br> Mật khẩu sẽ được gửi thông qua email đăng ký.</p>
        <form method="post">
            <div class="user-box">
                <input type="email" autocomplete="on" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="hidden" name="code" required>
            </div>
            <?
            if (empty($errorMessage)) {
                echo "<p>".$data['error']."</p>";
            }
            ?>

            <div class="d-flex justify-content-around align-items-center">
                <button type="submit" name="btnSubmit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Xác nhận
                </button>
                <a href="http://localhost/CT07_Nhom11/Authenciation/login" class="link-info">Đăng nhập</a>
            </div>
        </form>
    </div>
</body>
</html>