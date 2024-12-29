<?php
require_once('../DataProvider.php');

// Truy vấn số lượng tài khoản
$sql_accounts = "SELECT COUNT(*) AS totalAccounts FROM usr WHERE Blocked = 0";
$result_accounts = DataProvider::executeQuery($sql_accounts);
$row_accounts = mysqli_fetch_assoc($result_accounts);
$totalAccounts = $row_accounts['totalAccounts'];

// Truy vấn số lượng đơn hàng
$sql_orders = "SELECT COUNT(*) AS totalOrders FROM invoice";
$result_orders = DataProvider::executeQuery($sql_orders);
$row_orders = mysqli_fetch_assoc($result_orders);
$totalOrders = $row_orders['totalOrders'];

// Truy vấn số lượng voucher
$sql_vouchers = "SELECT COUNT(*) AS totalVouchers FROM voucher";
$result_vouchers = DataProvider::executeQuery($sql_vouchers);
$row_vouchers = mysqli_fetch_assoc($result_vouchers);
$totalVouchers = $row_vouchers['totalVouchers'];

// Truy vấn số lượng sản phẩm
$sql_products = "SELECT COUNT(*) AS totalProducts FROM product";
$result_products = DataProvider::executeQuery($sql_products);
$row_products = mysqli_fetch_assoc($result_products);
$totalProducts = $row_products['totalProducts'];


// truy vấn doanh thu
// Truy vấn SQL lấy dữ liệu thống kê theo tháng
$sql = "SELECT 
MONTH(DateInvoice) AS month,
SUM(Total) AS totalRevenue
FROM 
invoice
WHERE 
YEAR(DateInvoice) = YEAR(CURDATE())  -- Lọc theo năm hiện tại
GROUP BY 
MONTH(DateInvoice)
ORDER BY 
MONTH(DateInvoice)";

$result = DataProvider::executeQuery($sql);

if (!$result) {
die('Lỗi truy vấn SQL: ' . mysqli_error($conn));
}

$months = [];
$totalRevenue = [];

while ($row = mysqli_fetch_assoc($result)) {
$months[] = 'Tháng ' . $row['month']; 
$totalRevenue[] = $row['totalRevenue'];
}

?>

<!DOCTYPE html>
<?php
	ob_start();
?>
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
		<!-- container -->
	</header>
	<!-- /HEADER -->


    <!-- section -->
	<div class="section">
		<!-- container -->

		<div class="container container-admin">
			<?php include('php/navigationUsr.php') ?>

            <div class="admin-dashboard">
                <h3>Hi, Welcome to Admin Dashboard 👋</h3>
                    <div class="stats">

                        <div class="stat-item">
                            <div class="stat-content">
                                <h2>Số lượng tài khoản </h2>
                                <p><?php echo $totalAccounts; ?> </p>
                            </div>
                            <Span>[ACTIVE]</Span>

                            <i class="fas fa-users-cog icon"></i> <!-- Icon đẹp hơn cho tài khoản -->
                        </div>

                        <!-- Stat Item 2: Số lượng đơn hàng -->
                        <div class="stat-item">
                            <div class="stat-content">
                                <h2>Số lượng đơn hàng</h2>
                                <p><?php echo $totalOrders; ?></p>
                            </div>
                            <i class="fas fa-clipboard-list icon"></i> <!-- Icon đẹp hơn cho đơn hàng -->
                        </div>

                        <!-- Stat Item 3: Số lượng voucher -->
                        <div class="stat-item">
                            <div class="stat-content">
                                <h2>Số lượng voucher</h2>
                                <p><?php echo $totalVouchers; ?></p>
                            </div>
                            <i class="fas fa-tags icon"></i> <!-- Icon đẹp hơn cho voucher -->
                        </div>

                        <!-- Stat Item 4: Số lượng sản phẩm -->
                        <div class="stat-item">
                            <div class="stat-content">
                                <h2>Số lượng sản phẩm</h2>
                                <p><?php echo $totalProducts; ?></p>
                            </div>
                            <i class="fas fa-box icon"></i> <!-- Thay bằng Icon hộp đẹp hơn cho sản phẩm -->
                    </div>
					
					<h3 class="text-center">Thống Kê Doanh Thu 2024</h3>

					<!-- Bảng thống kê -->
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th>Tháng</th>
								<th>Tổng doanh thu (VND)</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < count($months); $i++) : ?>
							<tr>
								<td><?php echo $months[$i]; ?></td>
								<td><?php echo number_format($totalRevenue[$i]); ?></td>
							</tr>
							<?php endfor; ?>
						</tbody>
					</table>

					<!-- Biểu đồ doanh thu và số hóa đơn -->
					<canvas id="revenueChart"style="width: 500px; height: 150px;"></canvas>

					<!-- <h3 class="text-center">Thống Kê số lượng bán ra từng sản phẩm</h3> -->

					<?php
					$sql_accounts = "SELECT ProductName, Brand, Doanh_so FROM Product ORDER BY Doanh_so DESC";
					$result_ds = DataProvider::executeQuery($sql_accounts);
					echo '<h3 class="text-center">Thống Kê số lượng bán ra từng sản phẩm</h3>';

					// Bắt đầu hiển thị bảng
					echo "<table border='1' cellspacing='0' cellpadding='5' text-align: center;'>";
					echo "<tr>
							<th>Tên sản phẩm</th>
							<th>Thương hiệu</th>
							<th>Doanh số</th>
						  </tr>";
					
					// Duyệt qua từng dòng kết quả và hiển thị trong bảng
					while ($row_ds = mysqli_fetch_assoc($result_ds)) {
						echo "<tr>";
						echo "<td>" . $row_ds['ProductName'] . "</td>";
						echo "<td>" . $row_ds['Brand'] . "</td>";
						echo "<td>" . $row_ds['Doanh_so'] . "</td>";
						echo "</tr>";
					}
					
					// Kết thúc bảng
					echo "</table>";
					?>
					</div>

                </div>
            </div>
            

        </div>
    </div>

	<!-- jQuery Plugins -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    
                    label: 'Tổng doanh thu (VND)',
                    data: <?php echo json_encode($totalRevenue); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
