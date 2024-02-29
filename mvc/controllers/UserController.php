<?
require_once "../TEST_3/mvc/controllers/BaseController.php";
require_once "../TEST_3/mvc/controllers/AuthenciationController.php";
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
            'data'=> ['user' => $user],
            'page' => 'users',
            'action' => "home",
        ]);
    }

    public function companyMember() {
        // check role
        AuthenciationController::checkRole();
        $user = $this->userModel->getUser(
            [
                'where' => "company_id = '{$_SESSION['user']['company_id']}'",
            ]
        )->data;

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data'=> $user,
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

        if(!isset($user[0])) {
            $this->loadView("_404");
        }
        else {
            $user = $user[0];
            $user["role"] = $this->roleModel->getRoleName($user["role_id"])->data;
            $user["company"] = $this->companyModel->getCompanyInfo($user["company_id"])->data["company_name"];
            $orderCount = $this->orderModel->countOrder($id);
            
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data'=> ['user' => $user, 'order' => $orderCount],
                'page' => 'users',
                'action' => "home",
            ]);
        }
    }
    

    public function activeControl() {
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
}
