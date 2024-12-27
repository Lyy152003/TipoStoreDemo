<?php
require_once("../DataProvider.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productTypeName'])) {
    $productTypeName = $_POST['productTypeName'];

    // Truy vấn để lấy danh sách giới tính theo loại sản phẩm
    $sql = "SELECT DISTINCT Gender FROM ProductType WHERE ProductTypeName = '$productTypeName'";
    $result = DataProvider::executeQuery($sql);

    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $gender = $row['Gender'];
        $options .= "<option value='$gender'>$gender</option>";
    }

    echo $options; // Trả về danh sách các giới tính
}
?>
