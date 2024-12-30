<!-- menu nav -->
<div class="menu-nav">
    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
    <ul class="menu-list">
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="products.php">Sản phẩm</a></li>
        <?php
                    // Lấy danh sách thương hiệu từ cơ sở dữ liệu
                $sql = "SELECT DISTINCT Brand FROM Product";
                $rs = DataProvider::executeQuery($sql);

                // Hiển thị danh sách thương hiệu trong menu
                echo "<li class='dropdown side-dropdown'>";
                echo "<a class='dropdown-toggle brand' data-toggle='dropdown' aria-expanded='true'>Thương hiệu</a>";
                echo "<div class='custom-menu custom-menu-brand'>";
                echo "<ul class='list-links'>";

                // Lặp qua từng thương hiệu và tạo liên kết
                while ($row = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                    $brand = $row['Brand'];

                    // Kiểm tra nếu tham số slcBrand trong URL trùng với thương hiệu hiện tại
                    $activeClass = (isset($_GET['slcBrand']) && $_GET['slcBrand'] == $brand) ? 'active' : '';

                    // Hiển thị liên kết cho từng thương hiệu
                    echo "<li><a href='products.php?slcBrand=$brand' class='filter-link $activeClass'>$brand</a></li>";
                }

                echo "</ul>";
                echo "</div>";
                echo "</li>";

                ?>


        <li><a href="products.php?slcGender=Nam" class="filter-link <?php echo (isset($_GET['slcGender']) && $_GET['slcGender'] == 'Nam') ? 'active' : ''; ?>">Nam</a></li>
        <li><a href="products.php?slcGender=Nữ" class="filter-link <?php echo (isset($_GET['slcGender']) && $_GET['slcGender'] == 'Nữ') ? 'active' : ''; ?>">Nữ</a></li>


    </ul>
</div>
<!-- menu nav -->