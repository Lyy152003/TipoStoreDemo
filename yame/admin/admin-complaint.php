<?php
// Kết nối với cơ sở dữ liệu
require_once('../DataProvider.php');

// Truy vấn tất cả các khiếu nại
$sql = "SELECT * FROM complaint ORDER BY DateSubmitted DESC";
$result = DataProvider::executeQuery($sql);

?>

<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionUsr.php');
?>
<html lang="vi">
<?php
	ob_start();
?>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/extrastyle.css">
	<link type="text/css" rel="stylesheet" href="../css/adminbonus.css">

	<script src="../js/extrafunction.js"></script>
	<script src="js/admin.js"></script>

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
    <div class="section">
		<!-- container -->
		<div class="container container-admin">
		    <?php include('php/navigationUsr.php') ?>
            <div class="row row-admin" style="padding: 15px;">
            <h3 class="mt-4" style="padding: 15px;">Quản Lý đơn khiếu nại</h3>

                <table border="1">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tiêu đề</th>
                            <th>Tình trạng</th>
                            <th>Ngày gửi</th>
                            <!-- <th>Phản hồi</th> -->
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Hiển thị tất cả các khiếu nại
                        while ($row = mysqli_fetch_assoc($result)) {
                            $complaintID = $row['ComplaintID'];
                            $title = $row['Title'];
                            $status = $row['Status'];
                            $dateSubmitted = $row['DateSubmitted'];
                            // $adminReply = $row['AdminReply'];
                            // Hiển thị tình trạng khiếu nại
                            $statusText = $status == 0 ? 'Chưa xử lý' : 'Đã xử lý';
                            $statusClass = $status == 0 ? 'status-pending' : 'status-completed'; // Xác định lớp CSS tùy theo trạng thái
                            ?>
                            <tr>
                                <td><?php echo $complaintID; ?></td>
                                <td><?php echo htmlspecialchars($title); ?></td>
                                <td>
                                    <span class="status <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                </td>                                
                                <td><?php echo $dateSubmitted; ?></td>
                                <td>
                                    <!-- Liên kết để chỉnh sửa khiếu nại -->
                                    <a href="edit-complaint.php?complaintID=<?php echo $complaintID; ?>">💌</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

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
    <script src="../js/extrafunction.js"></script>

    </body>
    </html>
    