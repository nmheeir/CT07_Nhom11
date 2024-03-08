<?
function convertToReadableString($inputString)
{
    // Chuyển đổi chuỗi thành mảng các từ
    $words = preg_split('/(?=[A-Z])/', $inputString, -1, PREG_SPLIT_NO_EMPTY);

    // Chuyển đổi từng từ thành chữ hoa ở đầu
    foreach ($words as &$word) {
        $word = ucfirst(strtolower($word)); // Chuyển chữ hoa thành chữ thường trước khi viết hoa chữ cái đầu tiên
    }

    // Kết hợp các từ thành chuỗi mới
    $outputString = implode(" ", $words);

    return $outputString;
}