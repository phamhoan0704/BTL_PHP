<?php
    include '../../database/connect.php'

?>  
<?php

    $query_category=mysqli_query($conn,"SELECT * FROM tbl_category");
    while($row=mysqli_fetch_array($query_category)){
        $cat[]=$row;
    }
    $query_author=mysqli_query($conn,"SELECT * FROM tbl_author");
    while($row=mysqli_fetch_array($query_author)){
        $author[]=$row;
    }
    $query_supplier=mysqli_query($conn,"SELECT * FROM tbl_supplier");
    while($row=mysqli_fetch_array($query_supplier)){
        $supplier[]=$row;
    }

    if(isset($_POST['product_add'])){
        $name=$_POST['name'];
        $year=$_POST['year'];
        $image=$_POST['image'];
        $price_pre=$_POST['price_pre'];
        $price=$_POST['price'];
        $detail=$_POST['detail'];
        $quantity=$_POST['quantity'];
        $category=$_POST['category'];
        $author=$_POST['author'];
        $supplier=$_POST['supplier'];
        mysqli_query($conn,"INSERT INTO tbl_product(product_name,product_year,product_price,
        product_price_pre,product_image,product_detail,product_quantity,category_id,supplier_id,author_id)
         VALUES ('$name','$year','$price','$price_pre','$image','$detail','$quantity','$category',$supplier,$author)");
        header('location:product_management_ad.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/admin/product_detail_ad.css">
</head>
<body>
<div class="order_detail_content">
     <?php include 'home_ad.php'?>
     <div class="order_detail_main">
    <form method="POST">
       <table class="table_pdt">
                 <tr><td colspan=2 style="font-size: 16px;font-weight:bold">Nhập thông tin sản phẩm</td> </tr>
                <tr>
                    <td class="pdt_title" >Tên sản phẩm: </td>
                    <td><input type="" name="name" ></td>
                </tr>
                <tr>
                    <td class="pdt_title">Giá gốc</td>
                    <td><input type="" name="price_pre"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Giá giảm</td>
                    <td><input type="" name="price"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Chi tiết</td>
                     <td><textarea rows="10" cols="" name="detail"></textarea></td>   
                </tr>
                <tr>
                    <td class="pdt_title">Số lượng</td>
                    <td><input type="" name="quantity"></td>
                </tr> 
                <tr>
                    <td class="pdt_title">Hình ảnh </td>
                    <td><input type="file" name="image" value="<?php echo $image?>" style="width: 300px;"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Năm sản xuất </td>
                    <td><input type="date" name="year" style="width:300px;"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Tác giả:</td>
                    <td>
                    <select name="author">
                        <?php foreach($author as $value): ?>
                        <option value="<?php echo $value['author_id']?>"><?php echo $value['author_name']?></option>
                        <?php endforeach  ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="pdt_title">Nhà cung cấp:</td>
                    <td>
                    <select name="supplier">
                        <?php foreach($supplier as $value): ?>
                        <option value="<?php echo $value['supplier_id']?>"><?php echo $value['supplier_name']?></option>
                        <?php endforeach  ?>
                    </select>
                    </td>
                </tr>
                
                <tr>
                    <td class="pdt_title">Danh mục:</td>
                    <td>
                    <select name="category">
                        <?php foreach($cat as $value): ?>
                        <option value="<?php echo $value['category_id']?>"><?php echo $value['category_name']?></option>
                        <?php endforeach  ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="product_add">Thêm mới</button></td>                
                </tr>
       </table> </form>
     </div>
</div> 



</body>
</html>