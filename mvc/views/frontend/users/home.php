


<script src = "../CT07_Nhom11/public/js/fetchUser.js"></script>
<script src = "../CT07_Nhom11/public/js/showModal.js"></script>
<?
  $buttons = "";
  $user = $data['user'];
  $editAvatar = "";
  if ($_SESSION['user']['role_id'] < $user['role_id']) {
    if($user['active'] == 1) {
      $activeControllerButton = "<button type='button' class='btn btn-secondary w-25 m-1' onclick=\"showModalWithCallBack('Bạn có chắc muốn chặn nhân viên?', activeUpdate, {$user['id']}, 0)\">Chặn</button>";
    }
    else {
      $activeControllerButton = "<button type='button' class='btn btn-secondary w-25 m-1' onclick=\"showModalWithCallBack('Bạn có chắc muốn bỏ chặn nhân viên?', activeUpdate, {$user['id']}, 1)\">Bỏ chặn</button>";
    }
    $buttons = "
      <a type='button' class='btn btn-secondary w-25 m-1' onclick=\"showModalWithCallBack('Bạn có chắc muốn sa thải nhân viên?', deleteUser, {$user['id']})\">Sa thải</a>
      {$activeControllerButton}
    ";
} else if ($_SESSION['user']['id'] == $user['id']) {
    $buttons = "<a type='button' class='btn btn-secondary w-50' href='Authenciation/logout'>Sign out</a>";
}
?>


<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="text-center">
                        <?
                        if (!empty($user['avatar'])) {
                            echo "<img src=\"../CT07_Nhom11/public/upload/avatars/{$user['username']}/{$user['avatar']}\" alt='...' style='width: 150px; height: 210px; object-fit: cover;' class='rounded-circle img-fluid'>";
                        } else {
                            echo "<img src='../CT07_Nhom11/public/upload/Kiki.webp' alt='Default Avatar' style='width: 150px; height: 210px' class='rounded-circle img-fluid'>";
                        }
                        ?>
                                    
                    <h5 class="mt-3 text-white"><? echo $user["fullname"] ?></h5>
                    <p class="text-white mb-3">@<? echo $user["username"] ?></p>
                    <div class="row justify-content-center">
                        <? echo $editAvatar ?>
                    </div>
                    <div class="row justify-content-center">
                        <? echo $buttons ?>
                    </div>
                              <?
                    if($_SESSION['user']['role_id'] == 1 && $_SESSION['user']['role_id'] <  $user['role_id']) {
                        echo "<button type='button' class='btn btn-secondary w-50 m-1' onclick=\"showModalWithCallBack('Bạn có chắc muốn sa thải nhân viên?', updateRole, {$user['id']})\">Thay đổi chức vụ</button>";
                      }
                    ?>
                </div>
            </div>
            <div class="col-lg-8 text-white">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Tên đầy đủ</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-white mb-0"><? echo $user["fullname"] ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-white mb-0"><? echo $user["email"] ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Chức vụ</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-white mb-0"><? echo $user["role"] ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Số điện thoại</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-white mb-0">
                            <?
                                if (isset($user['phone'])) {
                                    echo $user['phone'];
                                } else {
                                    echo "Không có";
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Công ty</p>
                    </div>
                    <div class="col-sm-9 d-flex">
                        <p class="text-white mb-0"><? echo $user["company"] ?></p>
                        <?php
                            if ($_SESSION['user']['role_id'] < 3) {
                                echo "<button class='ms-auto btn btn-primary' onclick='showModalWithoutCallBack(\"Mã công ty của bạn là " . $_SESSION['user']['company_id'] . "\")'>Lấy mã công ty</button>";
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?
if (isset($data['order'])) {
    $this->loadView("frontend.users.process", [
        'data' => ['order' => $data['order'], 'shipper_id' => $user['id']]
    ]);
}
?>