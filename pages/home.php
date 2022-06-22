<?php

    include 'header.php';
    include "../database/connect.php";
    //Lấy sp theo Sách mới
    $sql = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    FROM tbl_product;
    ";
    $result = mysqli_query($conn, $sql);
    $data = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $data[] = $row;
        }

    //Lấy sp theo Sách bán chạy
    $sql1 = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, 
    (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount', 
    sum(tbl_order_detail.order_quantity) as 'tong' 
    FROM tbl_product INNER JOIN tbl_order_detail on tbl_order_detail.product_id=tbl_product.product_id 
    GROUP BY tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, product_discount
    order by tong";


$result1 = mysqli_query($conn, $sql1);
$data1 = array();
if (mysqli_num_rows($result1) > 0)
    while ($row = mysqli_fetch_array($result1, 1)) {
        $data1[] = $row;
    }


    $sql2 = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 

    FROM tbl_product
    Order by product_discount desc;
    ";

$result2 = mysqli_query($conn, $sql2);
$data2 = array();
if (mysqli_num_rows($result2) > 0)
    while ($row = mysqli_fetch_array($result2, 1)) {
        $data2[] = $row;
    }


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<body>

    <div id="main">
        <div class="home-hero-container">
        <div id="slideShow" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#slideShow" data-slide-to="0" class="active"></li>
                    <li data-target="#slideShow" data-slide-to="1"></li>
                    <li data-target="#slideShow" data-slide-to="2"></li>
                    <li data-target="#slideShow" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="../img/Slide/slideshow_1.jpg" alt="">
                    </div>

                    <div class="item">
                        <img src="../img/Slide/slideshow_2.jpg" alt="">
                    </div>

                    <div class="item">
                        <img src="../img/Slide/slideshow_3.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="../img/Slide/slideshow_4.jpg" alt="">
                    </div>
                </div>


                <!-- Left and right controls -->
                <a class="left carousel-control" href="#slideShow" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#slideShow" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>
        <div class="content">
            <div class="home-policy">
                <div class="home-policy-list">
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_1.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            ƯU ĐÃI<br>VẬN CHUYỂN
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_2.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            THỂ LOẠI SÁCH<br>PHONG PHÚ
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_3.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            KHUYẾN MẠI<br>HẤP DẪN
                        </div>
                    </div>
                    <div class="home-policy-item">
                        <div class="home-policy-item_icon">
                            <img src="../img/policy/hpl_icon_4.jpg" alt="Uu dai van chuyen">
                        </div>
                        <div class="home-policy-item_info">
                            HOTLINE<br>03 2838 3979<br>03 3319 3979
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-tabs">
                <div class="home-tab-title">
                    <div class="home-tab-item active">
                        <span>SÁCH MỚI</span>
                    </div>
                    <div class="home-tab-item">
                        <span>SÁCH BÁN CHẠY</span>
                    </div>
                    <div class="home-tab-item">
                        <span>HOT DEAL</span>
                    </div>
                    <div class="line"></div>
                </div>


                <!-- Tab content -->
                <div class="home-tab-content">
                    <!-- Sách mới -->
                    <div class="home-tab-pane active">
                        <div class="product-list">
                            <?php

                                for($i=0;$i<count($data);$i++) {
                                    echo '

                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- ' . $data[$i]['product_discount'] . '%</span>
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
                                    if($i == 14) break;
                                }


                            ?>
                            <!-- <div class="product-block">
                                <div class="product__sale">
                                    <span class="sale-lable">15%</span>
                                </div>
                                <a href="" class="product__img" style="background-image: url(./assets/img/product/product01.jpg);">
                                </a>
                                <div class="product__detail">
                                    <a class="product__name">Xưởng phép thuật - Tập 1</a>
                                    <div class="product__price">
                                        <p class="pro-price__new">42,000đ</p>
                                        <p class="pro-price__old">50,000đ</p>
                                    </div>
                                </div>
                            </div>

                            -->

                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="product_category.php?id=0" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách bán chạy -->
                        <div class="product-list">
                            <?php
                            for ($i = 0; $i < count($data1); $i++) {
                                echo '
                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- ' . $data1[$i]['product_discount'] . '%</span>
                                        </div>

                                        <a href="productdetail.php?id='.$data1[$i]['product_id'].'" class="product__img" style="background-image: url(../img/product/'.$data1[$i]['product_image'].');">
                                        </a>

                                        <div class="pdt_icon">
                                        <a href="./cart.php?id='.$data1[$i]['product_id'].'"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                        </div>
                                        <div class="product__detail">
                                            <a href="productdetail.php?id='.$data1[$i]['product_id'].'" class="product__name">'.$data1[$i]['product_name'].'</a>
                                            <div class="product__price">
                                                <p class="pro-price__new">'.number_format($data1[$i]['product_price']).'đ</p>
                                                <p class="pro-price__old">'.number_format($data1[$i]['product_price_pre']).'đ</p>
                                            </div>
                                        </div>
                                    </div>';
                                    if($i == 14) break;
                                }


                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách hot deal -->
                        <div class="product-list">
                            <?php
                            for ($i = 0; $i < count($data2); $i++) {
                                echo '
                                    <div class="product-block">
                                        <div class="product__sale">
                                            <span class="sale-lable">- ' . $data2[$i]['product_discount'] . '%</span>
                                        </div>

                                        <a href="productdetail.php?id='.$data2[$i]['product_id'].'" class="product__img" style="background-image: url(../img/product/'.$data2[$i]['product_image'].');">
                                        </a>

                                        <div class="pdt_icon">
                                        <a href="./cart.php?id='.$data2[$i]['product_id'].'"><i class="fa-solid fa-cart-arrow-down"></i></a>
                                        </div>
                                        <div class="product__detail">
                                            <a href="productdetail.php?id='.$data2[$i]['product_id'].'" class="product__name">'.$data2[$i]['product_name'].'</a>
                                            <div class="product__price">
                                                <p class="pro-price__new">'.number_format($data2[$i]['product_price']).'đ</p>
                                                <p class="pro-price__old">'.number_format($data2[$i]['product_price_pre']).'đ</p>
                                            </div>
                                        </div>
                                    </div>';
                                    if($i == 16) break;
                                    
                                }


                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="home-new-banner">
            <div class="hnb-list">
                <div class="hnb-item">
                    <a href="" class="hnb-item-link">
                        <img class="hnb-item-img " src="../img/new-banner/hnb_img_2.jpg " alt=" ">
                    </a>
                </div>
                <div class="hnb-item ">
                    <a href=" " class="hnb-item-link ">
                        <img class="hnb-item-img " src="../img/new-banner/hnb_img_1.jpg " alt=" ">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="../js/home_tab.js "></script>
</body>

</html>