<?php
    include '../../database/connect.php'

?>  
   <?php
        if(isset($_GET["id"])){
            $id=$_GET["id"];
        }
        $sql_order="SELECT *FROM tbl_order WHERE order_id=$id" ;
        $query_order=mysqli_query($conn,$sql_order);
        $order=mysqli_fetch_array($query_order);

        $sql_order_detail="SELECT *FROM tbl_order_detail INNER JOIN tbl_product 
        ON tbl_product.product_id=tbl_order_detail.product_id
        WHERE order_id=$id";
        $query_order_detail=mysqli_query($conn,$sql_order_detail);
        while ($row = mysqli_fetch_array($query_order_detail)){
            $order_dt[]=$row;
        }
        if(isset($_POST['status'])){
            $status=$_POST['status'];

            mysqli_query($conn,"UPDATE tbl_order SET order_status='$status' WHERE order_id=$id");
            header('location:order_management_ad.php');                
            
        }
        if(isset($_POST['payment_status'])){
            $status=$_POST['payment_status'];
 
                mysqli_query($conn,"UPDATE tbl_order SET order_payment_status='$status' WHERE order_id=$id");
                header('location:order_management_ad.php');                
            

        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin/order_detail_ad.css">
</head>
<body>
<div class="order_detail_content">
     <?php include 'home_ad.php' ?>

     <div class="order_detail_main">
       <table class="table_user">
                 <tr><td style="font-size: 16px;font-weight:bold">Thông tin đơn hàng </td> </tr>
                 <tr>
                    <td class="">Mã đơn hàng: <?php echo $order['order_id'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="">Họ tên: <?php echo $order['order_name'] ?>
                    </td>
                </tr>
                <tr>
                    <td class="">Email: <?php echo $order['order_email']?>
                    </td>
                </tr>
                <tr>
                    <td class="">Số điện thoại: <?php echo $order['order_phone'] ?>
                   </td>
                </tr>
                <tr>
                    <td class="">Địa chỉ: <?php echo $order['order_address']?>
                   </td>
                </tr>
                <tr>
                    <td>Ghi chú: <?php echo $order['order_note'] ?></td>
                </tr>

                <tr>
                    <td class="">Trạng thái đơn hàng: <?php
                            if($order['order_status']==1){?>
                                Đặt hàng<?php }?>
                            <?php if($order['order_status']==2){  ?>
                                Đang chuẩn bị hàng
                            <?php }?>

                            <?php if($order['order_status']==3){  ?>
                                Đơn hàng đang được vận chuyển
                            <?php }?>
                            <?php if($order['order_status']==4){  ?>
                                Giao hàng thành công
                            <?php }?>
                   </td>

                </tr>
                <tr>
                    <td class="">Hình thức thanh toán: <?php
                            if($order['order_payment']==1){?>
                            Thanh toán qua tài khoản
                                <?php }?>
                            <?php if($order['order_payment']==2){  ?>
                                Thanh toán khi nhận hàng
                            <?php }?>
                   </td>

                </tr>
                <tr>
                    <td class="">Trạng thái thanh toán: <?php
                            if($order['order_payment_status']==1){?>
                            Chưa thanh toán
                                <?php }?>
                            <?php if($order['order_payment_status']==2){  ?>
                               Đã thanh toán
                            <?php }?>
                   </td>

                </tr>
            </table>

       <table class="table_pdt">
           <tr class="title_order_detail">
               <td>Mã sản phẩm</td>
               <td>Tên sản phẩm</td>
               <td>Hình ảnh</td>
               <td>Số lượng</td>
               <td>Giá tiền</td>
           </tr>  
           <?php foreach($order_dt as $value):?>
           <tr>
               <td><?php echo $value['product_id'] ?></td>
               <td><?php echo $value['product_name']?></td>
               <td><img src="../../img/product/<?php echo $value['product_image'] ?>" alt=""> </td>
               <td><?php echo $value['order_quantity'] ?></td>
               <td><?php echo $value['order_price']  ?></td>
           </tr>
           <?php endforeach ?>

       </table>
            <form method="POST" class="order_status_update">
                <div style="width:600px">
                <div>
                    <label for="">Trạng thái đơn hàng: </label>
                </div>
                    
                    <select name="status">
                        <option value="1" <?php if($order['order_status']==1) echo "selected=\"selected\"" ?>>Đặt hàng</option>
                        <option value="2" <?php if($order['order_status']==2) echo "selected=\"selected\"" ?>>Đang chuẩn bị hàng</option>
                        <option value="3"<?php if($order['order_status']==3) echo "selected=\"selected\"" ?>>Đơn hàng đang được vận chuyển</option>
                        <option value="4"<?php if($order['order_status']==4) echo "selected=\"selected\"" ?>>Giao hàng thành công</option> 
                    </select>
                </div>

                <div>
                <div style="width: 200px;">
                    <label for="">Trạng thái thanh toán: </label>
                </div>
                <div>
                    
           
                    <select name="payment_status">
                        <option value="1" <?php if($order['order_payment_status']==1) echo "selected=\"selected\"" ?>>Chưa thanh toán</option>
                        <option value="2"<?php if($order['order_payment_status']==2) echo "selected=\"selected\"" ?>>Đã thanh toán</option>
                    </select>
                </div>
            
                </div>
                <button type="submit">Cập nhật</button>
            </form>

     </div>
</div> 



</body>
</html>