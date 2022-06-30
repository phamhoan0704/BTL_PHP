<?php
    include 'header.php';
    include "../database/connect.php";
    if(isset($_GET)) $category_id = $_GET['id'];
       //Lấy dữ liệu danh sach category
    $sql1 = "SELECT * From tbl_category";
    
    $result1 = mysqli_query($conn, $sql1);
    $category_list = array();
    if(mysqli_num_rows($result1) > 0)
    while($row = mysqli_fetch_array($result1, 1))
    {
        $category_list[] = $row;
    }

    //Lấy name category
    $category_name="";
    for($i=0;$i<count($category_list);$i++) {
        if($category_list[$i]['category_id'] == $category_id) $category_name = $category_list[$i]['category_name'];
    }
    if($category_id == 0) $category_name = '';
    
    
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
    
    $custom_dropdown__select ='manual';
    if(isset($_GET['sort_by'])) $custom_dropdown__select = $_GET['sort_by'];

    //Lấy bảng sp
    if($category_id ==0)
        $query_product = "";
    else    $query_product = "where category_id =" . $category_id;

    switch($custom_dropdown__select)
    {
        case 'manual':
            $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product $query_product  
            LIMIT $index , 12
            ";
            break;
        case 'price-ascending':
            $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product $query_product  
            order by tbl_product.product_price
            LIMIT $index , 12
            ";
            break;
        case 'price-descending':
            $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product $query_product  
            order by tbl_product.product_price DESC
            LIMIT $index , 12
            ";
            break;
        case 'title-ascending':
            $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product $query_product  
            order by tbl_product.product_name 
            LIMIT $index , 12
            ";
            break;
        case 'title-descending':
            $sql = "SELECT tbl_product.product_id, tbl_product.product_image, tbl_product.product_quantity, tbl_product.product_name, tbl_product.product_price, tbl_product.product_price_pre, (100-round((tbl_product.product_price / tbl_product.product_price_pre)*100,0)) as 'product_discount' 
            FROM tbl_product $query_product  
            order by tbl_product.product_name DESC
            LIMIT $index , 12
            ";
            break;
    }
    
    $result = mysqli_query($conn, $sql);
    $product_list = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $product_list[] = $row;
        }

    mysqli_close($conn);        
?>

<!-- ------------------------------------------------------------- -->
    
    <div class="product-category-container">
        <div class="breadcrumb">
            <ol class="breadcrumb-arrow">
                <li><a href="home.php" target="_self">Trang chủ</a></li>
                <li><a href="" target="_self">Danh mục</a></li>
                <li>
                    <span><?php echo $category_name?></span>
                </li>
            </ol>
        </div>
        <div class="product-category-content">
            <div class="nav-menu">
                <h4>Danh mục</h4>
                <ul class="nav-menu-list">
                     <?php
                        for($i=0;$i<count($category_list);$i++) {
                            echo '<li class="nav-item"><a';
                            if($category_id == $category_list[$i]['category_id']) echo ' style="color: #01a14b;"';
                            echo ' href="product_category.php?id='.$category_list[$i]['category_id'].'">'.$category_list[$i]['category_name'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="product-category-main-content">
                <div class="main-content-heading">
                    <h1 style="border:none;">Tất cả sản phẩm</h1>
                    <div class="browse-tags">
                        <span>Sắp xếp theo:</span>
                        <span class="custom-dropdown">
                                <select id="selectBox" class="custom-dropdown__select" name="custom-dropdown__select" onchange="dropdownOption(value,<?php echo $category_id?>)">
                                    <option value="manual" 
                                        <?php 
                                        if(isset($_GET['sort_by']) )
                                            if($_GET['sort_by']=='manual') 
                                                echo 'selected'
                                    ?>>Sản phẩm nổi bật</option>
                                    <option value="price-ascending" <?php 
                                        if(isset($_GET['sort_by']) )
                                            if($_GET['sort_by']=='price-ascending') echo 'selected'?>>Giá: Tăng dần</option>
                                    <option value="price-descending" <?php 
                                        if(isset($_GET['sort_by']) )
                                            if($_GET['sort_by']=='price-descending') echo 'selected'?>>Giá: Giảm dần</option>
                                    <option value="title-ascending" <?php 
                                        if(isset($_GET['sort_by']) )
                                            if($_GET['sort_by']=='title-ascending"') echo 'selected'?>>Tên: A-Z</option>
                                    <option value="title-descending" <?php 
                                        if(isset($_GET['sort_by']) )
                                            if($_GET['sort_by']=='title-descending"') echo 'selected'?>>Tên: Z-A</option>
                                </select>
                        </span>
                    </div> 
                </div>
                
                <div class="product-list">
                    <?php
                    require_once 'product_list.php';
                    echo showListProduct($product_list, 4, -1);
                    ?>
                </div>

                <ul class="pagination" style="margin: 24px, 0;">
                    <?php
                        for($i=1; $i<=$page; $i++) {
                            echo '<li class="page-item"><a class="page-link" href="product_category.php?id='.$category_id.'&page='.$i.'">'.$i.'</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script>
        function dropdownOption(i, id)
        {
            var url = "product_category.php?id=" + id + "&&sort_by=" + i;
            window.location.href = url;
        }
    </script>