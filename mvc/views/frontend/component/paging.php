<!-- Phân trang -->
<div class="row justify-content-center g-2">
            <ul class="pagination flex-wrap justify-content-center">
                <?php
                    $queryString = strstr($_SERVER['REQUEST_URI'], '?');
                    $totalPages = $data['totalPage']; // Số lượng trang
                    $currentPage = $data['page']; // Trang hiện tại
                    $visiblePages = 5; // Số lượng trang hiển thị
                    
                    $startPage = max($currentPage - floor($visiblePages / 2), 1);
                    $endPage = min($startPage + $visiblePages - 1, $totalPages);
                    
                    $base_url = $data['url'];
                    //Hiền thị nút preivious
                    if($totalPages > 1 && $currentPage > 1) {
                        echo '<li class="page-item"><a class="page-link" href="' . $base_url .'/'. ($currentPage - 1). $queryString .'">Previous</a></li>';
                    }
                    // Hiển thị liên kết cho trang đầu tiên nếu không phải trang đầu tiên
                    if ($startPage > 2) {
                        echo '<li class="page-item"><a class="page-link" href="' . $base_url . $queryString . '/1">1</a></li>';
                    }

                    // Hiển thị dấu '...' nếu có nhiều hơn một trang ở phía trước
                    if ($startPage > 3) {
                        echo '<li class="page-item"><span class="page-link">...</span></li>';
                    }

                    // Hiển thị các trang trong khoảng từ $startPage đến $endPage
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="' . $base_url . '/' . $i . $queryString .'">' . $i . '</a></li>';
                    }

                    // Hiển thị dấu '...' nếu có nhiều hơn một trang ở phía sau
                    if ($endPage < $totalPages - 1) {
                        echo '<li class="page-item"><span class="page-link">...</span></li>';
                    }

                    // Hiển thị liên kết cho trang cuối cùng nếu không phải trang cuối cùng
                    if ($endPage < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="' . $base_url . '/' . $totalPages . $queryString .'">' . $totalPages . '</a></li>';
                    }

                    // Hiển thị nút next
                    if($totalPages > 1 && $currentPage < $totalPages)  {
                        echo '<li class="page-item"><a class="page-link" href="' . $base_url .'/'. ($currentPage + 1). $queryString . '">Next</a></li>';
                    }
                ?>
            </ul>
        </div>