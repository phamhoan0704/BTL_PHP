<?php
    include 'header.php';
    
    include "../database/connect.php";

    //Lấy dữ liệu số sp
    $search_pdt = $_GET['search_pdt'];
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
    $page = ceil($number / 12);

    $current_page = 1;
    if(isset($_GET['page'])) {
        $current_page = $_GET['page'];
    }

    $index = ($current_page-1)*12;
    //Lấy bảng sp
    $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product
            where product_name like '%$search_pdt%' 
            LIMIT $index , 12
            ";
    
    $result = mysqli_query($conn, $sql);
    $data = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $data[] = $row;
        }
        mysqli_close($conn);     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
</head>
<body>
    <div class="container">
        <h1>Tìm kiếm</h1>
        <span>Kết quả tìm kiếm cho <strong><?php echo $search_pdt; ?></strong></span>
        <div class="product-list">
            <?php
                                
                for($i=0;$i<count($data);$i++) {
                    echo '
                    <div class="product-block">
                        <div class="product__sale">
                            <span class="sale-lable">- '.$data[$i]['product_discount'].'%</span>
                        </div>
                        <a href="productdetail.php?id='.$data[$i]['product_id'].'" class="product__img" style="background-image: url(../img/product/'.$data[$i]['product_image'].');">
                        </a>
                        <div class="pdt_icon">
                            <a href="./cart.php?id='.$data[$i]['product_id'].'"><i class="fa-solid fa-cart-arrow-down"></i></a>
                        </div>
                        <div class="product__detail">
                            <a href="productdetail.php?id='.$data[$i]['product_id'].'" class="product__name">'.$data[$i]['product_name'].'</a>
                            <div class="product__price">
                                <p class="pro-price__new">'.number_format($data[$i]['product_price']).'đ</p>
                                <p class="pro-price__old">'.number_format($data[$i]['product_price_pre']).'đ</p>
                            </div>
                        </div>
                    </div>';
                    
                }

                               
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
</body>
</html>