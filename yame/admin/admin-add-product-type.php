<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionStore.php');
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
		<?php include('php/navigationProduct.php'); ?>

			<!-- row -->
			<div class="row row-admin">
				<!-- MAIN -->
				<?php
					require_once('../DataProvider.php');

					if (isset($_POST['btnAddProductType'])) {
						// Lấy dữ liệu từ form
						$productName = $_POST['ttxtProductName'];
						$gender = $_POST['tslcGender'];
						$category = $_POST['ttxtCategory'];

						// Truy vấn kiểm tra sản phẩm trùng
						$sql = "SELECT * FROM ProductType 
								WHERE ProductTypeName LIKE '$productName' 
								AND Gender='$gender'";
						
						$rs = DataProvider::executeQuery($sql);
						$isDuplicateCategory = false; // Trùng cả danh mục
						$isDuplicateOtherCategory = false; // Trùng nhưng khác danh mục

						// Duyệt qua kết quả
						while ($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
							if ($row['Category'] == $category) {
								$isDuplicateCategory = true; // Trùng danh mục
							} else {
								$isDuplicateOtherCategory = true; // Trùng nhưng danh mục khác
							}
						}

						// Xử lý các trường hợp
						if ($isDuplicateCategory) {
							echo "<script>alert('Xin lỗi, ở danh mục [$category] đã có sản phẩm [$productName] dành cho giới tính [$gender]')</script>";
						} elseif ($isDuplicateOtherCategory) {
							echo "<script>alert('Xin lỗi, loại sản phẩm [$productName] đã có ở sản phẩm [$category]')</script>";
						} else {
							// Nếu không trùng, thêm sản phẩm mới vào cơ sở dữ liệu
							$sql = "INSERT INTO ProductType (ProductTypeName, Gender, Category) 
									VALUES ('$productName', '$gender', '$category')";
							DataProvider::executeQuery($sql);

							// Hiển thị thông báo và chuyển hướng
							echo "<script>alert('Thêm loại hàng thành công')</script>";
							header("Location: admin-add-product-type.php");
						}
					}
					?>

				
				<div id="main" class="col-md-12">
					<form id='addProductType' name='addProductType' action='admin-add-product-type.php' method='POST' onsubmit='return checkAddProductType();'>
						<span id='lblNULL' style='color:red; display:none;'>*: Chưa nhập/Chưa chọn</span>
						<span class='text-uppercase'>Tên loại sản phẩm: </span>
						<?php
							if(isset($_POST['btnAddProductType']))
								echo "<input type='text' name='ttxtProductName' id='ttxtProductName' value='".$_POST['ttxtProductName']."'>";
							else
								echo "<input type='text' name='ttxtProductName' id='ttxtProductName'>";
						?>
						<span id='lblProductNameTypeNULL' style='color:red; display:none;'>*</span>
						<span id='lblProductNameTypeCHAR' style='color:red; display:none;'>*Không được có ký tự lạ*</span>
						<br><br>

						<span class='text-uppercase'>Giới tính: </span>
						<select name="tslcGender" id='tslcGender'>
							<?php
								$gender = array("","Nam","Nữ");
								$genderPost = "";
								if(isset($_POST['btnAddProductType']))
									$genderPost=$_POST['tslcGender'];
								foreach ($gender as $Gender)
								if($genderPost == $Gender)
									echo "<option value='".$Gender."' selected>".$Gender."</option>";
								else
									echo "<option value='".$Gender."'>".$Gender."</option>";
							?>
						</select>
						<span id='lblGenderNULL' style='color:red; display:none;'>*</span>
						<br><br>

						<span class='text-uppercase'>Danh mục: </span> <!-- Added Category input -->
						<?php
							if(isset($_POST['btnAddProductType']))
								echo "<input type='text' name='ttxtCategory' id='ttxtCategory' value='".$_POST['ttxtCategory']."'>";
							else
								echo "<input type='text' name='ttxtCategory' id='ttxtCategory'>";
						?>
						<!-- <input type='text' name='ttxtCategory' id='ttxtCategory'> -->
						<span id='lblCategoryNULL' style='color:red; display:none;'>*</span>
						<span id='lblCategoryCHAR' style='color:red; display:none;'>*Không được có ký tự lạ</span>

						<br><br>

						<input name='btnAddProductType' type='submit' value='Thêm Loại Hàng'>
						<input type='button' value='Làm lại' onclick='Reset()'>
					</form>
				</div>

				<div id="main" class="col-md-12">
				<?php
					require_once('../DataProvider.php');

					if (isset($_POST['btnEditProductType'])) {
						// Lấy dữ liệu từ form
						$productName = $_POST['etxtProductName'];
						$gender = $_POST['eslcGender'];
						$category = $_POST['eslcCategory'];
						$productID = $_POST['etxtID'];

						// Truy vấn kiểm tra sản phẩm trùng
						$sql = "SELECT * FROM ProductType WHERE ProductTypeName LIKE '$productName' AND Gender='$gender'";
						$rs = DataProvider::executeQuery($sql);

						$isDuplicateCategory = false; // Trùng cả danh mục
						$isDuplicateOtherCategory = false; // Trùng nhưng khác danh mục
						$existingCategory = ""; // Danh mục trùng (nếu có)

						// Duyệt qua kết quả
						while ($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
							if ($row['ProductTypeID'] != $productID) { // Bỏ qua sản phẩm đang chỉnh sửa
								if ($row['Category'] == $category) {
									$isDuplicateCategory = true; // Trùng danh mục
								} else {
									$isDuplicateOtherCategory = true; // Trùng nhưng khác danh mục
									$existingCategory = $row['Category']; // Lưu danh mục khác
								}
							}
						}

						// Xử lý các trường hợp
						if ($isDuplicateCategory) {
							echo "<script>alert('Xin lỗi, ở danh mục [$category] đã có sản phẩm [$productName] dành cho giới tính [$gender]')</script>";
						} elseif ($isDuplicateOtherCategory) {
							echo "<script>alert('Xin lỗi, loại sản phẩm [$productName] đã có ở danh mục [$existingCategory]')</script>";
						} else {
							// Nếu không trùng, thực hiện cập nhật
							$sql = "UPDATE ProductType 
									SET ProductTypeName = '$productName', Gender = '$gender', Category = '$category' 
									WHERE ProductTypeID = $productID";
							DataProvider::executeQuery($sql);

							// Hiển thị thông báo và chuyển hướng (nếu cần)
							echo "<script>alert('Đã sửa thành công');</script>";
						}
					}
					?>

					<table border=1>
						<span id='lblNULL' name='lblNULL' style='color:red; display:none'>*: Chưa nhập/Chưa chọn</span>
						<tr>
							<td>Danh mục</td> <!-- Added Category Column -->
							<td>Tên loại sản phẩm</td>
							<td>Giới tính</td>
							<td></td>
							<td></td>
						</tr>
						<?php
						require_once('../DataProvider.php');
						// Fetch all product types ordered by category
						$sql = "SELECT * FROM ProductType ORDER BY Category"; 
						$rs = DataProvider::executeQuery($sql);
						
						$currentCategory = ""; // Variable to store the current category
						
						while($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
							// Check if the category has changed
							if ($row['Category'] != $currentCategory) {
								// Display category header
								// Display category header with red color and larger text
								echo "<tr><td colspan='5' style='font-weight: bold; font-size: 18px; color: red; text-transform: uppercase;'>".$row['Category']."</td></tr>";
								$currentCategory = $row['Category']; // Update the current category
							}
							
							// Display the product details under the current category
							echo "<tr>";
							echo "<form id='editProductType' name='editProductType' action='admin-edit-producttype.php' method='POST'>";
							echo "<td </td>";
							echo "<input type='hidden' name='etxtID' id='etxtID' value='".$row['ProductTypeID']."'>";
							echo "<td id='etxtProductName' name='etxtProductName'>".$row['ProductTypeName']."</td>";
							echo "<td id='eslcGender' name='eslcGender'>".$row['Gender']."</td>";
							echo "<td><input name='btnSubmit' id='btnSubmit' type='submit' value='Sửa'></td>";
							echo "</form>";

							// Add Delete Button
							echo "<form action='admin-add-product-type.php' method='POST' onsubmit='return confirm(\"Bạn chắc chắn muốn xóa loại hàng này?\");'>";
							echo "<input type='hidden' name='deleteProductTypeID' value='".$row['ProductTypeID']."'>";
							echo "<td><input type='submit' name='btnDeleteProductType' value='Xóa'></td>";
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
	<?php
		require_once('../DataProvider.php');

		// Check if the delete button was clicked
		if (isset($_POST['btnDeleteProductType'])) {
			// Get the ProductTypeID from the hidden field
			$productTypeID = $_POST['deleteProductTypeID'];

			// Check if there are any products that belong to this ProductType
			$sqlCheckProducts = "SELECT COUNT(*) FROM Product WHERE ProductTypeID = '$productTypeID'";
			$resultCheck = DataProvider::executeQuery($sqlCheckProducts);
			$rowCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
			
			if ($rowCheck['COUNT(*)'] > 0) {
				// If there are products, do not allow the deletion and show an error message
				echo "<script>alert('Không thể xóa loại sản phẩm này vì vẫn còn sản phẩm.');</script>";
			} else {
				// If no products, proceed to delete the product type
				$sql = "DELETE FROM ProductType WHERE ProductTypeID = '$productTypeID'";
				
				// Execute the query
				if (DataProvider::executeQuery($sql)) {
					echo "<script>alert('Xóa loại hàng thành công');</script>";
					header("Location: admin-add-product-type.php"); // Redirect to refresh the page
				} else {
					echo "<script>alert('Lỗi khi xóa loại hàng');</script>";
				}
			}
		}
		?>


	<!-- jQuery Plugins -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>

</body>

</html>
