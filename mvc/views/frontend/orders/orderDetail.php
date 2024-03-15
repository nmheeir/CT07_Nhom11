<?php
   $latitude = $data['order']['latitude'];
   $longitude = $data['order']['longitude'];

   require_once "../TEST_3/mvc/views/frontend/orders/statusButton.php";
   $statusButton = StatusButton($data['order']);
?>

<div class="d-flex flex-column flex-md-row p-2">
    <!-- Phần trái (bản đồ) -->
    <div class="col-md-6 col-12 d-md-flex vh-100 ">
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
    
    <div class="col-md-6 col-12 text-white p-4 ps-3">
        <h2>Thông tin chi tiết</h2>
        <div class="">
            <strong>Latitude:</strong> 
            <br>
            <?php echo $latitude; ?>
        </div>
        <div>
            <strong>Longitude:</strong> 
            <br>
            <?php echo $longitude; ?>
        </div>
        <div>
            <strong>Thông tin về đơn hàng:</strong> 
            <br>
            <?php echo $data['order']['description']; ?>
        </div>
        <div>
            <strong>Địa chỉ đơn hàng:</strong> 
            <br>
            <?php echo $data['order']['address']; ?>
        </div>
        <div>
            <strong>Nhân viên giao hàng:</strong> 
            <br>
            <?php echo $data['order']['shipper_name']; ?>
        </div>
        <div>
            <strong>Hoàn thành trước:</strong> 
            <br>
            <?php if (isset($data['order']['deadline'])) {
                echo $data['order']['deadline'];
            } else {
                echo "Không có thời hạn";
            } ?>
        </div>

        <?php echo $statusButton; ?>
        <a class="btn btn-primary w-100 mt-1" href="Order/updateOrder/<?echo $data['order']['id']?>">Chỉnh sửa đơn hàng</a>
    </div>
</div>



<script src="../TEST_3/public/js/fetchUpdateOrder.js">
