<div class="row p-2 equal">
  <div class="col-xl-4 col-md-6 mt-4">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h2><?php echo ($data['order']['is_processing']) ?></h2>
            <h5>Số đơn đang làm</h5>
            <a href="<?php echo "Order/userOrderList/0/{$data['shipper_id']}" ?>">Xem tất cả</a>
          </div>
          <div class="col-auto fs-2">
            <i class="bi bi-bag-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mt-4">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h2><?php echo ($data['order']['is_completed']) ?></h2>
            <h5>Số đơn đã làm</h5>
            <a href="<?php echo "Order/userOrderList/1/{$data['shipper_id']}" ?>">Xem tất cả</a>
          </div>
          <div class="col-auto fs-2">
            <i class="bi bi-bag-check-fill"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mt-4">
    <div class="card bg-transparent text-white border border-3 border-white">
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h2><?php echo ($data['order']['not_completed']) ?></h2>
            <h5>Các đơn không hoàn thành.</h5>
            <a href="<?php echo "Order/userOrderList/2/{$data['shipper_id']}" ?>">Xem tất cả</a>
          </div>
          <div class="col-auto fs-2">
            <i class="bi bi-bag-x-fill"></i></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>