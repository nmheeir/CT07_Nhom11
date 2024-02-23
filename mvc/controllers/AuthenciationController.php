<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
require_once '../TEST_3/mvc/inc/send_mail.php';

class AuthenciationController extends BaseController
{
    private $userModel;
    private $companyModel;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->loadModel("CompanyModel");
        $this->userModel = new UserModel;
        $this->companyModel = new CompanyModel;
    }

    public function login()
    {
        $this->loadView('frontend.authenciation.login');
        if (isset($_POST['btnSubmit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // lưu dữ liệu khi error
            $sessionLogin = [
                "username" => $username,
                "password" => $password
            ];
            $_SESSION["session_login"] = $sessionLogin;
            // kiểm tra login
            $data = $this->userModel->login($username, $password);
            if ($data->isSuccess) {
                // thiết lập session
                $sessionUserInfo = [
                    "id" => $data->data["id"],
                    "username" =>  $data->data["username"],
                    "role_id" => $data->data["role_id"],
                    "company_id" => $data->data["company_id"]
                ];
                $_SESSION["user"] = $sessionUserInfo;
                // thiết lập cookie
                $cookie_user_id = $data->data["id"];
                setcookie("user_id", $cookie_user_id, time() + (86400 * 30), "/");
                // redirect
                header("Location: http://localhost/Project/TEST_3/User/home");
                exit;
            } else {
                $_SESSION["error_login"] = $data->message;
                header("Location: login");
                exit;
            }
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['user_id'])) {
            unset($_COOKIE['user_id']);
            setcookie('user_id', '', -1, '/');
        }
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
        }
        header("Location: login");
    }

    public function register()
    {
        if (isset($_POST['btnSubmit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $company_id = $_POST['company_id'];
            $email = $_POST['email'];
            // lưu dữ liệu khi error
            $sessionRegister = [
                "username" => $username,
                "password" => $password,
                "fullname" => $fullname,
                "company_id" => $company_id,
                'email' => $email
            ];
            $_SESSION["session_register_user"] = $sessionRegister;
            // Kiểm tra rỗng
            if (empty($username) || empty($password) || empty($fullname) || empty($company_id) || empty($email)) {
                $_SESSION["error_register"] = "Hãy điền đầy đủ thông tin";
            } else {
                //Kiểm tra công ty có tồn tại hay không
                $checkCompanyExist = $this->companyModel->getCompanyInfo($company_id);
                if (!$checkCompanyExist->isSuccess) {
                    $_SESSION["error_register"] = $checkCompanyExist->message;
                } else {
                    //kiểm tra username
                    $checkRegisterUsername =  $this->userModel->getUserByUsername($username);
                    //kiểm tra email
                    //thiếu

                    // Kiểm tra kết quả đăng ký
                    if (!$checkRegisterUsername->isSuccess) {
                        $mail = $_SESSION['session_register_user']['email'];

                        sendVerifyCode($mail);

                        header("Location: verifyemail/user");
                        unset($_SESSION["error_register"]);
                        exit;
                    } else {
                        if (!$checkRegisterUsername->isSuccess) {
                            $_SESSION["error_register"] = $checkRegisterUsername->message;
                        }
                    }
                }
            }
        }
        $this->loadView('frontend.authenciation.register');
    }

    public function registerCompany()
    {
        if (isset($_POST["btnSubmit"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $company_name = $_POST['company_name'];
            $email = $_POST['email'];
            // lưu dữ liệu khi error
            $sessionRegister = [
                "username" => $username,
                "password" => $password,
                "fullname" => $fullname,
                "company_name" => $company_name,
                "email" => $email
            ];
            $_SESSION["session_register_company"] = $sessionRegister;
            // Kiểm tra rỗng
            if (empty($username) || empty($password) || empty($fullname) || empty($company_name) || empty($email)) {
                $_SESSION["error_registerCompany"] = "Hãy điền đầy đủ thông tin";
            } else {
                // Sử dụng hàm registerUser từ class User để đăng ký người dùng mới
                $checkUsernameExist =  $this->userModel->getUserByUsername($username);
                if ($checkUsernameExist->isSuccess) {
                    $_SESSION["error_registerCompany"] = $checkUsernameExist->message;
                }
                else {
                    // Kiểm tra kết quả đăng kí công ty
                    $checkCompanyExist = $this->companyModel->getCompanyName($company_name);
                    if ($checkCompanyExist->isSuccess) {
                        $mail = $_SESSION['session_register_company']['email'];
                        //chuyển sang trang verify email
                        sendVerifyCode($mail);
                        header("Location: verifyemail/company");
                        
                    } else {
                        $_SESSION["error_registerCompany"] = $checkCompanyExist->message;
                    }
                }
            }
        }
        $this->loadView('frontend.authenciation.companyRegister');
    }

    public function verifyEmail($userOrCompany)
    {
        if (isset($_POST['btnVerify'])) {
            $verifyCode = $_POST['verifyCode'];

            $session_register = 'session_register_' . $userOrCompany;
            //lấy code trong bảng verify dựa vào email
            $checkCode = $this->userModel->get('verify', [
                'select' => '*',
                'where' => "code = '{$verifyCode}' AND email = '{$_SESSION[$session_register]['email']}'",
                'limit' => '1'
            ]);
            if (!empty($checkCode)) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $time = strtotime(date('Y-m-d H:i:s'));
                $expiresTime = strtotime($checkCode[0]['expires']);
                if ($verifyCode == $checkCode[0]['code'] && $time < $expiresTime) {

                    $username = $_SESSION[$session_register]['username'];
                    $password = $_SESSION[$session_register]['password'];
                    $email = $_SESSION[$session_register]['email'];
                    $fullname = $_SESSION[$session_register]['fullname'];

                    if ($userOrCompany == "user") {
                        $company_id = $_SESSION[$session_register]['company_id'];
                        $this->userModel->registerUser($username, $password, $fullname, $company_id, $email);
                        // unset($_SESSION['session_register']);
                    }
                    else if ($userOrCompany == "company") {
                        $company_name = $_SESSION[$session_register]['company_name'];
                        $checkCompanyExist = $this->companyModel->registerCompany($company_name);
                        $masterUserId = $this->userModel->registerUser($username, $password, $fullname, $checkCompanyExist->data, $email, 1);
                        $this->companyModel->save("company", [
                            "id" => $checkCompanyExist->data,
                            "master_user_id" => $masterUserId->data
                        ]);
                        // dẫn qua login
                        unset($_SESSION["error_registerCompany"]);  
                    }
                    header("Location: http://localhost/Project/TEST_3/Authenciation/login");
                    exit;
                } else if ($time > $expiresTime) {
                    echo "Mã quá hạn, vui lòng thử lại mã khác";
                }
            } else {
                echo "Sai mã xác thực, vui lòng nhập lại";
            }
        }
        $this->loadView('frontend.authenciation.verifyemail');
    }
}
