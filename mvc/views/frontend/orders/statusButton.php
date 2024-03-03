<?
    function StatusButton($order) {
        $doneButton = "<button onclick='completedOrderUpdate({$order['id']}, {$order['is_completed']})' class='btn btn-info w-100' tabindex='-1' role='button' aria-disabled='true'>
                            <i class='bi bi-check-lg'></i>
                            Xong
                        </button>";
        $undoneButton = "";
        if($order["is_completed"] != 0) {
            $statusButton = $undoneButton;
        }
        else {
            $orderDeadline = strtotime($order['deadline']);
            $currentTime = time(); 
            if ($orderDeadline < $currentTime) {
                $statusButton = $undoneButton;
            } else {
                $statusButton = $doneButton;
            }
        }
        
        return $statusButton;
    }
?>
