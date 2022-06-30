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
    <link rel="stylesheet" href="../../Css/admin/tab.css">

    <link rel="stylesheet" href="../../css/admin/user_management_ad.css">
</head>
<body> 
    <?php
    $user_hide =[];

//tat ca
        $sql_user="SELECT * FROM tbl_user";
        $query_user=mysqli_query($conn,$sql_user);
        while ($row = mysqli_fetch_array($query_user)){
            $user[] = $row;
        }
//dang hoat dong
        $sql_user_active="SELECT * FROM tbl_user WHERE user_status=0";
        $query_user_active=mysqli_query($conn,$sql_user_active);
        while ($row = mysqli_fetch_array($query_user_active)){
            $user_active[] = $row;
        }
//dung hoat dong
        $sql_user_hide="SELECT * FROM tbl_user WHERE user_status=1";
        $query_user_hide=mysqli_query($conn,$sql_user_hide);
        while ($row = mysqli_fetch_array($query_user_hide)){
            $user_hide[] = $row;
        }

        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action=="user_delete"){
                // $user_id=$_POST['user_id'];
                // $query_oder_user= mysqli_query($conn,"SELECT order_id FROM tbl_order WHERE user_id=$user_id");
                // while ($row = mysqli_fetch_array($query_oder_user)){
                //     $order_user[] = $row;
                // }
                // // var_dump($order_user);
                // // die();
                // foreach($order_user as $value){
                //      mysqli_query($conn,"DELETE FROM tbl_order_detail WHERE order_id=$value[order_id]");
                // }
                // mysqli_query($conn,"DELETE FROM tbl_order WHERE user_id=$user_id");
                // mysqli_query($conn,"DELETE FROM tbl_user WHERE user_id=$user_id");
                $user_id=$_POST['user_id'];
                mysqli_query($conn,"UPDATE tbl_user SET user_status=1 WHERE user_id=$user_id");
                header('location:user_management_ad.php');
            }
            if($action=="user_restore"){
                $user_id=$_POST['user_id'];
                mysqli_query($conn,"UPDATE tbl_user SET user_status=0 WHERE user_id=$user_id");
                header('location:user_management_ad.php');
            }
            if($action=="user_add"){
                header('location:user_add_ad.php');
            }

            if($action=="search1"){
              $text_search1=$_POST['search_txt1'];
              $sql_user_search="SELECT * FROM tbl_user where user_name LIKE '%$text_search1%' ";
              $query_user_search=mysqli_query($conn,$sql_user_search);
              $user_search=[];
              while($row=mysqli_fetch_array($query_user_search)){
                  $user_search[]=$row;
              }
            }

              


        }


?>
  <div class="user_management_content">
    <?php include 'home_ad.php' ?>
    <div class=" user_management_main">
        <!-- Title -->
        <div class="home-tabs">
            <div class="home-tab-title">
                
                    <div class="home-tab-item active">
                    <span> Tất cả </span>
                    <span><?php echo count($user) ?></span>
                    </div>
                        
                    <div class="home-tab-item">
                        <span>Đang hoạt động </span>
                        <span><?php echo count($user_active) ?></span>
                    </div>
           
                    <div class="home-tab-item">
                    <span> Dừng hoạt động</span>
                    <span><?php echo count($user_hide) ?></span>
                    </div>
                    <div class="line"></div>
            </div>

            <table>
                 <tr>
                    <td colspan="7">
                    <form method="POST">
                            <button type="submit" value="user_add" name="action">Thêm tài khoản</button>
                     </form>
                     </td>
                 </tr>            
            </table>
        <!-- Content -->

        <div class="home-tab-content">
            <!-- Tat ca -->
            <div class="home-tab-pane active">
                <!-- Them,Tim kiem -->
                    <table>

                        <tr>
                            <td colspan=7>
                                    <form method="POST">
                                        <label for="" class="label_search">Tìm kiếm</label>
                                        <input placeholder="Nhập tên người dùng" id="input_search" type="" name="search_txt1" value="<?php if(isset($_POST['action'])) echo $text_search1 ?>">
                                        <button type="submit" value="search1" name="action">Tìm kiếm</button>                
                                    </form>   
                            </td>
                        </tr>
                        <?php if(isset($_POST['action'])&&$_POST['action']="search1" && $text_search1!="" && $user_search!=[]){
                        ?>
                        <tr> <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> <?php echo count($user_search) ?> </span></td></tr>
                            <tr class="title">
                            <td>Mã người dùng</td>
                            <td>Tên người dùng</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Loại tài khoản</td>
                            </tr>  
                            <?php foreach($user_search as $value):?>
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
                            </tr>
                            <?php endforeach ?>


                        <?php } else if(isset($_POST['action'])&&$text_search1!="" && $user_search==[]) {
                        ?>
                        <tr>
                            <td colspan="7"><?php echo "Không có kết quả phù hợp"  ?></td>
                        </tr>
                        <?php

                        } ?>

                    </table>  
                    <!-- Danh sach tai khoan -->
                    <table>
                        <tr class="title">
                            <td>Mã người dùng</td>
                            <td>Tên người dùng</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Loại tài khoản</td>

                        </tr>  
                        <?php foreach($user as $value):?>
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
                        </tr>
                        <?php endforeach ?>
                    
                    </table>
                </div>
                <!-- Dang hoat dong -->
    
                <div class="home-tab-pane">
                <table>
                        <tr class="title">
                            <td>Mã người dùng</td>
                            <td>Tên người dùng</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Loại tài khoản</td>
                            <td></td>
                    
                        </tr>  
                        <?php foreach($user_active as $value):?>
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
                </div>
            
                <!-- Dung hoat dong -->
                <div class="home-tab-pane">
                <table>
                        <tr class="title">
                            <td>Mã người dùng</td>
                            <td>Tên người dùng</td>
                            <td>Số điện thoại</td>
                            <td>Email</td>
                            <td>Loại tài khoản</td>
                            <td></td>
                    
                        </tr>  
                        <?php foreach($user_hide as $value):?>
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
                                    <button type="submit" value="user_restore" name="action">Khôi phục</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>

                    </table>
                </div>
        </div>   
    </div>
    </div>
 
    <?php include 'footer_ad.php'; ?>
 
    <script src="../../js/home_tab.js "></script>
    <script>
        document.getElementById("header-user").style.background = "rgb(1 161 75)";
        document.getElementById("header-user").style.color = "white";
    </script>
</body>
</html>