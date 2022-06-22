<?php
    include '../../database/connect.php'

?> 
<?php
    if(isset($_POST['supplier_add'])){
        $name=$_POST['name'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        mysqli_query($conn,"INSERT INTO tbl_supplier(supplier_name,supplier_address,supplier_phone) VALUES ('$name','$address','$phone')");

        header('location:supplier_management_ad.php');
    }
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
     <div class="user_add_main">
    <form method="POST">
       <table class="table_user">
                 <tr><td style="font-size: 16px;font-weight:bold">Nhập thông tin nhà cung cấp</td> </tr>
                <tr>
                    <td >Tên nhà cung cấp</td>
                    <td><input type="" name="name"></td>
                </tr>
                <tr>
                    <td >Địa chỉ nhà cung cấp </td>
                    <td><input type="" name="address"></td>
                </tr>
                <tr>
                    <td >Số diện thoại </td>
                    <td><input type="" name="phone"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="supplier_add">Thêm mới</button></td>                
                </tr>
       </table>
     </form>
     </div>
</div> 
</body>
</html>