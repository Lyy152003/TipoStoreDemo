<?php
	session_start();
	// quản lý phiên đang nhập
	if(isset($_POST['btnLogOut']) || isset($_GET['logout'])==1)
	{
		session_destroy();
		$_SESSION['isLogin']=0;
		$_SESSION['Cart']="";
		header("Location: index.php");
	}
	include('php/sessionStart.php');
	if($_SESSION['isLogin']==1)
		if($_SESSION['Authentication']!='Usr')
		{
			echo "<script>alert('Bạn không có quyền trong user');</script>";
			header('Location: admin');
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

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css\style.css" />
	<script src='js/extrafunction.js'></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- hello, logo, search, signin/up, basket -->
	<?php include('php/header.php'); ?>
	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				<div class="category-nav">
					<?php include('php/category-nav.php'); ?>
				</div>
				<!-- /category nav -->

				<?php include('php/menu-nav.php'); ?>
			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- HOME -->
	<div id="home">
		<!-- container -->
		<div class="container">
			<!-- home wrap -->
			<div class="home-wrap">
				<!-- home slick -->
				<div id="home-slick">
					<!-- banner -->
					<div class="banner banner-1">
						<img src="./images/banner01.jpeg" alt="">
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="./images/banner02.jpeg" alt="">
					</div>
					<!-- /banner -->

					<!-- banner -->
					<div class="banner banner-1">
						<img src="./images/banner03.jpeg" alt="">
					</div>
					<!-- /banner -->
				</div>
				<!-- /home slick -->
			</div>
			<!-- /home wrap -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOME -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">New Item</h2>
					</div>
				</div>
				<!-- section title -->
				<?php
					$sql = "SELECT * FROM Product ORDER BY Date DESC LIMIT 0,4";
					$result = DataProvider::executeQuery($sql);
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo "<!-- Product Single -->";
						echo "<form name='products' id='products' action='php/cart.php' method='POST'>";
						echo "<div class='col-md-3 col-sm-6 col-xs-6'>";
						include('php/productsingle.php');
						echo "</div>";
						echo "</form>";
						echo "<!-- /Product Single -->";
					}
				?>
			</div>
			<!-- row -->
			
		</div>
		<!-- /container -->
	</div>
	<!-- video-deco -->
	<div class="video-decoration">
                        <video autoplay muted loop>
                        <source src="./images/video/deco.mp4" type="video/mp4">
                        </video>
    </div>

	<div class="section-feedback">
                <div class="feedback-container">
                    <div class="customer-feedback">
                        <div class="stars">
                            <span>⭐ ⭐ ⭐ ⭐ ⭐</span>
                        </div>
                        <div class="question">
                            <h3>Great product</h3>
                            <p>Great product, very fast shipping 😍👍</p>
                            <i>Anastasiia Shevchenko, 4 days ago</i>
                        </div>
                    </div>
                    <div class="customer-feedback">
                        <div class="stars">
                            <span>⭐ ⭐ ⭐ ⭐ ⭐</span>
                        </div>
                        <div class="question">
                            <h3>Great Variety</h3>
                            <p>I love everything in the box. I received 6 items. Some were of my own choices and the ...</p>
                            <i>Cynthia Stanley, 2 days ago</i>
                        </div>
                    </div>
                    <div class="customer-feedback">
                        <div class="stars">
                            <span>⭐ ⭐ ⭐ ⭐ ⭐</span>
                        </div>
                        <div class="question">
                            <h3>Smooth experience</h3>
                            <p>Smooth experience, fast international shipping,...</p>
                            <i>Mel </i>
                        </div>
                    </div>
                    <div class="customer-feedback">
                        <div class="stars">
                            <span>⭐ ⭐ ⭐ ⭐ ⭐</span>
                        </div>
                        <div class="question">
                            <h3>Great Products, Quick Delivery</h3>
                            <p>My products came very quickly and I love them.😇😘</p>
                            <i>Nancy</i>
                        </div>
                    </div>
                </div>
            </div>
	<!-- /section -->
	<br><br>
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

						<!-- <p>Phục vụ như mẹ của bạn</p> -->

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
						<h3 class="footer-header">Số điện thoại</h3>
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
