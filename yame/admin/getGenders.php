<?php
require_once("../DataProvider.php");

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    // Truy vấn lấy các giới tính tương ứng với loại sản phẩm đã chọn
    $sqlGender = "SELECT DISTINCT Gender FROM ProductType WHERE ProductTypeName = '$type'";
    $GenderResult = DataProvider::executeQuery($sqlGender);

    // Mảng chứa giới tính không trùng lặp
    $genders = array();

    // Lặp qua các giới tính trả về từ cơ sở dữ liệu
    while ($row = mysqli_fetch_array($GenderResult, MYSQLI_BOTH)) {
        $genderName = trim($row['Gender']);
        // Thêm giới tính vào mảng nếu chưa tồn tại
        if (!in_array($genderName, $genders)) {
            $genders[] = $genderName;
        }
    }

    // Trả về dữ liệu dưới dạng JSON
    echo json_encode($genders);
}
?>
