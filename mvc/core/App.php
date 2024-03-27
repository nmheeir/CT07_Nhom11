<?
class App {
    const BASE_SOURCE = 'CT07_Nhom11';
    private $controller = "Welcome";
    private $action = "index";
    private $params = [];
    public function __construct() {
        $arr = $this->processURL();
        // Kiểm tra đã đăng nhập chưa khi truy cập vào các contrlller
        if (!checkLogin() && $arr[0] != 'Welcome' && $arr[0] != 'Authenciation') { 
            header("Location: /CT07_Nhom11/Authenciation/login");
            exit;
        }
        // Controller
        if (file_exists("../CT07_Nhom11/mvc/controllers/" . $arr[0] . "Controller.php")) {
            $this->controller = $arr[0];
            unset($arr[0]);
        }
        else {
            include "../CT07_Nhom11/mvc/views/_404.php";
        }
        $controllerName = $this->controller . "Controller";
        $this->controller = new $controllerName;

        // Action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) {
                $this->action = $arr[1];
            }
            else {
                include "../CT07_Nhom11/mvc/views/_404.php";
                exit();
            }
            unset($arr[1]);
        }

        $this->params = $arr ? array_values($arr) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    private function processURL() {
        if (isset($_GET["url"])) {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
        else {
            return ["Welcome", "index"];
        }
    }
}