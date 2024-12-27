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
			<div class="container-home">
				<div class="ad-section-left">
					<ul>
						<li><img src="./images/Banner/banner05.gif" alt="Ad 1"></li>
					</ul>
				</div>
				<!-- home wrap -->
				<div class="home-wrap">
					<!-- home slick -->
					<div id="home-slick">
						<!-- banner -->
						<div class="banner banner-1">
							<img src="./images/Banner/banner01.jpg" alt="">
						</div>
						<!-- /banner -->

						<!-- banner -->
						<div class="banner banner-1">
							<img src="./images/Banner/banner02.jpg" alt="">
						</div>
						<!-- /banner -->

						<!-- banner -->
						<div class="banner banner-1">
							<img src="./images/Banner/banner03.jpg" alt="">
						</div>
						<!-- /banner -->

						 <!-- banner -->
						<div class="banner banner-1">
							<img src="./images/Banner/banner04.jpg" alt="">
						</div>
						<!-- /banner -->
					</div>
					<!-- /home slick -->
				</div>
				<!-- /home wrap -->
				<div class="ad-section-right">
					<ul>
						<li><img src="./images/Banner/banner06.jpg" alt="Ad 1"></li>
					</ul>
				</div>
			</div>
			<!-- /container -->
	</div>
	<!-- /HOME -->
	<!-- section -->
	<div class="section section-index">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title"> Sản phẩm mới </h2>
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
						echo "<div class='new-label'>New</div>";
						include('php/productsingle.php');
						echo "</div>";
						echo "</form>";
						echo "<!-- /Product Single -->";
					}
				?>
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title"> Sản phẩm hot </h2>
					</div>
				</div>
				<!-- section title -->
				<?php
					$sql = "SELECT * FROM Product WHERE isTrending = 1 ORDER BY Date DESC LIMIT 0,4";
					$result = DataProvider::executeQuery($sql);
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo "<!-- Product Single -->";
						echo "<form name='products' id='products' action='php/cart.php' method='POST'>";
						echo "<div class='col-md-3 col-sm-6 col-xs-6'>";
						echo "<div class='new-label'>Hot</div>";
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


	<!-- About Us -->
	<div class="container-about">

    	<!-- Phần bên trái -->
		<div class="left">
		<img src="./images/nena.gif" alt="Product Intro">
		</div>

		<!-- Phần bên phải -->
		<div class="right">

			<!-- Title -->
			<div class="title">
				<h2>Facial Skin care</h2>
				<p>Khám phá những sản phẩm làm sạch phù hợp cho quy trình chăm sóc da của bạn, giúp da luôn khỏe mạnh và rạng rỡ</p>
			</div>

			<!-- Sản phẩm -->
			<div class="products">

				<!-- Button Previous -->
				<button class="prev-btn">&lt;</button>

				<!-- Product Items -->
				<div class="product-list">
					<?php
					$sql = "SELECT * FROM Product p 
							JOIN ProductType pt ON p.ProductTypeID = pt.ProductTypeID 
							WHERE pt.ProductTypeName = 'Sữa rửa mặt'";

					$result = DataProvider::executeQuery($sql);

					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo "<!-- Product Single -->";
								echo "<form name='products' id='products' action='php/cart.php' method='POST'>";
								include('php/productsingle.php');
								echo "</form>";
								echo "<!-- /Product Single -->";
					}
					
					?>
					
				</div>
				<button class="next-btn">&gt;</button>

				<!-- Button Next -->
			</div>
		</div>
    </div>

	<!-- /section -->
	 <!-- Member Benefits Section -->
	<div class="member-benefits">
    	<h2><span>Ưu đãi thành viên</span></h2>
		<div class="benefits-container">
			<!-- First Row -->
			<div class="benefit-item">
				<img src="./images/Banner/icon1.png" alt="Icon 1">
				<h3>ĐĂNG KÝ</h3>
			</div>
			<div class="benefit-item">
				<img src="./images/Banner/icon2.png"alt="Icon 2">
				<h3>ƯU ĐÃI THÀNH VIÊN</h3>
			</div>
			<div class="benefit-item">
				<img src="./images/Banner/icon3.png" alt="Icon 3">
				<h3>ĐIỂM THƯỞNG</h3>
			</div>
			<div class="benefit-item">
				<img src="./images/Banner/icon4.png" alt="Icon 4">
				<h3>VOUCHER</h3>
			</div>
			<div class="benefit-item">
				<img src="./images/Banner/icon5.png" alt="Icon 5">
				<h3>DỊCH VỤ GIAO HÀNG</h3>
			</div>
			<div class="benefit-item">
				<img src="./images/Banner/icon6.png" alt="Icon 6">
				<h3>PHƯƠNG THỨC THANH TOÁN</h3>
			</div>
		</div>
	</div>
	<!-- /Member Benefits Section -->
	<!-- <div class="img-deco">
		<img src="./images/nenc.png" alt="Decoration Image">
	</div> -->
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
<script>
	document.addEventListener('DOMContentLoaded', function () {
  const nextBtn = document.querySelector('.next-btn');
  const prevBtn = document.querySelector('.prev-btn');
  const productList = document.querySelector('.product-list');
  let currentIndex = 0; // Vị trí sản phẩm hiện tại

  const products = document.querySelectorAll('.product-list form');
  const productsPerPage = 2; // Số sản phẩm muốn hiển thị mỗi lần

  // Hàm cập nhật sản phẩm hiển thị
  function updateProductDisplay() {
    // Ẩn tất cả sản phẩm
    products.forEach((product, index) => {
      if (index < currentIndex || index >= currentIndex + productsPerPage) {
        product.style.display = 'none';
      } else {
        product.style.display = 'inline-block';
      }
    });
	
  }

  // Hiển thị các sản phẩm khi tải trang
  updateProductDisplay();

  // Sự kiện cho nút "Next"
  nextBtn.addEventListener('click', function () {
    if (currentIndex + productsPerPage < products.length) {
      currentIndex += productsPerPage; // Di chuyển đến các sản phẩm tiếp theo
      updateProductDisplay(); // Cập nhật hiển thị
    }
  });

  // Sự kiện cho nút "Prev"
  prevBtn.addEventListener('click', function () {
    if (currentIndex - productsPerPage >= 0) {
      currentIndex -= productsPerPage; // Di chuyển về các sản phẩm trước đó
      updateProductDisplay(); // Cập nhật hiển thị
    }
  });
});

</script>
</body>

</html>
