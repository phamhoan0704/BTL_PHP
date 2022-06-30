<?php
include '../../database/connect.php'

?>
<?php
$author = [];
$author1 = [];
$author2 = [];
$sql_author = " SELECT tbl_author.author_id, author_name,count(product_id) as sotp FROM `tbl_author`
 INNER join tbl_product on tbl_product.author_id = tbl_author.author_id 
  GROUP by tbl_author.author_id;";
$query_author = mysqli_query($conn, $sql_author);
//$li_order=mysqli_fetch_array($query_order);

while ($row = mysqli_fetch_array($query_author)) {
    $author[] = $row;
}
$sql_author1 = " SELECT tbl_author.author_id, author_name,count(product_id) as sotp FROM `tbl_author`
INNER join tbl_product on tbl_product.author_id = tbl_author.author_id 
where author_status=0
 GROUP by tbl_author.author_id;";
$query_author1 = mysqli_query($conn, $sql_author1);
//$li_order=mysqli_fetch_array($query_order);
while ($row1 = mysqli_fetch_array($query_author1)) {
    $author1[] = $row1;
}
$sql_author2 = " SELECT tbl_author.author_id, author_name,count(product_id) as sotp FROM `tbl_author`
INNER join tbl_product on tbl_product.author_id = tbl_author.author_id 
where author_status=1
 GROUP by tbl_author.author_id;";
$query_author2 = mysqli_query($conn, $sql_author2);
//$li_order=mysqli_fetch_array($query_order);

while ($row2 = mysqli_fetch_array($query_author2)) {
    $author2[] = $row2;
}
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action == "seach1") {
        $text_search1 = $_POST['search_txt1'];
       var_dump($text_search1);
       die();
        $sql_search = " SELECT tbl_author.author_id, author_name,count(product_id) as sotp FROM `tbl_author`
        INNER join tbl_product on tbl_product.author_id = tbl_author.author_id 
        Where  author_name LIKE '%$text_search1%'
         GROUP by tbl_author.author_id;";
        $author_search = [];
        while ($row = mysqli_fetch_array(mysqli_query($conn, $sql_search))) {
            $author_search[] = $row;
        }
    }
}
if (isset($_POST['author_delete'])) {
    $category_id = $_POST['author_id'];
    // mysqli_query($conn,"DELETE FROM tbl_product WHERE category_id=$category_id");
    mysqli_query($conn, "DELETE FROM tbl_author WHERE author_id=$author_id");
    header('location:author_management_ad.php');
}
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
    <div class="order_management_content">

        <?php include 'home_ad.php' ?>
        <div class="order_management_main">
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
                    <div class="line"></div>
                </div>
                <!-- Thêm tác giả -->
                <table>
                    <tr>
                        <td colspan="7">
                            <form method="POST" action="author_add_ad.php">
                                <button type="submit" name="add">Thêm tác giả</button>
                            </form>
                        </td>
                    </tr>
                </table>
                <div class="home-tab-content">
                    <div class="home-tab-pane active">

                        <!-- tìm kiếm -->
                        <table>
                            <tr>
                                <td colspan=7>
                                    <form method="POST">
                                        <label for="" class="label_search">Tìm kiếm</label>
                                        <input placeholder="Nhập tên tác giả" id="input_search" type="" name="search_txt1" value="<?php if (isset($_POST['action'])) echo $text_search1 ?>">
                                        <button type="submit" value="search1" name="action">Tìm kiếm</button>
                                    </form>
                                </td>
                            </tr>
                            <?php if (isset($_POST['action']) && $_POST['action'] = "search1" && $text_search1 != "" && $author_search != []) { ?>
                                <tr>
                                    <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> <?php echo count($author_search) ?> </span></td>
                                </tr>
                                <tr class="title_order">
                                    <td>Mã tác giả</td>
                                    <td>Tên tác giả</td>
                                    <td>Số tác phẩm</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($author_search as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['author_id'] ?></td>
                                        <td><?php echo $value['author_name']  ?></td>
                                        <td> <?php echo  $value['sotp'] ?> </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php } else if (isset($_POST['action']) && $text_search1 != "" && $author_search == []) { ?>
                                <tr>
                                    <td colspan="7"><?php echo "Không có kết quả phù hợp"  ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <!-- tất cả tác giả -->
                    <table>
                        <tr class="title_order">
                            <td>Mã tác giả</td>
                            <td>Tên tác giả</td>
                            <td>Số tác phẩm</td>
                            <td colspan="2"></td>
                        </tr>
                        <?php foreach ($author as $value) : ?>
                            <tr>
                                <td><?php echo $value['author_id'] ?></td>
                                <td><?php echo $value['author_name']  ?></td>
                                <td> <?php echo  $value['sotp'] ?> </td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="author_id" value="<?php echo $value['author_id'] ?>">
                                        <button type="submit" name="author_delete">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <div class="home-tab-pane">
                    <form method="POST" action="author_add_ad.php">
                        <table>

                            <tr class="title_order">
                                <td>Mã tác giả</td>
                                <td>Tên tác giả</td>
                                <td>Số tác phẩm</td>
                                <td colspan="2"></td>
                            </tr>
                            <?php foreach ($author1 as $value) : ?>
                                <tr>
                                    <td><?php echo $value['author_id'] ?></td>
                                    <td><?php echo $value['author_name']  ?></td>
                                    <td> <?php echo  $value['sotp'] ?> </td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="author_id" value="<?php echo $value['author_id'] ?>">
                                            <button type="submit" name="author_delete">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>

                    </form>
                </div>
                <div class="home-tab-pane">
                    <form method="POST" action="author_add_ad.php">
                        <table>

                            <tr class="title_order">
                                <td>Mã tác giả</td>
                                <td>Tên tác giả</td>
                                <td>Số tác phẩm</td>
                                <td colspan="2"></td>
                            </tr>
                            <?php foreach ($author2 as $value) : ?>
                                <tr>
                                    <td><?php echo $value['author_id'] ?></td>
                                    <td><?php echo $value['author_name']  ?></td>
                                    <td> <?php echo  $value['sotp'] ?> </td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="author_id" value="<?php echo $value['author_id'] ?>">
                                            <button type="submit" name="author_delete">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="../../js/home_tab.js "></script>

</body>

</html>