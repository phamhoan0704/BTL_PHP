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
    <link rel="stylesheet" href="../../css/admin/order_management_ad.css">
</head>
<body> 
    <?php
        $sql_order="SELECT *FROM tbl_order";
        $query_order=mysqli_query($conn,$sql_order);
       //$li_order=mysqli_fetch_array($query_order);
        $order=[];
        while ($row = mysqli_fetch_array($query_order)){
            $order[] = $row;
        }



        // var_dump($order[0]['order_id']);
        // die();

        if(isset($_POST['order_delete'])){
            $order_id=$_POST['order_id'];
            mysqli_query($conn,"DELETE FROM tbl_order_detail WHERE order_id=$order_id");
            mysqli_query($conn,"DELETE FROM tbl_order WHERE order_id=$order_id");
            header('location:order_management_ad.php');
        }

?>
    <div class="order_management_content">
    
    <?php include 'home_ad.php' ?>
    <div class=" order_management_main">
       
        <table>
            <tr class="title_order">
                <td>Mã hóa đơn</td>
                <td>Mã khách hàng</td>
                <td>Tổng tiền</td>
                <td>Trạng thái</td>
                <td>Ngày đặt</td>
                <td colspan="2"></td>
                
            </tr>  
            <?php foreach($order as $value):?>
            <tr>
                <td><?php echo $value['order_id'] ?></td>
                <td><?php echo $value['user_id']  ?></td>
                <td><?php echo $value['order_total'] ?></td>
                <td >
                     <?php
                         if($value['order_status']==1){?>
                            Đặt hàng<?php }?>
                            <?php if($value['order_status']==2){  ?>
                                Đang chuẩn bị hàng
                            <?php }?>
                            <?php if($value['order_status']==3){  ?>
                                Đơn hàng đang được vận chuyển
                            <?php }?>
                            <?php if($value['order_status']==4){  ?>
                                Giao hàng thành công
                            <?php }?>
                    </td>
                <td><?php echo $value['order_date'] ?></td>
                <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $value['order_id']?>">
                        <button type="submit" name="order_delete">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>

        </table>

    </div>    </div>
</body>
</html>