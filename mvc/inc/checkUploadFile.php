<?php

/*checkImageFile: upload ảnh vào trong máy
 * $fileName: tên của thẻ input file
 * $folder: nếu thêm ảnh của order -> "orders"
 *          thêm avatar của users -> "avatars"
 * $username: tên của đối tượng thêm ảnh 
 */
function checkImageFile($fileName, $folder, $username)
{
    $folderDir = "../CT07_Nhom11/public/upload/{$folder}/{$username}/";
    // makeDir($username, $folder);
    if (!file_exists($folderDir)) {
        mkdir($folderDir);
    }
    $imageFileType = strtolower(pathinfo($_FILES[$fileName]["name"], PATHINFO_EXTENSION));
    $fileUploadIntoServer = "avt." . $imageFileType;
    $target_file = $folderDir . $fileUploadIntoServer;

    $ds_file = glob($folderDir . 'avt*');

    if (!empty($_FILES[$fileName]["name"])) {
        foreach ($ds_file as $ten_file) {
            if (is_file($ten_file)) { // Kiểm tra nếu là file
                unlink($ten_file);
            }
        }
        move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file);
    }

}