<?
class UserController extends BaseController
{
    private $userModel;
    private $companyModel;
    private $roleModel;
    private $orderModel;
    private $mainUser;
    public function __construct()
    {
        $this->loadModel('UserModel');
        $this->loadModel('CompanyModel');
        $this->loadModel('RoleModel');
        $this->loadModel('OrderModel');
        $this->userModel = new UserModel;
        $this->companyModel = new CompanyModel;
        $this->roleModel = new RoleModel;
        $this->orderModel = new OrderModel;

        $this->mainUser = $this->userModel->getUser(
            [
                'where' => "id = " . $_SESSION['user']['id'] . ""
            ]
        )->data[0];
    }

    public function index() {
        header("Location: home");
    }

    public function home()
    {
        $id = $_SESSION["user"]["id"];
        $user = $this->userModel->getUser(
            [
                'where' => "id = '{$id}'"
            ]
        )->data[0];
        $user["role"] = $this->roleModel->getRoleName($user["role_id"])->data;
        $user["company"] = $this->companyModel->getCompanyInfo($user["company_id"])->data["company_name"];
        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['user' => $user, 'mainUser' => $user],
            'page' => 'users',
            'action' => "home",
        ]);
    }

    public function update()
    {
        $user = $this->userModel->getUser([
            'where' => "id = '{$_SESSION['user']['id']}'"
        ])->data;
        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['user' => $user, 'mainUser' => $user[0]],
            'page' => 'users',
            'action' => 'updateInformation'
        ]);
    }
    public function companyMember($page = 1)
    {
        // check role
        AuthenciationController::checkRoleIsManager();
        $userCount = 1;
            // Xử lí phần tìm kiếm
            if(isset($_GET['btnSubmit'])) {
                $usernameSearch = $_GET['username'];
                $allUser = $this->userModel->getUserByUsername($usernameSearch)->data->data;
            }
            else {
                $userCount = $this->userModel->countUserOfCompany($_SESSION['user']['company_id'])[0]['total_users'];
                $allUser = $this->userModel->getUser(
                    [
                        'where' => "company_id = '{$_SESSION['user']['company_id']}'",
                        'limit' => 10,
                        'offset' => $page - 1,
                        'order_by' => 'role_id asc'
                    ]
                )->data;
            }
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => ['user' => $allUser, 'mainUser' => $this->mainUser, 'totalPage' => ceil($userCount / 10), 'page' => $page],
                'page' => 'users',
                'action' => "companyMember",
            ]);
        
    }

    public function detail($id)
    {
        $user = $this->userModel->getUser(
            [
                'where' => "id = '{$id}'"
            ]
        );

        if (!$user->isSuccess) {
            $this->loadView("_404");
        } else {
            $user = $user->data[0];
            $user["role"] = $this->roleModel->getRoleName($user["role_id"])->data;
            $user["company"] = $this->companyModel->getCompanyInfo($user["company_id"])->data["company_name"];
            $orderCount = $this->orderModel->countOrderByProcess($id)[0];

            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => ['user' => $user, 'mainUser' => $this->mainUser, 'order' => $orderCount],
                'page' => 'users',
                'action' => "home",
            ]);
        }
    }
    

    public function activeControl() {
        AuthenciationController::checkRoleIsManager();
        $userUpdateData = json_decode(file_get_contents("php://input"), true);
        if ($userUpdateData !== null) {
            // Dữ liệu đã được nhận thành công
            $this->userModel->saveUser($userUpdateData);
        } else {
            // Đối với một số lý do nào đó, không thể giải mã JSON
            echo "Failed to decode JSON data";
        }
    }

    public function deleteUser() {
        AuthenciationController::checkRoleIsManager();
        $userData = json_decode(file_get_contents("php://input"), true);
        if ($userData !== null) {
            // Dữ liệu đã được nhận thành công
            $this->userModel->deleteUser($userData);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['message' => 'Không']);
        } else {
            // Đối với một số lý do nào đó, không thể giải mã JSON
            echo "Failed to decode JSON data";
        }
    }


    public function updateRole() {
        // if()
        AuthenciationController::checkRoleIsMaster();
        $userData = json_decode(file_get_contents("php://input"), true);
        if ($userData !== null) {
            // // Dữ liệu đã được nhận thành công
            $this->userModel->updateRole($userData["id"]);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['message' => 'đã cập nhật chức vụ nhân viên' ]);
        } else {
            // Đối với một số lý do nào đó, không thể giải mã JSON
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['message' => 'có lỗi']);
        }
    }

    public function updateUser() 
    {
        $userUpdateData = json_decode(file_get_contents("php://input"), true);
        if ($userUpdateData !== null) {
            // Dữ liệu đã được nhận thành công
            $this->userModel->saveUser($userUpdateData);
        } else {
            // Đối với một số lý do nào đó, không thể giải mã JSON
            echo "Failed to decode JSON data";
        }
    }
    public function sendComplainMail() {

        if (isset($_POST['btnSendComplainMail'])) {
            $type = $_POST['type'];
            $message = $_POST['complainMail'];
            sendComplainMail($type ,$message, $_SESSION['user']['username']);
        }

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['mainUser' => $this->mainUser],
            'page' => 'users',
            'action' => 'sendComplainMail'
        ]);
    }

    public function getMail() {
        AuthenciationController::checkRoleIsManager();

        $listMail = $this->userModel->get('complain', [
            'order_by' => 'complain_time desc'
        ]);

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['mainUser' => $this->mainUser, 'mail' => $listMail],
            'page' => 'users',
            'action' => "mail"
        ]);
    }
    function fetchMailByType($type) {
        $company_id = $_SESSION['user']['company_id'];
        if ($type == 0) {
            $list = $this->userModel->get('complain', [
                'where' => "company_id = $company_id"
            ]);
        }
        else {
            $list = $this->userModel->get('complain', [
                'where' => "type = $type AND company_id = $company_id"
            ]);
        }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($list);
    }
}