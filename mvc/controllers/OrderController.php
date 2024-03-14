<?
class OrderController extends BaseController
{
    private $orderModel;
    private $userModel;
    public function __construct()
    {
        $this->loadModel('OrderModel');
        $this->loadModel('UserModel');
        $this->orderModel = new OrderModel;
        $this->userModel = new UserModel;
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

    public function getOrder($option)
    {
        return $this->orderModel->getOrder($option);
    }

    public function orderDetail($id)
    {
        $orderDetail = $this->orderModel->getOrder([
            'where' => "id = {$id}"
        ])->data;
        if (!isset($orderDetail[0])) {
            $this->loadView("_404");
        } else {
            $orderDetail = $orderDetail[0];
            $shipperName = $this->userModel->getUser([
                'where' => "id = {$orderDetail['shipper_id']}"
            ])->data[0]['fullname'];

            $mainUser = $this->userModel->getUser([
                'where' => "id = '{$_SESSION['user']['id']}'"
            ])->data[0];

            $orderDetail["shipper_name"] = $shipperName;

            $data = [
                'order' => $orderDetail,
                'mainUser' => $mainUser
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
        
        // kiểm tra còn hạn
        $state = $isCompleted;

        $orders = $this->orderModel->getUserOrders($isCompleted, $shipperId, $page);
        if($orders->isSuccess) {
            $totalOrder = $this->orderModel->countUserOrder($_SESSION['user']['id'], $isCompleted)[0]['total_orders'];
            $mainUser = $this->userModel->getUser([
                'where' => "id = '{$_SESSION['user']['id']}'"
            ])->data[0];
            $data = [
                'orders' => $orders->data,
                'state' => $state,
                'action' => 'userOrderList',
                'shipperId' => $shipperId,
                'page' => $page,
                'totalPage' => ceil($totalOrder / 10),
                'mainUser' => $mainUser
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

        // kiểm tra còn hạn
        $state = $isCompleted;
        $orders = $this->orderModel->getCompanyOrders($isCompleted, $page);
        if($orders->isSuccess) {
            $totalOrder = $this->orderModel->countCompanyOrder($_SESSION['user']['company_id'], $isCompleted)[0]['total_orders'];
            $mainUser = $this->userModel->getUser([
                'where' => "id = '{$_SESSION['user']['id']}'"
            ])->data[0];
            $data = [
                'orders' => $orders->data,
                'state' => $state,
                'action' => 'companyOrderList',
                'page' => $page,
                'totalPage' => ceil($totalOrder / 10),
                'mainUser' => $mainUser
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

        $mainUser = $this->userModel->getUser(
            [
                'where' => "id = '{$_SESSION['user']['id']}'"
            ]
        )->data[0];
        $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
            'data' => ['shipperList' => $shipperList, 'mainUser' => $mainUser],
            'page' => 'orders',
            'action' => "addOrder",
        ]);
    }

    public function updateOrder($id)
    {
        // check role
        AuthenciationController::checkRoleIsManager();

        $shipperList = $this->userModel->getUser([
            'where' => "role_id = 3 AND company_id = 1",
            'select' => 'id, fullname'
        ])->data;
        $orderDetail = $this->orderModel->getOrder([
            'select' => "*",
            'where' => "id = {$id}"
        ]);
        $mainUser = $this->userModel->getUser([
            'where' => "id = '{$_SESSION['user']['id']}'"
        ])->data[0];

        if ($orderDetail->isSuccess) {
            $this->loadView("frontend.layout.{$_SESSION['user']['role_id']}layout", [
                'data' =>[  'shipperList' => $shipperList,
                            'orderId' => $id,
                            'orderDetail' => $orderDetail->data,
                            'mainUser' => $mainUser
                         ],
                'page' => 'orders',
                'action' => "addOrder",
            ]);
        } else {
            $this->loadView("_404.php");
        }
    }
}
