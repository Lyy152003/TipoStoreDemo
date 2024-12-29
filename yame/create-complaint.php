<?php

session_start();
include('php/sessionStart.php');

if (isset($_GET['invoiceID'])) {
    $invoiceID = $_GET['invoiceID'];
} else {
    // Xử lý lỗi nếu không có invoiceID
    echo "Invoice ID not found!";
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

		<style>
		/* General styling for the form */
.submit-complaint {
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
}

/* Style for form labels */
.submit-complaint label {
    font-weight: bold;
    margin-bottom: 8px;
    display: block;
    color: #333;
}

/* Style for input fields */
.submit-complaint input[type="text"],
.submit-complaint textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Style for textarea */
.submit-complaint textarea {
    height: 150px;
    resize: vertical; /* allows user to resize vertically */
}

/* Focus state for input and textarea */
.submit-complaint input[type="text"]:focus,
.submit-complaint textarea:focus {
    border-color: #F8694A;
    outline: none;
}

/* Style for the submit button */
.submit-complaint input[type="submit"] {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 5px;
    background-color: #F8694A;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Submit button hover effect */
.submit-complaint input[type="submit"]:hover {
    background-color: #F8694A;
}

/* Add a bottom margin to the form elements */
.submit-complaint input[type="text"],
.submit-complaint textarea,
.submit-complaint input[type="submit"] {
    margin-bottom: 15px;
}

/* Optional: Make the form responsive for mobile */
@media (max-width: 600px) {
    .submit-complaint {
        padding: 15px;
    }

    .submit-complaint input[type="submit"] {
        padding: 10px;
    }
}

		</style>
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
			<a href="check-invoice-user.php" class="btn btn-secondary mt-3"> <i class="fas fa-arrow-left"></i> Quay về trước</a>

                    <form class="submit-complaint" action="submit-complaint.php" method="post">

                        <input type="hidden" name="invoiceID" value="<?php echo $invoiceID; ?>">
                        <label for="title">Tiêu đề khiếu nại:</label>
                        <input type="text" name="title" required><br>

                        <label for="description">Mô tả khiếu nại:</label><br>
                        <textarea name="description" required></textarea><br>

                        <input type="submit" value="Gửi khiếu nại">
                    </form>

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
