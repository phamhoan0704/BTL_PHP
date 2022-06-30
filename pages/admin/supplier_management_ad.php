<?php
include '../../Database/connect.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Css/admin/order_management_ad.css">
    <link rel="stylesheet" href="../../css/home_tab2.css">
    <link rel="stylesheet" href="../../Css/admin/tab.css">
</head>

<body>
    <?php
    $supplier=[];
    $supplier1=[];
    $supplier2=[];
    $sql_supplier = "SELECT *FROM tbl_supplier";
    $query_supplier = mysqli_query($conn, $sql_supplier);
    //$li_order=mysqli_fetch_array($query_order);

    while ($row = mysqli_fetch_array($query_supplier)) {
        $supplier[] = $row;
    }
    // var_dump($order[0]['order_id']);
    // die();

    if (isset($_POST['supplier_delete'])) {
        $supplier_id = $_POST['supplier_id'];

        mysqli_query($conn, "DELETE FROM tbl_supplier WHERE supplier_id=$supplier_id");
        header('location:supplier_management_ad.php');
    }
    ?>
    <div class="order_management_content">
        <?php include 'home_ad.php' ?>
        <form method="POST" action="supplier_add_ad.php">
            <div class=" order_management_main">
                <div class="home-tabs">
                    <div class="home-tab-title">
                        <div class="home-tab-item active">
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
                                    <td colspan="7"><button type="submit" name="add">Thêm nhà cung cấp</button></td>
                                </tr>
                                <tr class="title_order">
                                    <td>Mã nhà cung cấp</td>
                                    <td>Tên nhà cung cấp</td>
                                    <td>Địa chỉ</td>
                                    <td>Số điện thoại</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($supplier as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['supplier_id'] ?></td>
                                        <td><?php echo $value['supplier_name']  ?></td>
                                        <td><?php echo $value['supplier_address'] ?></td>
                                        <td><?php echo $value['supplier_phone'] ?></td>
                                        <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"] ?>">Xem chi tiết</a> </td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="supplier_id" value="<?php echo $value['supplier_id'] ?>">
                                                <button type="submit" name="supplier_delete">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                        <div class="home-tab-pane">
                            <table>
                               
                                <tr class="title_order">
                                    <td>Mã nhà cung cấp</td>
                                    <td>Tên nhà cung cấp</td>
                                    <td>Địa chỉ</td>
                                    <td>Số điện thoại</td>
                                    <td colspan="2"></td>
                                </tr>
                                <?php foreach ($supplier as $value) : ?>
                                    <tr>
                                        <td><?php echo $value['supplier_id'] ?></td>
                                        <td><?php echo $value['supplier_name']  ?></td>
                                        <td><?php echo $value['supplier_address'] ?></td>
                                        <td><?php echo $value['supplier_phone'] ?></td>
                                        <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"] ?>">Xem chi tiết</a> </td>
                                        
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../../js/inherit_home-tab.js"></script>

</body>

</html>