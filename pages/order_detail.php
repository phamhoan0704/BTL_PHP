
<?php  
   include 'header.php';
    include '../database/connect.php';

    $od_id=$_GET['id'];
    $query_order_detail=mysqli_query($conn,"SELECT* FROM tbl_order WHERE order_id=$od_id");
    $order_result=mysqli_fetch_array($query_order_detail);
    $sql_order_detail="SELECT *FROM tbl_order_detail INNER JOIN tbl_product 
    ON tbl_product.product_id=tbl_order_detail.product_id
    WHERE order_id=$od_id";
    $order_detail=mysqli_query($conn,$sql_order_detail);
    while ($row = mysqli_fetch_array($order_detail)){
        $pdt_detail[] = $row;
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="order_detail_container">        
        <div class="order_detail_customer">
            <h1>Thông tin người nhận</h1>
            <table>
                <tr>
                    <td class="">Họ tên:</td>
                    <td class="">
                        <p><?php echo $order_result['order_name'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="">Email:</td>
                    <td class="">
                        <p><?php echo $order_result['order_email'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td class="">Số điện thoại:</td>
                    <td class="">
                        <p><?php echo $order_result['order_phone'] ?></p>
                   </td>
                </tr>
                <tr>
                    <td class="">Địa chỉ:</td>
                    <td class="">
                        <p><?php echo $order_result['order_address'] ?></p>
                   </td>
                </tr>
                <tr>
                    <td class="">Ghi chú:</td>
                    <td class="">
                        <p><?php echo $order_result['order_note'] ?></p>
                   </td>
                </tr>
            </table>
        </div>
        <!-- <div class="order_status">
            <h1>Trạng thái đơn hàng </h1>
            <table>
                <tr>
                    <td class="order_status_date"><p>2/5/2022</p> </td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/shopping-bag.png" alt="">
                        <p>Đặt hàng</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>3/5/2022</p></td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/pack.png" alt="">
                        <p>Đang chuẩn bị hàng</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>3/5/2022</p> </td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/delivery-truck.png" alt="">
                        <p>Đơn hàng đang được vận chuyển</p>
                    </td>
                </tr>
                <tr>
                    <td class="order_status_date"><p>5/5/2022</p></td>
                    <td class="order_stutus_detail">
                        <img src="../img/icon/accept.png" alt="">
                        <p>Giao hàng thành công</p>
                    </td>
                </tr>

            </table>
        </div> -->
        <div class="order_status">
        <h1>Chi tiết đơn hàng </h1>
            <table>
                <tr>
                    <td class=""><img src="../img/icon/shopping-bag.png" alt=""></td>
                    <td>Ngày đặt hàng:</td>
                    <td ><?php echo $order_result['order_date']?></td>
                </tr>
                <tr>
                    <td class=""><img src="../img/icon/money.png" alt=""></td>
                    <td>Thanh toán:</td>
                    <td ><?php
                            if($order_result['order_payment']==1){?>
                            Thanh toán qua tài khoản
                                <?php }?>
                            <?php if($order_result['order_payment']==2){  ?>
                                Thanh toán khi nhận hàng
                            <?php }?></td>
                </tr>
                <tr>
                <td><img src="../img/icon/accept.png" alt=""></td>
                <td>Tình trạng thanh toán:</td>
                <td><?php
                            if($order_result['order_payment_status']==1){?>
                            Chưa thanh toán
                                <?php }?>
                            <?php if($order_result['order_payment_status']==2){  ?>
                            Đã thanh toán
                            <?php }?>
                   </td>
                </tr>
                <tr>
                    <!-- <td class=""><img src="../img/icon/shopping-bag.png" alt=""></td> -->
                    <td > <?php if($order_result['order_status']==1){  ?>
                                <img src="../img/icon/order.png" alt="">
                            <?php }?>
                        <?php if($order_result['order_status']==2){  ?>
                            <img src="../img/icon/pack.png" alt="">
                            <?php }?>
                            <?php if($order_result['order_status']==3){  ?>
                                <img src="../img/icon/delivery.png" alt="">
                            <?php }?>
                            <?php if($order_result['order_status']==4){  ?>
                                <img src="../img/icon/delivery_success.png" alt="">
                            <?php }?>
                    </td>
                    <td>Tình trạng đơn hàng:</td>
                    <td ><?php if($order_result['order_status']==1){  ?>
                                Đặt hàng thành công
                            <?php }?>
                         <?php if($order_result['order_status']==2){  ?>
                                Đang chuẩn bị hàng
                            <?php }?>
                            <?php if($order_result['order_status']==3){  ?>
                                Đơn hàng đang được vận chuyển
                            <?php }?>
                            <?php if($order_result['order_status']==4){  ?>
                                Giao hàng thành công
                            <?php }?>
                    </td>
                </tr>
            </table>

        </div>
        <div class="order_pdt">
            <div class="order_list_pdt">
                <table>
                    <?php foreach($pdt_detail as $value):?>
                    <tr>
                        <td><a href=""class="order_pdt_img"><img src="../img/product/<?php echo $value['product_image'] ?>" alt=""></a></td>
                        <td><a href=""><?php echo $value['product_name'] ?> </a>  </td>
                        <td><?php echo $value['order_quantity'] ?></td>
                        <td><p><?php echo $value['order_price'] ?></p></td>
                    </tr>

                    <?php endforeach ?>
                    <tr>
                        <td colspan="3">Phí vận chuyển</td>
                        <td><p><?php echo $order_result['order_delivery']?></p> </td>
                    </tr>
                    <tr>
                        <td colspan="3">Tổng cộng</td>
                        <td><p><?php echo $order_result['order_total']  ?></p> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>