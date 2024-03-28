<?
    function StatusButton($order) {
        $doneButton = "<button onclick='completedOrderUpdate({$order['id']}, {$order['is_completed']})' class='btn btn-info w-100' tabindex='-1' role='button' aria-disabled='true'>
                            <i class='bi bi-check-lg'></i>
                            Xong
                        </button>";
        $undoneButton = "";
        if($order["is_completed"] == 1) {
            $statusButton = $undoneButton;
        }
        else {
            $deadline_timestamp = strtotime($order['deadline']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            if (time() < $deadline_timestamp || $deadline_timestamp == null) {
                $statusButton = $doneButton;
            }
            else {
                $statusButton = $undoneButton;
            }
        }
        
        return $statusButton;
    }
?>
