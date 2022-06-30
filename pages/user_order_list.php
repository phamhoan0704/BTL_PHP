<?php include('./header.php');
$order_list = [];
$order_list1 = [];
$order_list2 = [];
$order_list3 = [];
$order_list4 = [];
$list_product_name = [];
if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href='./log_in.php'</script>";
} else {
    $usernanme = $_SESSION['user'];
    include('../database/connect.php');
    $sql = "SELECT order_name,order_id,order_status,order_address,order_date,order_total
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme' ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $order_list[] = $row;
    }
    $sql1 = "SELECT order_name,order_id,order_status,order_address,order_date,order_total
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme' and order_status=2; ";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $order_list1[] = $row1;
    }
    $sql2 = "SELECT order_name,order_id,order_status,order_address,order_date,order_total
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme' and order_status=3; ";
    $result2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $order_list2[] = $row2;
    }
    $sql3 = "SELECT order_name,order_id,order_status,order_address,order_date,order_total
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme' and order_status=4; ";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $order_list3[] = $row3;
    }
    $sql4 = "SELECT order_name,order_id,order_status,order_address,order_date,order_total
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme' and order_status=5; ";
    $result4 = mysqli_query($conn, $sql4);
    while ($row4 = mysqli_fetch_assoc($result4)) {
        $order_list4[] = $row4;
    }
    if (isset($_POST['order_delete'])) {
        $order_delete_id = $_POST['order_del_id'];
        mysqli_query($conn, "UPDATE tbl_order SET order_status=5 where order_id=$order_delete_id");
        //header('location:user_order_list.php');
        echo "<script> window.location.href='./user_order_list.php'</script>";
          
    }
} ?>

<div class="user_order_container">
    <div class="left_menu">
        <?php include('menuleft.php'); ?>
    </div>
    <div class="box_infor">
        <div class="box_inforx">
            <div class="order_list_box">
                <div class="inherit_home-tabs">
                    <div class="inherit_home-tab-title">
                        <div class="inherit_home-tab-item active">
                            <div class="icon_order">
                                <img src="../img/icon/order.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đặt hàng</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">

                            <div class="icon_order">
                                <img src="../img/icon/pack.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Chuẩn bị hàng</span>
                            </div>

                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/delivery.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đang giao</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/delivery_success.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Giao hàng thành công</span>
                            </div>
                        </div>
                        <div class="inherit_home-tab-item">
                            <div class="icon_order">
                                <img src="../img/icon/order.png" alt="">
                            </div>
                            <div class="status_order">
                                <span>Đã hủy</span>
                            </div>
                        </div>
                        <div class="line">
                        </div>
                    </div>
                    <div class="inherit_home-tab-content">
                        <div class="inherit_home-tab-pane active">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <?php if (sizeof($order_list) != null)
                                    foreach ($order_list as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">

                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <?php if (sizeof($order_list1) != null)
                                    foreach ($order_list1 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>
                                        <td style="width:50px">
                                            <form method="POST">
                                                <input type="hidden" name="order_del_id" value="<?php echo $item['order_id'] ?>">
                                                <button class="btnhuy" type="submit" name="order_delete">Hủy đơn</button>
                                            </form>
                                        </td>
                                    </tr><?php endforeach ?>
                            </table>

                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                <?php if (sizeof($order_list2) != null)
                                    foreach ($order_list2 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <tr class="br">
                                    <th>Đơn hàng</th>
                                    <th>Người nhận</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th></th>


                                </tr>
                                <?php if (sizeof($order_list3) != null)
                                    foreach ($order_list3 as $item) :
                                ?>
                                    <tr class="br">
                                        <?php
                                        // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                        //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                        //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                        //     $list_product_name[] = $row;
                                        // } 
                                        ?>
                                        <td><?php echo $item['order_id'] ?></td>
                                        <td><?php echo $item['order_name'] ?></td>
                                        <td><?php echo $item['order_date'] ?></td>
                                        <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                        <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>


                                    </tr><?php endforeach ?>
                            </table>
                        </div>
                        <div class="inherit_home-tab-pane">
                            <table id="tb1">
                                <form>
                                    <tr class="br">
                                        <th>Đơn hàng</th>
                                        <th>Người nhận</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                    <?php if (sizeof($order_list4) != null)
                                        foreach ($order_list4 as $item) : ?>

                                        <tr class="br">
                                            <?php
                                            // while ($row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT product_name FROM tbl_product
                                            //  INNER join tbl_order_detail on tbl_product.product_id =tbl_order_detail.product_id
                                            //   WHERE tbl_order_detail.order_id='$orderid;"))) {
                                            //     $list_product_name[] = $row;
                                            // } 
                                            ?>
                                            <td><?php echo $item['order_id'] ?></td>
                                            <td><?php echo $item['order_name'] ?></td>
                                            <td><?php echo $item['order_date'] ?></td>
                                            <td><?php echo number_format($item['order_total'], 0, '.', ',') . 'đ ' ?></td>
                                            <td style="width:50px;"><a href="./order_detail.php?id=<?php echo $item['order_id'] ?>"><button class="btn">Xem chi tiết</button></a></td>

                                        </tr><?php endforeach ?>
                                    <form>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/inherit_home-tab.js"></script>
</body>

<?php include('./footer.php'); ?>