<?
    require_once "../TEST_3/mvc/views/frontend/orders/statusButton.php";
    $orders = $data["orders"];
    $state = $data['state'];
    if($state > 1) $borderType = "secondary-subtle";
    else if($state < 1) $borderType = "danger";
    else $borderType = "success";
?>
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
</style>
<!-- hiện order -->
<div style="min-height: 100vh;">
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

            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                   $statusButton = StatusButton($order);
                    echo "
                        <div class='card col-lg-3 col-md-5 text-bg-secondary border-{$borderType} m-2 p-0'>
                            <iframe 
                                class='card-img-top'
                                name='mapframe'
                                src='http://maps.google.com/maps?q={$order['latitude']},{$order['longitude']}&z=15&output=embed'>
                            </iframe>
                            <div class='card-body align-self-stretch' style='height: 150px'>
                                <h5 class='card-title title'>{$order['address']}</h5>
                                <p class='card-text des'>{$order['description']}</p>
                            </div>
                            <div class='card-body'>
                                <a href='Order/orderDetail/{$order['id']}' class='btn btn-primary w-100 mb-1' tabindex='-1' role='button' aria-disabled='true'>Chi tiết</a>
                                {$statusButton}
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "<p class='text-white text-center'>Bạn không có đơn hàng nào trong mục này.</p>";
            }
            ?>
        </div>

        <!-- Phân trang -->
        <div class="row justify-content-center g-2">
            <ul class="pagination flex-wrap justify-content-center">
                <?php
                    $totalPages = $data['totalPage']; // Số lượng trang
                    $currentPage = $data['page']; // Trang hiện tại
                    $visiblePages = 5; // Số lượng trang hiển thị
                    
                    $startPage = max($currentPage - floor($visiblePages / 2), 1);
                    $endPage = min($startPage + $visiblePages - 1, $totalPages);
                    
                    $current_url = "http://localhost/Project/TEST_3/Order/" . $data['action'] . '/' . $state;
                    
                    if (isset($data['shipperId'])) {
                        $current_url .= '/' . $data['shipperId'];
                    }
                    //Hiền thị nút preivious
                    if($totalPages > 1 && $currentPage > 1) {
                        echo '<li class="page-item"><a class="page-link" href="' . $current_url .'/'. ($currentPage - 1).'">Previous</a></li>';
                    }
                    // Hiển thị liên kết cho trang đầu tiên nếu không phải trang đầu tiên
                    if ($startPage > 2) {
                        echo '<li class="page-item"><a class="page-link" href="' . $current_url . '/1">1</a></li>';
                    }

                    // Hiển thị dấu '...' nếu có nhiều hơn một trang ở phía trước
                    if ($startPage > 3) {
                        echo '<li class="page-item"><span class="page-link">...</span></li>';
                    }

                    // Hiển thị các trang trong khoảng từ $startPage đến $endPage
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="' . $current_url . '/' . $i . '">' . $i . '</a></li>';
                    }

                    // Hiển thị dấu '...' nếu có nhiều hơn một trang ở phía sau
                    if ($endPage < $totalPages - 1) {
                        echo '<li class="page-item"><span class="page-link">...</span></li>';
                    }

                    // Hiển thị liên kết cho trang cuối cùng nếu không phải trang cuối cùng
                    if ($endPage < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="' . $current_url . '/' . $totalPages . '">' . $totalPages . '</a></li>';
                    }

                    // Hiển thị nút next
                    if($totalPages > 1 && $currentPage < $totalPages)  {
                        echo '<li class="page-item"><a class="page-link" href="' . $current_url .'/'. ($currentPage + 1).'">Next</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</div>


<script src="../TEST_3/public/js/fetchUpdateOrder.js"></script>




