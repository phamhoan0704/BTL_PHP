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
    <link rel="stylesheet" href="../../css/admin/product_management_ad.css">
    <link rel="stylesheet" href="../../Css/admin/tab.css">
</head>

<body>
    <?php
    //Tất cả đơn hàng
    $sql_product = "SELECT *FROM tbl_product ";
    $query_product = mysqli_query($conn, $sql_product);
    $product = [];
    while ($row = mysqli_fetch_array($query_product)) {
        $product[] = $row;
    }
    //Sản phẩm đang hoạt động
    $sql_product1 = "SELECT *FROM tbl_product where product_status=0";
    $query_product1 = mysqli_query($conn, $sql_product1);
    $product1 = [];
    while ($row = mysqli_fetch_array($query_product1)) {
        $product1[] = $row;
    }
    //Sản phẩm đã hết hàng
    $sql_product_emtity = "SELECT *FROM tbl_product where product_quantity=0";
    $query_product_emtity = mysqli_query($conn, $sql_product_emtity);
    $product_emtity = [];
    while ($row_emtity = mysqli_fetch_array($query_product_emtity)) {
        $product_emtity[] = $row_emtity;
    }
    //Sản phẩm đã ẩn
    $sql_product2 = "SELECT *FROM tbl_product where product_status=1";
    $query_product2 = mysqli_query($conn, $sql_product2);
    //$li_order=mysqli_fetch_array($query_order);
    $product2 = [];
    while ($row2 = mysqli_fetch_array($query_product2)) {
        $product2[] = $row2;
    }
    
    // var_dump($order[0]['order_id']);
    // die();
    //tim kiem san pham
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action == "search1") {
            $text_search1 = $_POST['search_txt1'];
            $sql_product_search = "SELECT * FROM tbl_product where product_name LIKE '%$text_search1%' ";
            $query_product_search = mysqli_query($conn, $sql_product_search);
            $product_search = [];
            while ($row = mysqli_fetch_array($query_product_search)) {
                $product_search[] = $row;
            }
        }
    }

    if (isset($_POST['product_delete'])) {
        $product_id = $_POST['product_id'];
        mysqli_query($conn, "Update tbl_product set product_status=1 WHERE product_id=$product_id");
        header('location:product_management_ad.php');
    }
    ?>
    <div class="order_management_content">

        <?php include 'home_ad.php' ?>
        <div class="order_management_main">
            <form method="POST" action="product_add_ad.php">
                <div class="home-tabs">
                    <div class="home-tab-title">
                    <div class="home-tab-item active">
                            <span>Tất cả</span>
                            <span><?php echo count($product);?></span>

                        </div>
                        <div class="home-tab-item active">
                            <span>Đang hoạt động</span>
                            <span><?php echo count($product1);?></span>

                        </div>
                        <div class="home-tab-item">
                            <span>Đã hết hàng</span>
                            <span><?php echo count($product_emtity);?></span>

                        </div>
                         <div class="home-tab-item active">
                            <span>Đã ẩn</span>
                            <span><?php echo count($product2);?></span>

                        </div>
                        <div class="line">
                        </div>
                    </div>
                    <!-- thêm sản phẩm -->
                    <table>
                        <tr>
                            <td colspan="7">
                                <form method="POST" action="product_add_ad.php">
                                    <button type="submit" name="add">Thêm sản phẩm</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                    <div class="home-tab-content">
                        <div class="home-tab-pane active">
                            <!-- Tìm kiếm sản phẩm -->
                            <table>
                                <tr>
                                    <td colspan=7>
                                        <form method="POST">
                                            <label for="" class="label_search">Tìm kiếm</label>
                                            <input placeholder="Nhập tên sản phẩm" id="input_search" type="" name="search_txt1" value="<?php if (isset($_POST['action'])) echo $text_search1 ?>">
                                            <button type="submit" value="search1" name="action">Tìm kiếm</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php if (isset($_POST['action']) && $_POST['action'] = "search1" && $text_search1 != "" && $product_search != []) { ?>
                                    <tr>
                                        <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> <?php echo count($product_search) ?> </span></td>
                                    </tr>
                                    <tr class="title_order">
                                        <td>Mã sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Hình ảnh</td>
                                        <td>Số lượng</td>
                                        <td>Danh mục</td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <?php foreach ($product_search as $value) : ?>
                                        <tr>

                                            <td><?php echo $value['product_id'] ?></td>
                                            <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                                            <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
                                            <td><?php echo $value['product_quantity'] ?></td>
                                            <td><?php echo $value['category_id'] ?></td>
                                            <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"] ?>">Xem chi tiết</a> </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php } else if (isset($_POST['action']) && $text_search1 != "" && $product_search == []) { ?>
                                    <tr>
                                        <td colspan="7"><?php echo "Không có kết quả phù hợp"  ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <!-- Danh sach san pham -->
                            <table>
                                <tr>
                                    <td colspan="7"><button type="submit" name="add">Thêm sản phẩm</button></td>
                                </tr>
                                <tr class="title_order">
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Hình ảnh</td>
                                    <td>Số lượng</td>
                                    <td>Danh mục</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($product as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['product_id'] ?></td>
                                        <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                                        <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
                                        <td><?php echo $value['product_quantity'] ?></td>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"] ?>">Xem chi tiết</a> </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                                <button type="submit" name="product_delete">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>


                            </table>
                        </div>
                        <div class="home-tab-pane">
                            <table>
                                <tr class="title_order">
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Hình ảnh</td>
                                    <td>Số lượng</td>
                                    <td>Danh mục</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($product1 as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['product_id'] ?></td>
                                        <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                                        <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
                                        <td><?php echo $value['product_quantity'] ?></td>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"] ?>">Xem chi tiết</a> </td>

                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                         <div class="home-tab-pane">
                            <table>
                                <tr class="title_order">
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Hình ảnh</td>
                                    <td>Số lượng</td>
                                    <td>Danh mục</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($product_emtity as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['product_id'] ?></td>
                                        <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                                        <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
                                        <td><?php echo $value['product_quantity'] ?></td>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"] ?>">Xem chi tiết</a> </td>

                                    </tr>
                                <?php endforeach ?>

                            </table>
                        </div>
                        <div class="home-tab-pane">
                            <table>
                                <tr class="title_order">
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Hình ảnh</td>
                                    <td>Số lượng</td>
                                    <td>Danh mục</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($product2 as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['product_id'] ?></td>
                                        <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                                        <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
                                        <td><?php echo $value['product_quantity'] ?></td>
                                        <td><?php echo $value['category_id'] ?></td>
                                        <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"] ?>">Xem chi tiết</a> </td>

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
    <script>
        document.getElementById("header-product").style.background = "rgb(1 161 75)";
        document.getElementById("header-product").style.color = "white";
    </script>
</body>
<script src="../../js/home_tab.js "></script>

</html>