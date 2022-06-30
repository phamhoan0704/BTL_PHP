<?php
    include "../database/connect.php";
    session_start();
    $user_active = false;
    $total = 0;
    // $_SESSION['user'] = 'moi12345';
    if(isset($_SESSION['user'])) 
    {
        // echo $_SESSION['user'];
        $user_active=true;
        $user_name = $_SESSION['user'];
        // Lây dữ liệu product ở cart
        $sql = " SELECT tbl_product.product_image, tbl_product.product_id, tbl_product.product_name, tbl_product.product_price, 
        tbl_cart_detail.product_amount
                From tbl_cart 
                inner join tbl_user on tbl_user.user_id = tbl_cart.user_id 
                inner join tbl_cart_detail on tbl_cart.cart_id = tbl_cart_detail.cart_id 
                inner join tbl_product on tbl_product.product_id = tbl_cart_detail.product_id 
                where user_name ='$user_name';";

        $result = mysqli_query($conn, $sql);
        $data = array();
        if(mysqli_num_rows($result)>0)
            while($row = mysqli_fetch_array($result, 1))
            {
                $data[] = $row;
            }      
         

        //Lấy dữ liệu total cart
        $sql2 = "SELECT count(*) as 'total' From tbl_cart 
        inner join tbl_user on tbl_user.user_id = tbl_cart.user_id 
        inner join tbl_cart_detail on tbl_cart.cart_id = tbl_cart_detail.cart_id 
        where user_name ='$user_name';";
                    
        $result2 = mysqli_query($conn, $sql2);
        $data2 = array();
        if(mysqli_num_rows($result2) > 0)
            while($row = mysqli_fetch_array($result2, 1))
            {
                $data2[] = $row;
            }
        $total = $data2[0]['total'];  
    } 
               

    //Lấy dữ liệu category
    $sql1 = "SELECT * From tbl_category";
                    
    $result1 = mysqli_query($conn, $sql1);
    $data1 = array();
    if(mysqli_num_rows($result1) > 0)
        while($row = mysqli_fetch_array($result1, 1))
        {
            $data1[] = $row;
        }



    
    mysqli_close($conn);

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//theme.hstatic.net/200000287623/1000800165/14/favicon.png?v=126" type="image/png" />
    <title>Công ty Cổ phần xuất bản và truyền thông Trí Tuệ</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   

    
    <!-- ---------------------------------------------------------------------- -->
    <!-- Link CSS header -->
    <link rel="stylesheet" href="../css/header.css">
    <!-- Link CSS product -->
    <link rel="stylesheet" href="../css/product_list.css">
    <!-- Link CSS Homepage -->
    <link rel="stylesheet" href="../css/home.css">
    <!-- CSS order detail -->
    <link rel="stylesheet" href="../css/order_detail_style.css">
    <!--  -->
    <!-- product category -->
    <link rel="stylesheet" href="../css/product_category.css">
    <!-- CSS Footer -->
    <link rel="stylesheet" href="../css/footer.css">

    <link rel="stylesheet" href="../css/search_page.css">

    <!-- <link rel="stylesheet" href="../font/fontawesome-free-6.1.1-web/css/all.css"> -->

    <link rel="stylesheet" href="../css/cart_style.css">

    <link rel="stylesheet" href="../css/order_style.css">

    <!-- link css login register -->
    <link rel="stylesheet" href="../css/productdetail.css">

    
    <link rel="stylesheet" href="../css/log_in.css">
    
    <link rel="stylesheet" href="../css/menuleft.css">
    
    
    <link rel="stylesheet" href="../css/user_order_list.css">
    <link rel="stylesheet" href="../css/productdetail.css">
    
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/information.css">
    <link rel="stylesheet" href="../font/fontawesome/css/all.css">
    <link rel="stylesheet" href="../css/home_tab.css">
    <link rel="stylesheet" href="../css/changepassword.css">
</head>

<body>
<div id="body" style="font-family: 'Open Sans', sans-serif!important;box-sizing: border-box;margin: 0; padding: 0;">
    <div id="header">
        <div class="site-topbar">
            <div class="site-topbar__container">
                <div class="site-topbar__text">
                    Công ty cổ phần xuất bản và truyền thông Trí Tuệ
                </div>
                <div class="site-topbar__user<?=$user_active?"active":""?>">
                    <a href="information.php" class="site-topbar__user-name">Xin chào : <?php echo $_SESSION['user'];?></a>
                    <span class="sep">|</span>
                    <a href="log_out.php" class="site-topbar__logout">Đăng xuất</a>
                </div>
                <div class="site-topbar__user<?=$user_active?"":"active"?>">
                    <a href="log_in.php" class="site-topbar__user-name">Đăng nhập </a>
                    <span class="sep">|</span>
                    <a href="register.php" class="site-topbar__logout"> Đăng kí</a>

                </div>
            </div>
        </div>

        <div class="site-header-container">
            <div class="site-header">
                <div class="site-header__logo">
                    <a href="home.php">
                        <img src="../img/icon/logo.jpg" alt="" class="img-logo">
                    </a>
                </div>
                <div class="site-header__search-wrap">
                    <form action="search_page.php" method="get">
                        <div class="header__search">
                            <input type="text" class="header__search-input" placeholder="Tìm kiếm" name="search_pdt" id="header_search">
                            <button type="submit" class="header__search-btn">
                                <svg class="header__search-icon" height="64px" id="SVGRoot" version="1.1" viewBox="0 0 64 64" width="56px" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><defs id="defs3848"/><g id="layer1"><g id="g5183" style="stroke:white" transform="translate(25.5,-27)"><circle class="fil0 str1" cx="0.73810571" cy="53.392174" id="circle15" r="20.063322" style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke:white;stroke-width:2.00005412;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision"/><line class="fil0 str2" id="line25" style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke: white;stroke-width:3.99974346;stroke-linecap:round;stroke-linejoin:round;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision" x1="15.617603" x2="30.305107" y1="68.559662" y2="83.151169"/><path class="fil0 str0" d="m -12.701441,53.392174 c 0,-7.391751 6.047795,-13.439547 13.43954602,-13.439547" id="path281" style="clip-rule:evenodd;fill:none;fill-rule:evenodd;stroke:white;stroke-width:2.00005412;stroke-linecap:round;stroke-linejoin:round;image-rendering:optimizeQuality;shape-rendering:geometricPrecision;text-rendering:geometricPrecision"/></g></g></svg>
                                <!-- <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i> -->
                            </button>
                        </div>
                    </form>
                </div>
                <a href="cart_view.php" class="site-header__cart-container">
                    <div class="site-header__cart">
                        <div class="header__cart-wrap">
                            <i class="header__cart-icon fa fa-solid fa-cart-plus" style="font-family:Font Awesome 6 Free !important;"></i>
                            <span class="header__cart-notice"><?php echo $total?></span>
                            <div class="header__cart-list">
                                <div class="header__cart-list-heading">
                                    <span>Sản Phẩm Mới Thêm</span>
                                </div>
                                <ul class="header__cart-list-item">
                                    <!-- Cart item -->
                                    <?php
                                        if($total > 0) 
                                        {
                                            for($i=0;$i<count($data);$i++) {
                                                echo 
                                                '<li class="header__cart-item">
                                                    <a href="productdetail.php?id='.$data[$i]['product_id'].'" class="header__cart-item-link">
                                                        <div class="header__cart-img-block">
                                                        <img src="../img/product/'.$data[$i]['product_image'].'" alt="'.$data[$i]['product_name'].'" class="header__cart-img">
                                                        </div>
                                                        <h5 class="header__cart-item-name">'.$data[$i]['product_name'].'</h5>
                                                        <span class="header__cart-item-price">'.number_format($data[$i]['product_price']).' x '.$data[$i]['product_amount'].'</span>
                                                    </a>
                                                </li>';  
                                            }
                                        }
                                    ?>
                                    
                                </ul>
                                <div class="text-mini-cart">
                                    <span class="text-left">Tổng tiền</span>
                                    <?php
                                        $tong = 0;
                                        if($total > 0) 
                                        for($i=0;$i<count($data);$i++) {
                                            $tong = $tong + $data[$i]['product_price']*$data[$i]['product_amount'];
                                        }
                                        echo '<span class="cart-block-total">'.number_format($tong).'đ</span>';
                                    ?>
                                    
                                </div>
                                <div class='cart-check-mini'>
                                    <a class='cart-button' href='order.php'>
                                        <span>Thanh toán 
                                            <i class='fa fa-chevron-right'></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="header__cart-info">
                            <span class="top-cart">Giỏ hàng</span>
                            <span class="cart_quantity"><?php echo $total?></span> sản phẩm
                        </p>
                    </div>

                </a>
            </div>
        </div>

        <div class="site-nav">
            <ul class="header__nav">
                <li class="header__nav-item">
                    <a href="home.php" class="header__nav-item-link">Trang chủ</a>
                </li>
                <li class="header__nav-item">
                    <a href="product_category.php?id=0" class="header__nav-item-link">Sản phẩm</a>
                    <ul class="header__secondary-nav">
                        <?php
                            for($i=0;$i<count($data1);$i++) {
                                echo '<li class="secondary-nav-item"><a class="secondary-nav-item-link" href="product_category.php?id='.$data1[$i]['category_id'].'">'.$data1[$i]['category_name'].'</a></li>';
                            }
                        ?>
                    </ul>
                </li>
                <li class="header__nav-item">
                    <a href="" class="header__nav-item-link">Tin tức</a>
                </li>
                <li class="header__nav-item">
                    <a href="about.php" class="header__nav-item-link">About</a>
                </li>
                <li class="header__nav-item">
                    <a href="contact.php" class="header__nav-item-link">Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>