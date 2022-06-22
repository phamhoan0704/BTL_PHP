<?php
    include '../../database/connect.php'

?>  
<?php

    if(isset($_POST['category_add'])){
        $name=$_POST['name'];
        mysqli_query($conn,"INSERT INTO tbl_category(category_name) VALUES ('$name')");
        header('location:category_management_ad.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Css/admin/user_add_ad.css">
</head>
<body>  
<div class="user_add_content">
   <?php include 'home_ad.php'?>
     <div class="user_add_main">
    <form method="POST">
       <table class="table_user">
                 <tr><td style="font-size: 16px;font-weight:bold">Nhập thông tin sản phẩm</td> </tr>
                <tr>
                    <td >Tên danh mục: </td>
                    <td><input type="" name="name"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="category_add">Thêm mới</button></td>                
                </tr>
       </table>
     </form>
     </div>
</div> 



</body>
</html>