<?php
session_start();
include('php/sessionStart.php');
require_once('DataProvider.php');

// Check if invoiceID is provided in the URL
if (isset($_GET['invoiceID'])) {
    $invoiceID = $_GET['invoiceID'];

    // Query for invoice details
    $sqlInvoice = "SELECT * FROM invoice WHERE InvoiceID = '$invoiceID'";
    $resultInvoice = DataProvider::executeQuery($sqlInvoice);

    // Check if the invoice exists
    if ($resultInvoice !== false && mysqli_num_rows($resultInvoice) > 0) {
        $invoiceData = mysqli_fetch_assoc($resultInvoice);

        // Get additional details
        $usrname = $invoiceData['UsrName'];
        $phone = $invoiceData['PhoneNo'];
        $address = $invoiceData['Address'];
        $email = $invoiceData['Email'];
        $invoiceDate = $invoiceData['DateInvoice'];
        $totalAmount = $invoiceData['Total'];

        // Query for the items related to this invoice
        $sqlItems = "SELECT * FROM invoicedetails WHERE InvoiceID = '$invoiceID'";
        $resultItems = DataProvider::executeQuery($sqlItems);

        // Check if the query for invoice items was successful
        if ($resultItems === false) {
            echo "<p>Không thể truy xuất thông tin sản phẩm trong hóa đơn này.</p>";
            exit;
        }
    } else {
        echo "<p>Không tìm thấy hóa đơn này.</p>";
        exit;
    }
} else {
    echo "<p>Không tìm thấy hóa đơn này.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TIPO STORE - Chi tiết hóa đơn</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded|Encode+Sans+Semi+Condensed" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stylesheets -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/bonus.css" />


</head>

<body>
    <?php include('php/header.php'); ?>

    <!-- NAVIGATION -->
    <div id="navigation">
        <div class="container">
            <div id="responsive-nav">
                <div class="category-nav show-on-click">
                    <?php include('php/category-nav.php'); ?>
                </div>
                <?php include('php/menu-nav.php'); ?>
            </div>
        </div>
    </div>
    <!-- /NAVIGATION -->

    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="check-invoice-user.php">Tài khoản</a></li>
                <li class="active">Chi tiết hóa đơn</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- INVOICE DETAILS -->
    <div class="section">
        <div class="container user">
            <div class="row">
                <div class="section-title">
						<h2 class="title">Chi tiết hóa đơn </h2>
				</div>

                <p><strong>Ngày mua hàng: </strong><?php echo date("d/m/Y H:i:s", strtotime($invoiceDate)); ?></p>
                <p><strong>Người nhận hàng: </strong><?php echo $usrname; ?></p>
                <p><strong>Số điện thoại người nhận: </strong><?php echo $phone; ?></p>
                <p><strong>Địa chỉ giao hàng: </strong><?php echo $address; ?></p>
                <p><strong>Tổng tiền: </strong><?php echo number_format($totalAmount, 0, ',', '.') . " VNĐ"; ?></p>

                <h4>Danh sách sản phẩm trong hóa đơn:</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Kiểm tra nếu 'invoiceID' tồn tại trong mảng $_GET
                        if (isset($_GET['invoiceID']) && !empty($_GET['invoiceID'])) {
                            $invoiceID = $_GET['invoiceID'];

                            // SQL query with INNER JOIN to get product details and invoice details at once
                            $sql = "SELECT 
                                        InvoiceDetails.ProductID, 
                                        InvoiceDetails.Quantities, 
                                        InvoiceDetails.Price, 
                                        InvoiceDetails.SubTotal, 
                                        Product.ProductName, 
                                        Product.imgsrc
                                    FROM InvoiceDetails 
                                    INNER JOIN Product ON InvoiceDetails.ProductID = Product.ProductID 
                                    WHERE InvoiceDetails.InvoiceID = '$invoiceID'";

                            // Execute the query
                            $rs = DataProvider::executeQuery($sql);

                            // Check if any items exist in the invoice
                            if (mysqli_num_rows($rs) > 0) {
                                // Loop through each item in the invoice
                                while ($row = mysqli_fetch_assoc($rs)) {
                                    $productName = $row['ProductName'];
                                    $quantity = $row['Quantities'];

                                    // Display the details in the table
                                    echo "<tr>
                                            <td>$productName</td>
                                            <td>$quantity</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Không có sản phẩm nào trong hóa đơn này.</td></tr>";
                            }
                        } else {
                            // Nếu không có 'InvoiceID' trong $_GET, thông báo lỗi hoặc chuyển hướng đến trang khác
                            echo "<p>Lỗi: Không có mã hóa đơn.</p>";
                        }
                        ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- /INVOICE DETAILS -->

    <!-- FOOTER -->
    <footer id="footer" class="section section-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <div class="footer-logo">
                            <a class="logo" href="#"><img src="./images/logo.png" alt=""></a>
                        </div>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Tài khoản của tôi</h3>
                        <?php include('php/footer.php'); ?>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Số điện thoại</h3>
                        <p><i class="fa fa-phone-square"> 1234.567.89</i></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">Giới thiệu</h3>
                        <p>TIPO là trang web bán mỹ phẩm uy tín nhất thế giới.</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="footer-copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="" target="_blank">TIPO</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
