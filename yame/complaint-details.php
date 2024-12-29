<?php
session_start();
include('php/sessionStart.php');
// Kết nối với cơ sở dữ liệu
require_once('DataProvider.php');

// Kiểm tra nếu có ComplaintID trong URL
if (isset($_GET['complaintID'])) {
    $complaintID = $_GET['complaintID'];

    // Truy vấn thông tin chi tiết khiếu nại từ bảng 'complaint' dựa trên ComplaintID
    $sql = "SELECT * FROM complaint WHERE ComplaintID = $complaintID";
    $result = DataProvider::executeQuery($sql);

    // Kiểm tra nếu có kết quả trả về
    if (mysqli_num_rows($result) > 0) {
        $complaint = mysqli_fetch_assoc($result); // Lấy dữ liệu khiếu nại

        // Lấy thông tin từ khiếu nại
        $title = $complaint['Title'];
        $description = $complaint['Description'];
        $status = $complaint['Status'];
        $dateSubmitted = $complaint['DateSubmitted'];
        $adminReply = $complaint['AdminReply'];
    } else {
        echo "Không tìm thấy khiếu nại này.";
        exit();
    }
} else {
    echo "Không có mã khiếu nại.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>TIPO STORE</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded|Encode+Sans+Semi+Condensed" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/extrastyle.css">
	    <link type="text/css" rel="stylesheet" href="css/bonus.css" />

	<script src="js/extrafunction.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
<?php include('php/header.php'); ?>

<!-- NAVIGATION -->
<div id="navigation">
    <!-- container -->
    <div class="container">
        <div id="responsive-nav">
        <!-- category nav -->
        <div class="category-nav show-on-click">
            <?php include('php/category-nav.php'); ?>
        </div>
        <!-- /category nav -->

            <?php include('php/menu-nav.php'); ?>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Tài khoản</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->
<div class="section">
    <!-- container -->
    <div class="container user">
        <!-- row -->
        <div class="row">
		<a href="check-invoice-user.php"> <i class="fas fa-arrow-left"></i></a>
            <div>
                <h3>Tiêu đề: <?php echo htmlspecialchars($title); ?></h3>
                <p><strong>Mô tả:</strong> <?php echo nl2br(htmlspecialchars($description)); ?></p>
                <p><strong>Tình trạng:</strong> <?php echo $status == 0 ? 'Chưa xử lý' : 'Đã xử lý'; ?></p>
                <p><strong>Ngày gửi khiếu nại:</strong> <?php echo $dateSubmitted; ?></p>
                <p><strong>Phản hồi từ quản trị viên:</strong> <?php echo nl2br(htmlspecialchars($adminReply)); ?></p>
            </div>
            
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
 <!-- FOOTER -->
<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <img src="./images/logo.png" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p></p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Tài khoản của tôi</h3>
						<?php include('php/footer.php'); ?>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">số điện thoại</h3>
						<p><i class="fa fa-phone-square"> 1234.567.89</i></p>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Giới thiệu</h3>
						<p>Tipo là trang web bán mỹ phẩm uy tín nhất thế giới. Được thành lập từ năm 2023. Với hơn 1 tháng kinh nghiệm, chúng tôi sẽ cố gắng phục vụ bạn</p>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="" target="_blank">TIPO</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
