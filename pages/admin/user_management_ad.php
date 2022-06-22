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
    <link rel="stylesheet" href="../../css/admin/user_management_ad.css">
</head>
<body> 
    <?php
        $sql_user="SELECT * FROM tbl_user";
        $query_user=mysqli_query($conn,$sql_user);
       //$li_order=mysqli_fetch_array($query_order);

        while ($row = mysqli_fetch_array($query_user)){
            $user1[] = $row;
        }
        // var_dump($order[0]['order_id']);
        // die();

        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action=="user_delete"){
                $user_id=$_POST['user_id'];
                $query_oder_user= mysqli_query($conn,"SELECT order_id FROM tbl_order WHERE user_id=$user_id");
                while ($row = mysqli_fetch_array($query_oder_user)){
                    $order_user[] = $row;
                }
                // var_dump($order_user);
                // die();
                foreach($order_user as $value){
                     mysqli_query($conn,"DELETE FROM tbl_order_detail WHERE order_id=$value[order_id]");
                }
                mysqli_query($conn,"DELETE FROM tbl_order WHERE user_id=$user_id");
                mysqli_query($conn,"DELETE FROM tbl_user WHERE user_id=$user_id");
                header('location:user_management_ad.php');
            }
            if($action=="user_add"){
                header('location:user_add_ad.php');
            }
        }
?>
  <div class="user_management_content">
    
    <?php include 'home_ad.php' ?>
    <div class=" user_management_main">
       
        <table>
            <tr>
                <td colspan="7">
                <form method="POST">
                        <button type="submit" value="user_add" name="action">Thêm tài khoản</button>
                 </form>
                </td>
            </tr>
            <tr class="title">
                <td>Mã người dùng</td>
                <td>Tên người dùng</td>
                <td>Số điện thoại</td>
                <td>Email</td>
                <td>Loại tài khoản</td>
                <td></td>
          
            </tr>  
            <?php foreach($user1 as $value):?>
            <tr>
                <td><?php echo $value['user_id'] ?></td>
                <td><?php echo $value['user_name']  ?></td>
                <td><?php echo $value['user_phone'] ?></td>
                <td ><?php echo $value['user_email'] ?></td>
                <td>
                <?php
                    if($value['user_type']==1){?>
                        Admin<?php }?>
                    <?php if($value['user_type']==2){  ?>
                        Khách hàng
                    <?php }?>
                </td>
                
                <td>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $value['user_id']?>">
                        <button type="submit" value="user_delete" name="action">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>

        </table>

    </div>    </div>
</body>
</html>