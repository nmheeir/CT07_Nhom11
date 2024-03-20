<?php
   $latitude = $data['order']['latitude'];
   $longitude = $data['order']['longitude'];

   require_once "../TEST_3/mvc/views/frontend/orders/statusButton.php";
   $statusButton = StatusButton($data['order']);
?>
<link rel="stylesheet" href="../TEST_3/public/css/orderDetail.css">

<div class="d-flex flex-column flex-md-row h-100">
    <!-- Phần trái (bản đồ) -->
    <div class="col-md-6 col-12 d-md-flex">
    <iframe 
        name="mapframe" style="width: 100%; height:100%"
        src="https://www.google.com/maps?z=15&saddr=&output=embed&f=d&z=15&daddr=<?php echo "{$latitude},{$longitude}"; ?>">
    </iframe>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kiểm tra xem trình duyệt có hỗ trợ geolocation không
            if (navigator.geolocation) {
                // Gọi hàm getCurrentPosition để lấy thông tin vị trí hiện tại
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Lấy tọa độ latitude và longitude
                    const currentLatitude = position.coords.latitude;
                    const currentLongitude = position.coords.longitude;

                    // Đưa giá trị vào tham số saddr trong src iframe
                    const mapFrame = document.getElementsByName("mapframe")[0];
                    mapFrame.src = `https://www.google.com/maps?saddr=${currentLatitude},${currentLongitude}&output=embed&f=d&z=10&daddr=<?php echo "{$latitude},{$longitude}"; ?>`;
                }, function(error) {
                    console.error("Error getting geolocation:", error);
                });
            } else {
                console.error("Geolocation is not supported by this browser.");
            }
        });
    </script>
    </div>

    <!-- Phần phải (Thông tin chi tiết) -->
    
    <div class="col-md-6 col-12 text-white p-4 container">
        <h2>Thông tin chi tiết</h2>
        <div class="row">
            <div class="col p-2">
                <div class="border border-1 p-1 rounded my-bg">
                    <strong><i class="bi bi-geo"></i>Latitude:</strong> <br>
                    <p><?php echo $latitude; ?></p>
                </div>
            </div>
            <div class="col p-2">
                <div class="border border-1 p-1 rounded my-bg">
                    <strong><i class="bi bi-geo"></i>Longitude:</strong> <br>
                    <p><?php echo $longitude; ?></p>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col p-2">
                <div class="border border-1 rounded my-bg p-1">
                    <strong><i class="bi bi-info-circle-fill"></i>Thông tin về đơn hàng:</strong> 
                    <p><?php echo $data['order']['description']; ?></p>
                    <strong><i class="bi bi-globe-americas"></i>Địa chỉ đơn hàng:</strong> 
                    <p><?php echo $data['order']['address']; ?></p> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col p-2">
                <div class="border border-1 p-1 rounded my-bg">
                    <strong><i class="bi bi-calendar2-check"></i>Ngày khởi tạo:</strong> 
                    <br>
                    <?php echo $data['order']['created_at']; ?>
                </div>
            </div>
            <div class="col p-2">
                <div class="border border-1 p-1 rounded my-bg">
                    <strong><i class="bi bi-calendar-check-fill"></i>Hoàn thành trước:</strong> 
                    <br>
                    <?php if (isset($data['order']['deadline'])) {
                        echo $data['order']['deadline'];
                    } else {
                        echo "Không có thời hạn";
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col p-2">
                <div style='background-color: rgba(71, 79, 122, 0.4); color: #fff; border-radius: 10px;' class='d-flex align-items-center p-1 border border-1'>
                        <?
                        if (!empty($data['order']['avatar'])) {
                            echo "<img src=\"../TEST_3/public/upload/avatars/{$data['order']['username']}/{$data['order']['avatar']}\" alt='...' class='rounded-circle' style='height: 60px; width: 60px'>";
                        } else {
                            echo "<img src='../TEST_3/public/upload/Kiki.webp' alt='Default Avatar' class='rounded-circle' style='height: 60px; width: 60px;'>";
                        }
                        ?>
                        <div class='text' style='margin-left: 24px'>
                            <a href='/Project/TEST_3/User/detail/<?echo $data['order']['shipper_id']?>' class='text-decoration-none link'>
                                <h3 class='h5'><? echo $data["order"]["fullname"] ?></h3>
        
                            </a>
                            <small><? echo $data["order"]["username"] ?></small>
                        </div>
                </div>
            </div>
        </div>

        <?php echo $statusButton; ?>
        <?php
            if ($_SESSION["user"]["role_id"] < 3) {
                echo "<a class=\"btn btn-primary w-100 mt-1\" href=\"Order/updateOrder/{$data['order']['id']}\">Chỉnh sửa đơn hàng</a>";
            }
        ?>

    </div>
</div>



<script src="../TEST_3/public/js/fetchUpdateOrder.js">

