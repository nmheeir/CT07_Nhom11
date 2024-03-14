<? class OrderModel extends BaseModel
{

    private $id;
    private $companyId;
    private $shipperId;
    private $description;
    private $latitude;
    private $longitude;
    private $address;
    private $isCompleted;
    private $createdAt;
    private $completedAt;
    private $deadline;

    const TABLE_NAME = "orders";

    public function __construct()
    {
        parent::__construct();
    }

    public static function createOrder($companyId, $shipperId, $description, $latitude, $longitude, $address, $isCompleted = 0, $createdAt = null, $completedAt = null, $deadline = null)
    {
        $order = new OrderModel;
        $order->companyId = $companyId;
        $order->shipperId = $shipperId;
        $order->description = $description;
        $order->latitude = $latitude;
        $order->longitude = $longitude;
        $order->address = $address;
        $order->isCompleted = $isCompleted;
        $order->createdAt = $createdAt;
        $order->completedAt = $completedAt;
        $order->deadline = $deadline;

        return $order;
    }

    public function getOrder($option = [
        'select' => '*',
        'order_by' => 'id asc'
    ])
    {
        $data = $this->get(self::TABLE_NAME, $option);
        if (count($data) > 0) {
            return new DataView(true, $data, "Ok");
        } else {
            return new DataView(false, [], "NO DATA");
        }
    }

    public function saveOrder(array $data)
    {
        // cập nhật completed_at
        if (isset($data["is_completed"])) {
            if ($data["is_completed"] == 1) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $data["completed_at"] = date('Y-m-d H:i:s', time());
            } else {
                $data["completed_at"] = NULL; // Gán giá trị NULL
            }
        }

        // chuyển dạng deadline
        $dateString = $data["deadline"];
        $timestamp = strtotime($dateString);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data["deadline"] = date('Y-m-d H:i:s', $timestamp);

        $this->save(self::TABLE_NAME, $data);
        return new DataView(true, $data, "Thêm/chỉnh sửa đơn hàng đã thực hiện thành công");
    }

    public function getUserOrders($isCompleted = 0, $shipperId = null, $page = 1, $created_at_timestamp, $deadline_timestamp) {
        try {
            $checkIsOutOfDate = "";
            if ($isCompleted == 0) {
                $checkIsOutOfDate = 'AND (deadline > CURRENT_TIMESTAMP OR deadline is NULL)';
            }
            if ($isCompleted == 2) {
                $checkIsOutOfDate = 'AND deadline < CURRENT_TIMESTAMP';
                $isCompleted = 0;
            }

            // kiểm tra lọc
            $filterCreatedAt = is_null($created_at_timestamp) ? "" : " AND created_at >= FROM_UNIXTIME(" . $created_at_timestamp . ")";
            $filterDeadline = is_null($deadline_timestamp) ? "" : " AND deadline >= FROM_UNIXTIME(" . $deadline_timestamp . ")";
            $orders = $this->get(self::TABLE_NAME,[
                'select' => '*',
                'order_by' => 'id asc',
                'where' => "shipper_id = {$shipperId} AND is_completed = {$isCompleted} {$checkIsOutOfDate}" . $filterCreatedAt . $filterDeadline,
                'limit' => 10,
                'offset' => ($page-1)  * 10
            ]);

            return new DataView(true, $orders, "OK");
        } catch (Exception $e) {
            return new DataView(false, null, "có lỗi ở getUserOrders");
        }
    }

    public function getCompanyOrders($isCompleted = 0, $page = 1, $created_at_timestamp, $deadline_timestamp) {
        try {
        // chọn loại order
        $checkIsOutOfDate = "";
        if($isCompleted == 0) {
            $checkIsOutOfDate = 'AND (deadline > CURRENT_TIMESTAMP OR deadline is NULL)';
        }
        if($isCompleted == 2) {
            $checkIsOutOfDate = 'AND deadline < CURRENT_TIMESTAMP';
            $isCompleted = 0;
        }

        // lọc order
        $filterCreatedAt = is_null($created_at_timestamp) ? "" : " AND created_at >= FROM_UNIXTIME(" . $created_at_timestamp . ")";
        $filterDeadline = is_null($deadline_timestamp) ? "" : " AND deadline >= FROM_UNIXTIME(" . $deadline_timestamp . ")";
        $orders = $this->get(self::TABLE_NAME ,[
            'select' => '*',
            'order_by' => 'id asc',
            'where' => "company_id = {$_SESSION['user']['company_id']} AND is_completed = {$isCompleted} {$checkIsOutOfDate}" . $filterCreatedAt . $filterDeadline,            
            'limit' => 10,
            'offset' => ($page-1) * 10
        ]);
        return new DataView(true, $orders, "OK");
        }
        catch (Exception $e){
            return new DataView(true, null, "có lỗi ở getCompanyOrder");
        }
    }
    public function countOrderByProcess($id)
    {
        $sql = "
        SELECT
            SUM(CASE WHEN is_completed = 1 AND shipper_id = {$id}  THEN 1 ELSE 0 END) AS is_completed,
            SUM(CASE WHEN is_completed = 0 AND (deadline >= NOW() OR deadline IS NULL) AND shipper_id = {$id} THEN 1 ELSE 0 END) AS is_processing,
            SUM(CASE WHEN is_completed = 0 AND deadline < NOW() AND shipper_id = {$id} THEN 1 ELSE 0 END) AS not_completed
        FROM
            orders;
        ";
        return $this->custom($sql);
    }

    public function countCompanyOrder($companyId, $isCompleted, $created_at_timestamp, $deadline_timestamp) {
        $checkIsOutOfDate = "";
        if ($isCompleted == 0) {
            $checkIsOutOfDate = 'AND (deadline > CURRENT_TIMESTAMP OR deadline is NULL)';
        }
        if ($isCompleted == 2) {
            $checkIsOutOfDate = 'AND deadline < CURRENT_TIMESTAMP';
            $isCompleted = 0;
        }

        // lọc order
        $filterCreatedAt = is_null($created_at_timestamp) ? "" : "AND created_at >= FROM_UNIXTIME(" . $created_at_timestamp . ")";
        $filterDeadline = is_null($deadline_timestamp) ? "" : "AND deadline >= FROM_UNIXTIME(" . $deadline_timestamp . ")";

        return $this->get(self::TABLE_NAME, [
            'select' => 'COUNT(*) AS total_orders',
            'where' => 'company_id = ' . $companyId . ' AND is_completed = ' . $isCompleted . ' ' . $checkIsOutOfDate . $filterCreatedAt . $filterDeadline
        ]);
    }

    public function countUserOrder($userId, $isCompleted, $created_at_timestamp, $deadline_timestamp) {
        $checkIsOutOfDate = "";
        if ($isCompleted == 0) {
            $checkIsOutOfDate = 'AND (deadline > CURRENT_TIMESTAMP OR deadline is NULL)';
        }
        if ($isCompleted == 2) {
            $checkIsOutOfDate = 'AND deadline < CURRENT_TIMESTAMP';
            $isCompleted = 0;
        }

        // kiêm tra lọc
        $filterCreatedAt = is_null($created_at_timestamp) ? "" : " AND created_at >= FROM_UNIXTIME(" . $created_at_timestamp . ")";
        $filterDeadline = is_null($deadline_timestamp) ? "" : " AND deadline >= FROM_UNIXTIME(" . $deadline_timestamp . ")";

        return $this->get(self::TABLE_NAME, [
            'select' => 'COUNT(*) AS total_orders',
            'where' => 'shipper_id = ' . $userId . ' AND is_completed = ' . $isCompleted . ' ' . $checkIsOutOfDate . $filterCreatedAt . $filterDeadline
        ]);
    }
}
