<?
    require_once "../CT07_Nhom11/mvc/views/frontend/orders/statusButton.php";
    $orders = $data["orders"];
    $state = $data['state'];
    if($state > 1) $badge = ["type" => "danger", "text" => "Đã quá hạn"];
    else if($state < 1) $badge = ["type" => "warning", "text" => "Chưa hoàn thành"];
    else $badge = ["type" => "success", "text" => "Đã hoàn thành"];;
?>
<link rel='stylesheet' href="../CT07_Nhom11/public/css/dateInput.css" />
<style>
    .title {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .des {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    label {
        color: #fff;
    }
    input[type="date"]{
        padding: 0 4px;
    }
    .card{
        background-color: transparent;
    }

    .card-body {
        background-color: #24323e;
        color: #fff;
    }
</style>
<!-- hiện order -->
<div class="container" style="min-height: 100vh;">
    <div class="container-lg py-4">
        <div class="row justify-content-center g-2">
            <h3 class="text-white text-center">
                Các đơn hàng 
                <?
                    if($state == 0) echo "chưa hoàn thành";
                    else if($state == 1) echo "đã hoàn thành";
                    else echo "không hoàn thành";
                ?>
            </h3>

            <!-- lọc order -->
            <form method="get" class="d-lg-flex d-md-block align-items-center justify-content-center">
                <div class="user-box m-2">
                    <label class="fs-4">Ngày khởi tạo</label>
                    <input type="date" name="created_at" value=<? if(isset($_GET['created_at'])) echo $_GET['created_at']; ?>>
                </div>
                <div class="user-box m-2">
                    <label class="fs-4">Ngày hết hạn</label>
                    <input type="date" name="deadline" value=<? if(isset($_GET['deadline'])) echo $_GET['deadline']; ?>>
                </div>
                <button type="submit" name="btnSubmit" class="btn btn-info text-white m-2">Lọc đơn hàng</button>
            </form>
            <!-- các order -->
            <div class="row">
            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                   $statusButton = StatusButton($order);
                    echo "
                        <div class='card col-xl-3 col-lg-4 col-md-6 p-0'>
                            <div class='p-1'>
                                <iframe 
                                    class='card-img-top'
                                    name='mapframe'
                                    src='http://maps.google.com/maps?q={$order['latitude']},{$order['longitude']}&z=15&output=embed'>
                                </iframe>
                                <div class='card-body align-self-stretch' style='height: 150px'>
                                    <h5 class='card-title title'>{$order['address']}</h5>
                                    <span class='badge text-bg-" . $badge["type"] . "'>". $badge['text'] ."</span>
                                    <p class='card-text des'>{$order['description']}</p>
                                </div>
                                <div class='card-body'>
                                    <a href='Order/orderDetail/{$order['id']}' class='btn btn-primary w-100 mb-1' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
                                    {$statusButton}
                                </div>
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "<p class='text-white text-center'>Bạn không có đơn hàng nào trong mục này.</p>";
            }
            ?>
            </div>
        </div>
        <?
            $action = $_SESSION["user"]["role_id"] == 3 ? 'userOrderList' : 'companyOrderList';
            $this->loadView("frontend.component.paging",
                [
                    'page' => $data['page'],
                    'totalPage' => $data['totalPage'],
                    'url' => "http://localhost/CT07_Nhom11/Order/" . $action . "/" . $state
                ]
            );
        ?>
    </div>
</div>


<script src="../CT07_Nhom11/public/js/fetchUpdateOrder.js"></script>




