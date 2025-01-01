<?php
// Kết nối với cơ sở dữ liệu
require_once('../DataProvider.php');

// Kiểm tra xem có ComplaintID trong URL không
if (isset($_GET['complaintID'])) {
    $complaintID = $_GET['complaintID'];

    // Truy vấn thông tin khiếu nại từ cơ sở dữ liệu
    $sql = "SELECT 
            c.ComplaintID, 
            c.Title, 
            c.Description, 
            c.Status, 
            c.AdminReply, 
            i.Email, 
            i.PhoneNo,
            i.Total 
        FROM complaint c
        JOIN invoice i ON c.InvoiceID = i.InvoiceID
        WHERE c.ComplaintID = $complaintID";    
        $result = DataProvider::executeQuery($sql);

    // Kiểm tra nếu có kết quả
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Lấy thông tin khiếu nại hiện tại
        $title = $row['Title'];
        $description = $row['Description'];
        $status = $row['Status'];
        $adminReply = $row['AdminReply']; // Lấy phản hồi của admin
        $email = $row['Email']; // Email khách hàng
        $sdt = $row['PhoneNo'];
        $totalAmount = $row['Total']; // Giá trị đơn hàng
        if ($status == 0) {
            $adminReply = ''; 
        }
    } else {
        // Nếu không tìm thấy khiếu nại, chuyển về trang quản lý khiếu nại
        header('Location: admin-complaint.php');
        exit();
    }
} else {
    // Nếu không có ComplaintID, chuyển về trang quản lý khiếu nại
    header('Location: admin-complaint.php');
    exit();
}

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newStatus = $_POST['status'];
    $newAdminReply = $_POST['adminReply'];

    // Nội dung phản hồi mặc định
    $defaultReply = "Kính gửi Quý khách, Cảm ơn quý khách đã liên hệ với chúng tôi. Chúng tôi rất tiếc khi nghe về sự bất tiện mà quý khách gặp phải. Chúng tôi đang tiến hành kiểm tra vấn đề của quý khách và sẽ sớm phản hồi lại với giải pháp thích hợp. Chúng tôi cam kết sẽ nỗ lực hết mình để khắc phục sự cố và mang lại trải nghiệm tốt nhất cho quý khách. Nếu quý khách có thêm bất kỳ câu hỏi hay yêu cầu nào, xin đừng ngần ngại liên hệ lại với chúng tôi. Xin chân thành cảm ơn quý khách đã thông cảm và kiên nhẫn. Trân trọng, TIPO."; 

    // Nếu trạng thái là "Chưa xử lý" và phản hồi khác với nội dung mặc định
    if ($newStatus == 0 && $newAdminReply !== $defaultReply) {
        $newStatus = 1; // Tự động chuyển trạng thái thành "Đã xử lý"
    }
    // Cập nhật khiếu nại trong cơ sở dữ liệu
    $updateSql = "UPDATE complaint SET Status = $newStatus, AdminReply = '$newAdminReply' WHERE ComplaintID = $complaintID";
    if (DataProvider::executeQuery($updateSql)) {
        // Thông báo thành công và quay lại trang quản lý khiếu nại
        echo "<script>alert('Cập nhật khiếu nại thành công'); window.location.href = 'admin-complaint.php';</script>";
    } else {
        // Thông báo lỗi
        echo "<script>alert('Có lỗi xảy ra khi cập nhật khiếu nại');</script>";
    }
}
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
                <h3 class="mt-4" style="border-bottom: 1px dashed grey;">                
                    <a href="admin-complaint.php" class="btn btn-secondary mt-3"> <i class="fas fa-arrow-left"></i></a>
                    Chi tiết đơn khiếu nại
                </h3>

                <form action="edit-complaint.php?complaintID=<?php echo $complaintID; ?>" method="POST">
                    <div class="form-group">
                        <label for="email"><strong>Email khách hàng:</strong></label>
                        <p id="email"><?= htmlspecialchars($email) ?></p>
                    </div>
                    <div class="form-group">
                        <label for="sdt"><strong>Số Điện Thoại khách hàng:</strong></label>
                        <p id="sdt"><?= htmlspecialchars($sdt) ?></p>
                    </div>

                    <div class="form-group">
                        <label for="totalAmount"><strong>Giá trị đơn hàng:</strong></label>
                        <p id="totalAmount"><?= htmlspecialchars($totalAmount) ?> VND</p>
                    </div>

                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" disabled>
                    </div>

                    
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <textarea id="description" name="description" rows="4" cols="50" class="form-control" disabled><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="adminReply">Phản hồi của quản trị viên:</label>
                        <textarea id="adminReply" name="adminReply" rows="4" cols="50" class="form-control" <?php echo $status == 1 ? : ''; ?>><?php echo htmlspecialchars($adminReply); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>

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
    