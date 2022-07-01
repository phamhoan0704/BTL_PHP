<?php
include '../../database/connect.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Css/admin/product_management_ad.css">
    <link rel="stylesheet" href="../../Css/admin/tab.css">

</head>

<body>
    <?php
    $category2 = [];
    $category1 = [];
    $category = [];
    $sql_category = "SELECT tbl_category.category_id,category_name,count(product_id) as'slco' FROM `tbl_category`
     INNER join tbl_product on tbl_product.category_id = tbl_category.category_id 
     WHERE category_status=0
      GROUP by tbl_category.category_id";
   
    $query_category = mysqli_query($conn, $sql_category);
    //$li_order=mysqli_fetch_array($query_order);

    while ($row = mysqli_fetch_array($query_category)) {
        $category[] = $row;
    }
    $sql_category2 =  "SELECT tbl_category.category_id,category_name,count(product_id) as'slco' FROM `tbl_category`
    INNER join tbl_product on tbl_product.category_id = tbl_category.category_id 
    WHERE category_status=1
     GROUP by tbl_category.category_id";
    $query_category2 = mysqli_query($conn, $sql_category2);
    while ($row2 = mysqli_fetch_array($query_category2)) {
        $category2[] = $row2;
    }
    $sql_category1 =  "SELECT tbl_category.category_id,category_name,count(product_id) as'slco' FROM `tbl_category`
    INNER join tbl_product on tbl_product.category_id = tbl_category.category_id 
  
     GROUP by tbl_category.category_id";
    $query_category1 = mysqli_query($conn, $sql_category1);
    while ($row1 = mysqli_fetch_array($query_category1)) {
        $category1[] = $row1;
    }
    // var_dump($order[0]['order_id']);
    // die();
    if (isset($_POST['category_delete'])) {
        $category_id = $_POST['category_id'];
        // mysqli_query($conn,"DELETE FROM tbl_product WHERE category_id=$category_id");
        mysqli_query($conn, "DELETE FROM tbl_category WHERE category_id=$category_id");
        header('location:category_management_ad.php');
    }
    ?>

    <div class="order_management_content">

        <?php include 'home_ad.php' ?>
        <div class="order_management_main">
                <form method="POST" action="category_add_ad.php">
                <div class="home-tabs">
                    <div class="home-tab-title">
                        <div class="home-tab-item active">
                            <span>Tất cả</span>
                        </div>
                        <div class="home-tab-item">
                            <span>Đang hoạt động</span>
                        </div>
                        <div class="home-tab-item">
                            <span>Đã ẩn</span>
                        </div>
                        <div class="line">
                        </div>
                    </div>
                    <div class="home-tab-content">
                        <div class="home-tab-pane active">
                            <table>
                                <tr>
                                    <td colspan="7"><button type="submit" name="add">Thêm danh mục</button></td>
                                </tr>
                                <tr class="title_order">
                                    <td>Mã danh mục</td>
                                    <td>Tên danh mục</td>
                                    <td>Số sản phẩm</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($category1 as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><?php echo $value['category_name']  ?></td>
                                        <td><?php echo $value['slco']  ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="category_id" value="<?php echo $value['category_id'] ?>">
                                                <button type="submit" name="category_delete">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>

                            </table>

                        </div>
                        <div class="home-tab-pane">
                            <table>
                                <tr>
                                    <td colspan="7"><button type="submit" name="add">Thêm danh mục</button></td>
                                </tr>
                                <tr class="title_order">
                                    <td>Mã danh mục</td>
                                    <td>Tên danh mục</td>
                                    <td>Số sản phẩm</td>
                                    
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($category as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><?php echo $value['category_name']  ?></td>
                                        <td><?php echo $value['slco']  ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="category_id" value="<?php echo $value['category_id'] ?>">
                                                <button type="submit" name="category_delete">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>

                            </table>

                        </div>
                        <div class="home-tab-pane">
                            <table>
                               
                                <tr class="title_order">
                                    <td>Mã danh mục</td>
                                    <td>Tên danh mục</td>
                                    <td>Số sản phẩm</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($category2 as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><?php echo $value['category_name']  ?></td>
                                        <td><?php echo $value['slco']  ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="category_id" value="<?php echo $value['category_id'] ?>">
                                                <button type="submit" name="category_delete">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>

                            </table>

                        </div>
                    </div>
                </div>
            </form>
            </div>
    </div>
    <?php include 'footer_ad.php'; ?>

    <script src="../../js/home_tab.js"></script>
    <script>
        document.getElementById("header-category").style.background = "rgb(1 161 75)";
        document.getElementById("header-category").style.color = "white";
    </script>
</body>

</html>