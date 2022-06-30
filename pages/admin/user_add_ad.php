<?php
    include '../../Database/connect.php';
      ?>
<?php

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin/user_add_ad.css">
</head>
<body>
<div class="user_add_content">
     <?php include 'home_ad.php'?>
<?php
$nameErr=$emailErr=$phoneErr=$imageErr=$passwordErr=$repasswordErr=$passErr=$Err="";
if(isset($_POST['add'])){
    $nameErr=$emailErr=$phoneErr=$imageErr=$passwordErr=$repasswordErr=$passErr=$Err="";
    $username= $_POST['username'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    //$image=$_POST['image'];
    $type=$_POST['type'];


    if(empty($username)||empty($password)||empty($repassword)||empty($email)||empty($phone)){
        $Err="Vui lòng nhập đầy đủ thông tin";
    }else{
 
        if(mysqli_num_rows($old)>0) {
        $nameErr="Tên user bị trùng";
        }       
        else if($password!=$repassword){
        $passErr="Mật khẩu không khớp";
        }   
        else{
            $password= md5($password);
            $q=mysqli_query($conn,"INSERT INTO tbl_user(user_name,user_password,user_email,user_phone,user_type) VALUES('$username','$password','$email',
            '$phone','$type')");

            header('location:user_management_ad.php');
    }
    }

}
?>
     <div class="user_add_main">
    <form method="POST">
       <table class="table_user">
                 <tr>
                     <td style="font-size: 16px;font-weight:bold">Nhập thông tin tài khoản</td>
                     </tr>
                <tr>
                    <td >Tên người dùng: </td>
                    <td><input type="" name="username" ></td>
                    <td><?php if($nameErr!=""){
                        echo $nameErr;
                    }   ?></td>                
                </tr>
                <tr>
                    <td >Mật khẩu: </td>
                    <td><input type="password" name="password" ></td>
                    <td><?php if($passErr!=""){
                        echo $passErr;
                    }   ?></td>
                </tr>
                <tr>
                    <td >Nhập lại mật khẩu: </td>
                    <td><input type="password" name="repassword"></td>
                    <td></td>            
                </tr>
                <tr>
                    <td >Email: </td>
                    <td><input type="" name="email"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type="" name="phone"></td>
                    <td></td>
                </tr>
                <!-- <tr>
                    <td>Hình ảnh:</td>
                     <td> <input type="file" name="image"></td>   
                     <td></td>

                </tr> -->
                <tr>
                    <td>Kiểu tài khoản:</td>
                    <td>
                    <select name="type" class="account_style">
                        <option value="1">Admin</option>
                        <option value="2">Khách hàng</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="add">Thêm mới</button></td>                
                </tr>
                <tr>
                    <td><?php if($Err!=""){
                        echo $Err;
                    }   ?></td>                
                </tr>
  
 
       </table> 
    </form>
     </div>
</div> 



</body>
</html>
<?php

