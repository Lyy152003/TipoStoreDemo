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
	<div class="section">
		<!-- container -->
		<div class="container container-admin">
		<?php include('php/navigationInvoice.php'); ?>

			<!-- row -->
			<div class="row row-admin">
				<!-- MAIN -->
				<div id="main" class="col-md-12">


					<table border=1>
						<tr>
							<td>Mã Hóa Đơn</td>
							<td>Email</td>
							<td>Tên Khi Giao</td>
							<td>SĐT Khi Giao</td>
							<td>Địa Chỉ Giao</td>
							<td>Tình trạng đơn</td>
							<!-- <td>Tiền Hàng</td>
							<td>Ship</td> -->
							<td>Tổng Cộng</td>
							<td></td>
						</tr>
						<?php
							require_once('../DataProvider.php');
							$sql="SELECT * FROM Invoice";
							$rs=DataProvider::executeQuery($sql);
							while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
							{
								echo "<tr>";
								echo "<form id='Invoice' name='Invoice' action='admin-invoice-details.php' method='POST'>";

								echo "<input type='hidden' name='InvoiceID' id='InvoiceID' value='".$row['InvoiceID']."'>";
								
								echo "<td>".$row['InvoiceID']."</td>";
								echo "<td>".$row['Email']."</td>";
								echo "<td>".$row['UsrName']."</td>";
								echo "<td>".$row['PhoneNo']."</td>";
								echo "<td>".$row['Address']."</td>";
								// Status Dropdown with 4 options
								echo "<td><select name='status' id='status' data-invoice-id='" . $row['InvoiceID'] . "'>";
								$statusOptions = ["Chờ xác nhận", "Đã tiếp nhận", "Đang giao hàng", "Hoàn tất đơn hàng ", "Đơn bị Hủy"];
								
								foreach ($statusOptions as $statusOption) {
									$selected = ($row['Status'] == $statusOption) ? 'selected' : 'Chờ xác nhận'; // Mark current status as selected
									echo "<option value='$statusOption' $selected>$statusOption</option>";
								}
								echo "</select></td>";							
									
								// echo "<td>".$row['SubTotal']."</td>";
																// echo "<td>".$row['Ship']."</td>";
								echo "<td>".$row['Total']."</td>";

								echo "<td><input type='submit' name='btnSubmitInvoice' id='btnSubmitInvoice' value='Xem Chi Tiết'></td>";

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

	

	<!-- jQuery Plugins -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
// JavaScript to handle the status change and update it automatically via AJAX
document.querySelectorAll('select[name="status"]').forEach(select => {
    select.addEventListener('change', function() {
        var invoiceID = this.getAttribute('data-invoice-id');
        var status = this.value;

        // AJAX request to update status in the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_invoice_status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status == 200) {
                alert('Trạng thái hóa đơn đã được cập nhật!');
            } else {
                alert('Có lỗi xảy ra khi cập nhật trạng thái!');
            }
        };
        xhr.send('InvoiceID=' + invoiceID + '&status=' + status);
    });
});
</script>
</body>

</html>
