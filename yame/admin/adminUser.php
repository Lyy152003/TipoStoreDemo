<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionUsr.php');
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
	<script src="../js/extrafunction.js"></script>

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
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php
						include('../php/helloUsr.php');
					?>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="../images/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<?php include('php/account.php'); ?>

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<?php include('php/navigationUsr.php') ?>

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- MAIN -->
				<div id="main" class="col-md-12">
					<?php
						require_once('../DataProvider.php');
						if(isset($_POST['btnEditUsr']))
						{
							$sql="UPDATE Usr SET 
												UsrName='".$_POST['txtUsrName']."',
												PhoneNo='".$_POST['txtPhoneNo']."',
												Address='".$_POST['txtAddress']."',
												Blocked='".$_POST['slcBlocked']."',
												Authentication='".$_POST['slcAuthentication']."'
								WHERE Email='".$_POST['txtEmail']."'";
							DataProvider::executeQuery($sql);
							echo "<script>alert('Đã sửa thành công');</script>";
                        }
					?>
					<!-- hiển thị bảng -->
					<table border=1>
						<span id='lblNULL' name='lblNULL' style='color:red; display:none'>*: Chưa nhập/Chưa chọn</span>
						<tr>
							<td>Email</td>
							<td>Tên người dùng</td>
                            <td>Số điện thoại</td>
                            <td>Địa chỉ</td>
                            <td>Blocked</td>
                            <td>Quyền</td>
							<td></td>
						</tr>
						<?php
							require_once('../DataProvider.php');
							$sql="SELECT * FROM Usr";
							$rs=DataProvider::executeQuery($sql);
							while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
							{
								echo "<tr>";
                                echo "<form id='editUsr' name='editUsr' action='admin-edit-user.php' method='POST'>";
                                
								echo "<td id='txtEmailUsr' name='txtEmailUsr'>".$row['Email']."</td>";

								echo "<td id='txtUsrname' name='txtUsrname'>".$row['UsrName']."</td>";

                                echo "<td id='txtPhone' name='txtPhone'>".$row['PhoneNo']."</td>";
                                
                                echo "<td id='txtAddress' name='txtAddress'>".$row['Address']."</td>";

                                echo "<td id='txtBlocked' name='txtBlocked'>".$row['Blocked']."</td>";

								echo "<td id='txtAuthentication' name='txtAuthentication'>".$row['Authentication']."</td>";
								
								echo "<input name='txtEmail' id='txtEmail' type='hidden' value='".$row['Email']."'>";

								echo "<td><input name='btnUserSubmit' id='btnUserSubmit' type='submit' value='Sửa'></td>";

								echo "</form>";
								echo "</tr>";
							}
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

	<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Team Tipo</a>
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
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>

</body>

</html>
