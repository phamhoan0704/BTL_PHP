<?php
    include 'header.php';
    
    include "../database/connect.php";

    //Lấy dữ liệu số sp
    $search_pdt = $_GET['search_pdt'];
    $page = 0;
    $product = array();
    if($search_pdt != "") {
        $sql1 = "SELECT count(*) as 'number'
                FROM tbl_product
                where product_name like '%$search_pdt%'";
        
        $result1 = mysqli_query($conn, $sql1);
        $data1 = array();
        if(mysqli_num_rows($result1) > 0)
            while($row = mysqli_fetch_array($result1, 1))
            {
                $data1[] = $row;
            }
        $number = $data1[0]['number'];
        $page = ceil($number / 15);

        $current_page = 1;
        if(isset($_GET['page'])) {
            $current_page = $_GET['page'];
        }

        $index = ($current_page-1)*15;
        //Lấy bảng sp
        
        $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
                FROM tbl_product
                where product_name like '%$search_pdt%' 
                LIMIT $index , 15
                ";
        
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
            while($row = mysqli_fetch_array($result, 1))
            {
                $product[] = $row;
            }
            mysqli_close($conn);
    }     
?>

<!-- ------------------SEARCH--------------------------- -->
    <div class="search-container">
        <h1>Tìm kiếm</h1>
        <span><?php if($search_pdt != "") echo "Kết quả tìm kiếm cho "; ?><strong><?php echo $search_pdt; ?></strong></span>
        <div class="product-list">
            <?php
            require_once 'product_list.php';
            echo showListProduct($product, 5, -1);
            ?>
        </div>

        <ul class="pagination" style="margin: 24px, 0;">
            <?php
                for($i=1; $i<=$page; $i++) {
                    echo '<li class="page-item"><a class="page-link" href="?search_pdt='.$search_pdt.'&page='.$i.'">'.$i.'</a></li>';
                }
            ?>
            <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        document.getElementById("header_search").value = "<?php echo $search_pdt; ?>";
    </script>
</body>
</html>