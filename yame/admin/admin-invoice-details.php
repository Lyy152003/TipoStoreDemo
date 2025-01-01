<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionInvoice.php');
?>
<?php
	ob_start();
?>
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
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/extrastyle.css">
	<link type="text/css" rel="stylesheet" href="../css/adminbonus.css">

	<script src='js/admin.js'></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
	<!-- HEADER -->
	<header>
		<?php
			if($_SESSION['isLogin']==1)
			{
				require_once('../DataProvider.php');
				$sql="SELECT * FROM Usr WHERE Email='".$_SESSION['username']."'";
				$Usr=DataProvider::executeQuery($sql);
				$rowUsr=mysqli_fetch_array($Usr,MYSQLI_BOTH);
			}
		?>
		<!-- header -->
		<div id="header">
			<div class="container">
				
				<div class="pull-right">
					<ul class="header-btns">
						<?php include('php/account.php'); ?>

						<!-- <li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li> -->
					</ul>
				</div>
			</div>
		</div>
	</header>
	<!-- /HEADER -->


	<!-- section -->
	<?php
		if(!isset($_POST['btnSubmitInvoice']))
			header('Location: admin-invoice.php');
	?>
	<div class="section">
		<!-- container -->
		<div class="container container-admin">
		<?php include('php/navigationInvoice.php'); ?>

			<!-- row -->
			<div class="row row-admin">
				<!-- MAIN -->
				<div id="main" class="col-md-12">
					<?php
						$sql="SELECT * FROM Invoice WHERE InvoiceID='".$_POST['InvoiceID']."'";
						$rs=DataProvider::executeQuery($sql);
						$rowInvoice=mysqli_fetch_array($rs,MYSQLI_BOTH);

						echo "<p>Mã Hóa Đơn: ".$rowInvoice['InvoiceID']."</p>";
						echo "<p>Email ".$rowInvoice['Email']."</p>";
						echo "<p>Tên Khi Giao: ".$rowInvoice['UsrName']."</p>";
						echo "<p>SĐT Khi Giao: ".$rowInvoice['PhoneNo']."</p>";
						echo "<p>Địa Chỉ Giao: ".$rowInvoice['Address']."</p>";
						echo "<p>Tiền Hàng: ".$rowInvoice['SubTotal']."</p>";
						echo "<p>Ship: ".$rowInvoice['Ship']."</p>";
						echo "<p>Giảm giá: ".$rowInvoice['Discount']."</p>";
						echo "<p>Giá trị đơn hàng: ".$rowInvoice['Total']."</p>";
					?>
					<table border=1>
						<tr>
							<td>Mã Hàng Hóa</td>
							<td>Hình ảnh</td>
							<td>Tên sản phẩm</td>
							<td>Đơn giá</td>
							<td>Số Lượng</td>
							<td>Thành tiền</td>
						</tr>
						<?php
							require_once('../DataProvider.php');
							$sql="SELECT * FROM InvoiceDetails INNER JOIN Product WHERE InvoiceDetails.ProductID=Product.ProductID AND InvoiceDetails.InvoiceID='".$_POST['InvoiceID']."'";
							$rs=DataProvider::executeQuery($sql);
							while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
							{
								echo "<tr>";
								echo "<td>".$row['ProductID']."</td>";
								echo "<td><img src='../img/".$row['imgsrc']."' width='200px'></td>";
								echo "<td align='center'>".$row['ProductName']."</td>";
								echo "<td align='center'>".$row['UnitPrice']."</td>";
								echo "<td align='center'>".$row['Quantities']."</td>";
								echo "<td align='center'>".$row['SubTotal']."</td>";
								echo "</tr>";
							}
							echo "<td></td>";
							echo "<td></td>";
							echo "<td></td>";
							// echo "<td>Tiền Hàng</td>";
							// echo "<td align='center'>".$rowInvoice['SubTotal']."</td>";
						?>
					</table>
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->


	<!-- jQuery Plugins -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>

</body>

</html>
