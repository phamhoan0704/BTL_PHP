<?php
    include 'header.php';
    include "../database/connect.php";
    //Lấy sp theo Sách mới
    $sql = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_quantity, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
    FROM tbl_product;
    ";
    $result = mysqli_query($conn, $sql);
    $product_new = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $product_new[] = $row;
        }

    //Lấy sp theo Sách bán chạy
    $sql1 = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_quantity, tbl_product.product_price, tbl_product.product_price_pre, 
    (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount', 
    sum(tbl_order_detail.order_quantity) as 'tong' 
    FROM tbl_product INNER JOIN tbl_order_detail on tbl_order_detail.product_id=tbl_product.product_id 
    GROUP BY tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, product_discount
    order by tong";


    $result1 = mysqli_query($conn, $sql1);
    $product_best_selling = array();
    if (mysqli_num_rows($result1) > 0)
    while ($row = mysqli_fetch_array($result1, 1)) {
        $product_best_selling[] = $row;
    }

    //Lấy sp theo hot deals
    $sql2 = "
    SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_name, tbl_product.product_quantity, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 

    FROM tbl_product
    Order by product_discount desc;
    ";

    $result2 = mysqli_query($conn, $sql2);
    $product_hot_deals = array();
    if (mysqli_num_rows($result2) > 0)
        while ($row = mysqli_fetch_array($result2, 1)) {
            $product_hot_deals[] = $row;
        }


    mysqli_close($conn);

?>

<!-- --------------------------------------------------- -->

    <div id="home-page">
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
                <span style=" font-family: 'Glyphicons Halflings'!important;" class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#slideShow" data-slide="next">
                <span style=" font-family: 'Glyphicons Halflings'!important;" class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
        
        <div class="home-page-content">
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
                            require_once 'product_list.php';
                            echo showListProduct($product_new, 5, 13);
                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="product_category.php?id=0" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách bán chạy -->
                        <div class="product-list">
                            <?php
                            require_once 'product_list.php';
                            echo showListProduct($product_best_selling, 5, 13);
                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="product_category.php?id=0" class="btn-more">Xem thêm</a>
                        </div>
                    </div>
                    <div class="home-tab-pane">
                        <!-- Sách hot deal -->
                        <div class="product-list">
                            <?php
                            require_once 'product_list.php';
                            echo showListProduct($product_hot_deals, 5, 13);
                            ?>
                        </div>
                        <div class="home-tab-pane-btn">
                            <a href="product_category.php?id=0" class="btn-more">Xem thêm</a>
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