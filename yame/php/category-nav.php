<span class="category-header">Danh mục <i class="fa fa-list"></i></span>
<ul class="category-list">
        <?php
        // Truy vấn lên CSDL
        require_once('DataProvider.php');

        // Mảng danh mục
        $categories = array("Chăm sóc da mặt", "Đồ dùng cá nhân", "Chăm sóc cơ thể", "Nước hoa");

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