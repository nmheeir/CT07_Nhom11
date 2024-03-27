<?
$title = "Thêm đơn hàng";
if (isset($data['orderId']) && isset($data['orderDetail'])) {
    $title = "Cập nhật đơn hàng";
    $address = $data['orderDetail'][0]['address'];
    $des = $data['orderDetail'][0]['description'];
    $latitude = $data['orderDetail'][0]['latitude'];
    $longitude = $data['orderDetail'][0]['longitude'];
}
?>

<link rel='stylesheet' href="../CT07_Nhom11/public/css/addOrder.css" />
<link rel='stylesheet' href="../CT07_Nhom11/public/css/dateInput.css" />
<script src="../CT07_Nhom11/public/js/fetchUpdateOrder.js"></script>
<script src="../CT07_Nhom11/public/js/fetchAddOrder.js"></script>
<script src="../CT07_Nhom11/public/js/showToast.js"></script>
<script src="../CT07_Nhom11/public/js/clearInput.js"></script>
<script src="../CT07_Nhom11/public/js/showModal.js"></script>

    <div class="container p-2">
        <h3 class="text-white text-center">
            <? echo $title ?>
        </h3>
        <div class="mb-3 searchAddressContainer">
            <label for="searchAddress">Nhập Địa Chỉ:</label>
            <input type="text" id="searchAddress" placeholder="Nhập địa chỉ" name="address" autocomplete="off" required value="<?= isset($address) ? htmlspecialchars($address) : '' ?>">
            <ul id="searchResults"></ul>
            <input type="hidden" id="latitude" name="latitude" value="<?= isset($latitude) ? htmlspecialchars($latitude) : '' ?>">
            <input type="hidden" id="longitude" name="longitude" value="<?= isset($longitude) ? htmlspecialchars($longitude) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="shipper_id">Người giao hàng:</label>
            <select aria-label="Chọn người giao hàng" id="shipper_id" name="shipper_id">
                <option disabled selected hidden>Chọn nhân viên giao hàng</option>
                <?php
                foreach ($data['shipperList'] as $shipper) {
                    echo "<option value='{$shipper['id']}'>{$shipper['fullname']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3 ">
            <label for="deadline">Ngày phải hoàn thành:</label>
            <input type="date" id="deadline" name="deadline" />
        </div>
        <div class="mb-3">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?= isset($des) ? htmlspecialchars($des) : '' ?></textarea>
        </div>
        <input type="hidden" id="company_id" value="<?php echo isset($_SESSION['user']['company_id']) ? htmlspecialchars($_SESSION['user']['company_id']) : ''; ?>">
        <?php if (isset($data['orderId'])) : ?>
            <input type="hidden" id="orderId" value="<?= $data["orderId"] ?>">
        <?php endif; ?>

        <?
        if (!isset($data["orderId"])) {
            echo "<button class='btn btn-primary w-100' onclick='fetchAddOrder()'>Thêm đơn hàng</button>";
        } else {
            echo "<button class='btn btn-primary w-100' onclick=\"showModalWithCallBack('Bạn có muốn cập nhật đơn hàng?', updateOrder)\">Chỉnh sửa đơn hàng</button>";
        }
        ?>

    </div>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../CT07_Nhom11/public/js/fetchAddressAndCoordinate.js"></script>