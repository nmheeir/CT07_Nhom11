<?
class UserController extends BaseController
{
    private $userModel;
    private $companyModel;
    private $roleModel;

    private $orderModel;
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
    public function companyMember()
    {
        // check role
        AuthenciationController::checkRoleIsManager();
            // Xử lí phần tìm kiếm
            if(isset($_GET['btnSubmit'])) {
                $usernameSearch = $_GET['username'];
                $allUser = $this->userModel->getUserByUsername($usernameSearch)->data->data;
            }
            else {
                $allUser = $this->userModel->getUser(
                    [
                        'where' => "company_id = '{$_SESSION['user']['company_id']}'",
                        'order_by' => 'role_id asc'
                    ]
                )->data;
            }
    
            $mainId = $_SESSION['user']['id'];
            $mainUser = $this->userModel->getUser(
                [
                    'where' => "id = '{$mainId}'"
                ]
            )->data[0];
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => ['user' => $allUser, 'mainUser' => $mainUser],
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
        )->data;
        
        $mainUser = $this->userModel->getUser(
            [
                'where' => "id = '{$_SESSION['user']['id']}'"
            ]
        )->data[0];

        if (!isset($user[0])) {
            $this->loadView("_404");
        } else {
            $user = $user[0];
            $user["role"] = $this->roleModel->getRoleName($user["role_id"])->data;
            $user["company"] = $this->companyModel->getCompanyInfo($user["company_id"])->data["company_name"];
            $orderCount = $this->orderModel->countOrderByProcess($id)[0];

            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => ['user' => $user, 'mainUser' => $mainUser, 'order' => $orderCount],
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
        $mainUser = $this->userModel->getUser(
            [
                'where' => "id = '{$_SESSION['user']['id']}'"
            ]
        )->data[0];

        if (isset($_POST['btnSendComplainMail'])) {
            $type = $_POST['type'];
            $message = $_POST['complainMail'];
            sendComplainMail($type ,$message, $_SESSION['user']['username']);
        }

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['mainUser' => $mainUser],
            'page' => 'users',
            'action' => 'sendComplainMail'
        ]);
    }

    public function getMail() {
        AuthenciationController::checkRoleIsManager();

        $mainUser = $this->userModel->getUser(
            [
                'where' => "id = '{$_SESSION['user']['id']}'"
            ]
        )->data[0];

        $listMail = $this->userModel->get('complain', [
            'order_by' => 'complain_time desc'
        ]);

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['mainUser' => $mainUser, 'mail' => $listMail],
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