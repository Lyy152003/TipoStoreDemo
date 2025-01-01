<span class="category-header">Danh mục <i class="fa fa-list"></i></span>
<ul class="category-list">
        <?php
        // Kết nối với cơ sở dữ liệu
        require_once('DataProvider.php');

        // Truy vấn lên CSDL để lấy danh mục từ bảng 'producttype'
        $sql = "SELECT DISTINCT Category FROM producttype";
        $result = DataProvider::executeQuery($sql);

        // Khởi tạo mảng danh mục
        $categories = array();

        // Kiểm tra nếu có kết quả trả về từ truy vấn
        if ($result) {
            // Duyệt qua các dòng kết quả và thêm danh mục vào mảng
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row['Category'];
            }
        } else {
            echo "Không có danh mục nào trong cơ sở dữ liệu.";
        }

        // Duyệt qua các danh mục
        foreach ($categories as $category) {
            // Lấy tất cả các ProductType cho mỗi Category (loại sản phẩm trong danh mục)
            $sql = "SELECT DISTINCT ProductTypeName 
                    FROM ProductType 
                    WHERE Category='$category' 
                    ORDER BY ProductTypeName";
            $rs = DataProvider::executeQuery($sql);

            // Nếu có ProductType trong danh mục, hiển thị dropdown
            if (mysqli_num_rows($rs) > 0) {
                echo "<li class='dropdown side-dropdown'>";
                echo "<a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>$category <i class='fa fa-angle-right'></i></a>";
                echo "<div class='custom-menu'>";
                echo "<div class='row'>";
                echo "<div class='col-md-4'>";
                echo "<ul class='list-links'>";

                // Duyệt qua các ProductType và hiển thị
                while ($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                    echo "<li><a href='products.php?slcType={$row['ProductTypeName']}&slcCategory=$category'>{$row['ProductTypeName']}</a></li>";
                }

                // Đóng danh sách và các thẻ HTML
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</li>";
            }
        }
        ?>

</ul>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.category-header');
    const list = document.querySelector('.category-list');
    list.style.display = 'none';
    header.addEventListener('click', function() {
        list.style.display = (list.style.display === 'block') ? 'none' : 'block';
    });
});
</script>