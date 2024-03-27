<?
?>
<div class="container p-2">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="h3 text-center text-white pb-3">Các thành viên trong công ty của bạn</h2>

            <!-- tìm kiếm -->
            <form method="get" class="w-100 m-2 pe-2">
                <label for="username" class="d-block text-white bold">Tìm kiếm nhân viên</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Nhập username của nhân viên..." aria-label="Username" aria-describedby="basic-addon1" name="username">
                    <button class="btn btn-outline-secondary" type="submit" name="btnSubmit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <?
            foreach ($data['user'] as $user) {
                $style = '';
                switch ($user['role_id']) {
                    case 1:
                        $style = 'background-color: rgba(145, 10, 103, 0.4); color: #fff; border-radius: 10px;'; // Đỏ
                        break;
                    case 2:
                        $style = 'background-color: rgba(255, 208, 236, 0.4); color: #fff; border-radius: 10px;'; // Xanh lá cây
                        break;
                    case 3:
                        $style = 'background-color: rgba(71, 79, 122, 0.4); color: #fff; border-radius: 10px;'; // Xanh dương
                        break;
                    default:
                        break;
                }

                // Hiển thị thông tin user với style tương ứng
                echo "<div style='{$style}' class='d-flex align-items-center m-2 p-2'>";

                if (!empty($user['avatar'])) {
                    echo "<img src=\"../CT07_Nhom11/public/upload/avatars/{$user['username']}/{$user['avatar']}\" alt='...' class='rounded-circle' style='height: 60px; width: 60px'>";
                } else {
                    echo "<img src='../CT07_Nhom11/public/upload/Kiki.webp' alt='Default Avatar' class='rounded-circle' style='height: 60px; width: 60px;'>";
                }
            echo "
                    <div class='text' style='margin-left: 24px'>
                        <a href='User/detail/{$user['id']}' class='text-decoration-none link'>
                            <h3 class='h5'>{$user['fullname']}</h3>

                        </a>
                        <small>{$user['username']}</small>
                    </div>
                    </div>
                ";
            }
            ?>

            <?
                 $this->loadView("frontend.component.paging",
                 [
                     'page' => $data['page'],
                     'totalPage' => $data['totalPage'],
                     'url' => "http://localhost/Project/CT07_Nhom11/User/companyMember" 
                 ]
             );
            ?>
        </div>
    </div>
</div>