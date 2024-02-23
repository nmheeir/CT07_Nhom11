

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/base.css"/>
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
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
        <h2>Đăng kí</h2>
        <form method="post" action="http://localhost/Project/TEST_3/Authenciation/register">
            <div class="user-box">
                <input type="text" name="username" required oninput="validateUsername()" <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['username']}"?>>
                <label>Username</label>
                <div id="usernameError" class="error-message"></div>
            </div>
            <div class="user-box">
                <input type="text" name="fullname" required <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['fullname']}"?>>
                <label>Tên đầy đủ của bạn</label>
            </div>
            <div class="user-box">
                <input type="text" name="company_id" required <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['company_id']}"?>>
                <label>Nhập mã công ty của bạn</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required oninput="validatePassword()" <?if(isset($_SESSION["session_register"])) echo "value={$_SESSION['session_register']['password']}"?>>
                <label>Mật khẩu</label>
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required oninput="validateConfirmPassword()">
                <label>Nhập lại mật khẩu</label>
                <div id="confirmPasswordError" class="error-message"></div>
            </div>
            <?
                if(isset($_SESSION["error_register"])) {
                    echo "<div class='error-message'>{$_SESSION["error_register"]}</div>";
                    unset($_SESSION["error_register"]);   
                }   
            ?>
            <div class="d-flex justify-content-around align-items-center">
                <button type="submit" name="btnSubmit" onclick="return validateForm()">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                </button>
                <a href="http://localhost/Project/TEST_3/Authenciation/login" class="link-info">Đăng nhập</a>
            </div>
            <div class="d-flex justify-content-around align-items-center mt-2">
                <a href="http://localhost/Project/TEST_3/Authenciation/registerCompany" class="link-info">Đăng kí công ty của bạn</a>
            </div>
        </form>
    </div>
    <script src="../public/js/registerValidate.js"></script>
</body>
</html>