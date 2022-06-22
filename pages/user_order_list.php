<?php include('./header.php');

if(!isset($_SESSION['user'])){
    echo"<script>window.location.href='./log_in.php'<script>";
}
else{
    $usernanme=$_SESSION['user'];
    include('../database/connect.php');
    $sql="SELECT tbl_user.user_id,order_id,order_status,order_date,order_total 
    from tbl_user INNER JOIN tbl_order ON tbl_user.user_id=tbl_order.user_id 
    WHERE user_name='$usernanme'; ";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $order_list[]=$row;
    }
}
?>
   

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user_order_list.css">
</head>

<body>
    <div class="container">
    <div class="left_menu">
<?php include('menuleft.php');?>
</div>  <div class="box_infor">
            <div class="box_inforx">
        
            <div class="order_list_box">
                <table id="tb1">
                    <tr class ="br">
                        <th>Mã hóa đơn</th>
                        <th>Mã khách hàng</th>
                        <th>Trạng thái đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th></th>

                    </tr>
                    <?php if(sizeof($order_list)!=0)
                     foreach($order_list as $item):
                        ?>
              
                 <tr class ="br">
                        <td><?php echo $item['order_id']?></td>
                        <td><?php echo $item['user_id']?></td>
                        <td>
                        <?php if($item['order_status']==1) 
                        { 
                            $value1="order.png";
                            $value2="Đặt hàng";
                        }
                        else{
                            if($item['order_status']==2) {
                                $value1="pack.png";
                                $value2="Đang chuẩn bị hàng";
                            }
                            else{
                                if($item['order_status']==3) {
                                $value1="delivery.png";
                                $value2="Đơn hàng đang được vận chuyển";
                            }
                            else{
                                $value1="delivery_success.png";
                                $value2="Giao hàng thành công";
                            }
                            }

                        }?>

                            <div class="icon_order">
                            <img src="../img/icon/<?php echo $value1?>" alt="">
                            </div>
                            <div class="status_order">
                                <span><?php echo $value2?></span>
                            </div>
                        </td>
                        <td><?php echo $item['order_date']?></td>
                        <td><?php echo $item['order_total']?></td>
                        <td><a href="./order_detail.php?id=<?php echo $item['order_id']?>"><button class="btn">Xem chi tiết</button></a></td>
                    </tr><?php endforeach ?>
                </table>
            </div>
        </div>
        </div>
    </div>
    </div>
</body>

</html>
<?php include('./footer.php');?>
