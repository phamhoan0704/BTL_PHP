<?php
    include 'header.php';
    include "../database/connect.php";
    $category_id = 0;
    if(isset($_GET)) $category_id = $_GET['id'];
       //Lấy dữ liệu category
    $sql1 = "SELECT * From tbl_category";
    
    $result1 = mysqli_query($conn, $sql1);
    $data1 = array();
    if(mysqli_num_rows($result1) > 0)
    while($row = mysqli_fetch_array($result1, 1))
    {
        $data1[] = $row;
    }

    //Lấy name category
    $category_name="";
    for($i=0;$i<count($data1);$i++) {
        if($data1[$i]['category_id'] == $category_id) $category_name = $data1[$i]['category_name'];
    }
    if($category_id == 0) $category_name = 'Tất cả sản phẩm';
    
    
    //Lấy dữ liệu số sp
    if($category_id ==0)
            $sql2 = "SELECT count(*) as 'number'
            FROM tbl_product";
    else    $sql2 = "SELECT count(*) as 'number'
            FROM tbl_product
            where category_id = $category_id";
    
    $result2 = mysqli_query($conn, $sql2);
    $data2 = array();
    if(mysqli_num_rows($result2) > 0)
        while($row = mysqli_fetch_array($result2, 1))
        {
            $data2[] = $row;
        }
    $number = $data2[0]['number'];
    $page = ceil($number / 12);

    $current_page = 1;
    if(isset($_GET['page'])) {
        $current_page = $_GET['page'];
    }
    $index = ($current_page-1)*12;
    
    // $custom_dropdown__select ='manual';
    // if(isset($_GET['custom-dropdown__select'])) $custom_dropdown__select = $_GET['custom-dropdown__select'];

    // switch($custom_dropdown__select)
    // {
    //     case 'manual':
    //         $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    //         FROM tbl_product
    //         where category_id = $category_id 
    //         LIMIT $index , 3
    //         ";
    //         break;
    //     case 'price-ascending':
    //         $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    //         FROM tbl_product
    //         where category_id = $category_id 
    //         order by tbl_product.product_price
    //         LIMIT $index , 3
    //         ";
    //         break;
    // }
    //Lấy bảng sp
    if($category_id ==0)
        $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
                FROM tbl_product
                LIMIT $index , 12
                ";
    else    $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product
            where category_id = $category_id 
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
<body>
    
    <div class="container">
        <div class="breadcrumb">
            <ol class="breadcrumb-arrow">
                <li><a href="home.php" target="_self">Trang chủ</a></li>
                <li><a href="" target="_self">Danh mục</a></li>
                <li>
                    <span><?php echo $category_name?></span>
                </li>
            </ol>
        </div>
        <div class="content">
            <div class="nav-menu">
                <h4>Danh mục</h4>
                <ul class="nav-menu-list">
                     <?php
                        for($i=0;$i<count($data1);$i++) {
                            echo '<li class="nav-item"><a href="product_category.php?id='.$data1[$i]['category_id'].'">'.$data1[$i]['category_name'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="main-content">
                <div class="main-content-heading">
                    <h1>Tất cả sản phẩm</h1>
                    <!-- <div class="browse-tags">
                        <span>Sắp xếp theo:</span>
                        <span class="custom-dropdown">
                            <form action="" method="get">
                                <select class="custom-dropdown__select" name="custom-dropdown__select">
                                    <option value="manual" <?php if($custom_dropdown__select='manual') echo 'selected'?>>Sản phẩm nổi bật</option>
                                    <option value="price-ascending" <?php if($custom_dropdown__select='price-ascending') echo 'selected'?>>Giá: Tăng dần</option>
                                    <option value="price-descending"<?php if($custom_dropdown__select='price-descending') echo 'selected'?>>Giá: Giảm dần</option>
                                    <option value="title-ascending" <?php if($custom_dropdown__select='title-ascending') echo 'selected'?>>Tên: A-Z</option>
                                    <option value="title-descending" <?php if($custom_dropdown__select='title-descending') echo 'selected'?>>Tên: Z-A</option>
                                </select>
                            </form>
                        </span>
                    </div> -->
                </div>
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
                            echo '<li class="page-item"><a class="page-link" href="product_category.php?id='.$category_id.'&page='.$i.'">'.$i.'</a></li>';
                        }
                    ?>
                    <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                </ul>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>

</body>

</html>