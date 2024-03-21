<?
class OrderController extends BaseController
{
    private $orderModel;
    private $userModel;
    private $mainUser;
    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->loadModel('UserModel');
        $this->orderModel = new OrderModel;
        $this->userModel = new UserModel;

        $this->mainUser = $this->userModel->getUser([
            'where' => "id = '{$_SESSION['user']['id']}'"
        ])->data[0];
    }

    public function index() {
        if($_SESSION["user"]["role_id"] < 3) {
            header("Location: Order/companyOrderList");
            exit;
        }
        else {
            header("Location: Order/userOrderList");
            exit;
        }
    }

    public function save()
    {
        $newOrder = json_decode(file_get_contents("php://input"), true);
        if ($newOrder !== null) {
            // Dữ liệu đã được nhận thành công
            $result = $this->orderModel->saveOrder($newOrder);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['message' => $result->message]);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['message' => 'Không có dữ liệu']);
        }
    }


    public function orderDetail($id)
    {
        $orderDetail = $this->orderModel->getOrderDetail($id);
        if (!$orderDetail->isSuccess) {
            $this->loadView("_404");
        } else {       
            $orderDetail = $orderDetail->data[0];
            $data = [
                'order' => $orderDetail,
                'mainUser' => $this->mainUser
            ];

            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => $data,
                'page' => 'orders',
                'action' => "orderDetail",
            ]);
        }
    }

    public function userOrderList($isCompleted = 0, $shipperId = null, $page = 1) {
        if(!isset($shipperId) || $_SESSION["user"]["role_id"] >= 3) {
            $shipperId = $_SESSION["user"]["id"];
        }

        // kiểm tra bộ lọc
        $created_at_timestamp = null;
        $deadline_timestamp = null;
        if(isset($_GET['btnSubmit'])) {
            $created_at = $_GET['created_at'];
            $deadline = $_GET['deadline'];
            $created_at_timestamp = $created_at == "" ? null : strtotime($created_at);
            $deadline_timestamp = $deadline == "" ? null : strtotime($deadline);
        }

        // kiểm tra còn hạn
        $state = $isCompleted;

        $orders = $this->orderModel->getOrderListWithCondition($isCompleted, $shipperId, $page, $created_at_timestamp, $deadline_timestamp);
        if($orders->isSuccess) {
            $totalOrder = $this->orderModel->countOrderWithCondition($_SESSION['user']['company_id'], $shipperId, $isCompleted, $created_at_timestamp, $deadline_timestamp)[0]['total_orders'];
            $data = [
                'orders' => $orders->data,
                'state' => $state,
                'action' => 'userOrderList',
                'shipperId' => $shipperId,
                'page' => $page,
                'totalPage' => ceil($totalOrder / 10),
                'mainUser' => $this->mainUser
            ];
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => $data,
                'page' => 'orders',
                'action' => "orderList",
            ]);
        } else {
            $this->loadView("_404");
        }
    }

    public function companyOrderList($isCompleted = 0, $page = 1)
    {
        // check role
        AuthenciationController::checkRoleIsManager();
        
        // kiểm tra bộ lọc
        $created_at_timestamp = null;
        $deadline_timestamp = null;
        if(isset($_GET['btnSubmit'])) {
            $created_at = $_GET['created_at'];
            $deadline = $_GET['deadline'];
            $created_at_timestamp = $created_at == "" ? null : strtotime($created_at);
            $deadline_timestamp = $deadline == "" ? null : strtotime($deadline);
        }
        
        // kiểm tra còn hạn
        $state = $isCompleted;
        $orders = $this->orderModel->getOrderListWithCondition($isCompleted, null , $page, $created_at_timestamp, $deadline_timestamp);
        if($orders->isSuccess) {
            $totalOrder = $this->orderModel->countOrderWithCondition($_SESSION['user']['company_id'], null,$isCompleted, $created_at_timestamp, $deadline_timestamp)[0]['total_orders'];
            $data = [
                'orders' => $orders->data,
                'state' => $state,
                'action' => 'companyOrderList',
                'page' => $page,
                'totalPage' => ceil($totalOrder / 10),
                'mainUser' => $this->mainUser
            ];
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' => $data,
                'page' => 'orders',
                'action' => "orderList",
            ]);
        } else {
            $this->loadView('_404');
        }
    }

    public function addOrder()
    {
        // check role
        AuthenciationController::checkRoleIsManager();

        $shipperList = $this->userModel->getUser([
            'where' => "role_id = 3 AND company_id = 1",
            'select' => 'id, fullname'
        ])->data;

        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['shipperList' => $shipperList, 'mainUser' => $this->mainUser],
            'page' => 'orders',
            'action' => "addOrder",
        ]);
    }

    public function updateOrder($id)
    {
        // check role
        AuthenciationController::checkRoleIsManager();

        $shipperList = $this->userModel->getUser([
            'where' => "role_id = 3 AND company_id = " . $_SESSION["user"]["company_id"] . "",
            'select' => 'id, fullname'
        ])->data;
        $orderDetail = $this->orderModel->getOrderDetail($id);

        if ($orderDetail->isSuccess) {
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' =>[  
                    'shipperList' => $shipperList,
                    'orderId' => $id,
                    'orderDetail' => $orderDetail->data,
                    'mainUser' => $this->mainUser
                ],
                'page' => 'orders',
                'action' => "addOrder",
            ]);
        } else {
            $this->loadView("_404.php");
        }
    }
}
