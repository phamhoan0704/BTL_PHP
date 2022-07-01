<?php
    include '../../database/connect.php';

?>  
   <?php
        if(isset($_GET["id"])){
            $id=$_GET["id"];
        }
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

        $query_product=mysqli_query($conn,"SELECT *FROM tbl_product WHERE product_id='$id'");
        $product=mysqli_fetch_array($query_product);



        $query_cat=mysqli_query($conn,"SELECT category_name FROM tbl_category WHERE category_id=$product[category_id]");
        $cat_name=mysqli_fetch_array($query_cat);

        $query_author=mysqli_query($conn,"SELECT author_name FROM tbl_author WHERE author_id=$product[author_id]");
        $author_name=mysqli_fetch_array($query_author);
   
        $query_supplier=mysqli_query($conn,"SELECT supplier_name FROM tbl_supplier WHERE supplier_id=$product[supplier_id]");
        $supplier_name=mysqli_fetch_array($query_supplier);
   
   

        if(isset($_POST['product_update'])){
            $name=$_POST['name'];
            $year=$_POST['year'];
            if($year===""){

            }else{
                mysqli_query($conn,"UPDATE tbl_product SET product_year='$year' WHERE product_id=$id");
            }


            $fileimg=$_FILES["uploadimage"]["name"]; 
            $tempname=$_FILES["uploadimage"]["tmp_name"];
            if (isset($_FILES['uploadimage']['error'])) {
                /* check code error = 4 for validate 'no file' */         
                if ($_FILES['uploadimage']['error'] == 4) {
           
                }
                else{
                    mysqli_query($conn,"UPDATE tbl_product SET product_image='$fileimg' WHERE product_id=$id");
                }
           
              }
            $price_pre=$_POST['price_pre'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];
            $detail=$_POST['detail'];
            $category=$_POST['category'];
            $author=$_POST['author'];
            $supplier=$_POST['supplier'];

            mysqli_query($conn,"UPDATE tbl_product SET product_name='$name',product_price='$price',
            product_price_pre='$price_pre',product_detail='$detail',product_quantity='$quantity',
            category_id='$category', supplier_id='$supplier',author_id=$author
            WHERE product_id=$id");
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
     <?php include 'home_ad.php' ?>

     <div class="order_detail_main" style="margin-bottom: 50px;">
     <form method="POST"  enctype="multipart/form-data">
       <table class="table_pdt">
                 <tr><td style="font-size: 16px;font-weight:bold">Thông tin sản phẩm</td> </tr>
                <tr>
                    <td class="pdt_title">Tên sản phẩm: </td>
                    <td colspan="3"><input type="" name="name" value="<?php echo $product['product_name'] ?>"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Giá gốc</td>
                    <td><input type="" name="price_pre" value="<?php echo $product['product_price_pre']?>"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Giá giảm</td>
                    <td><input type="" name="price" value="<?php echo $product['product_price'] ?>"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Chi tiết</td>
                     <td><textarea rows="10" cols="" name="detail" value="<?php echo $product['product_detail']?>"></textarea></td>   
                </tr>
                <tr>
                    <td class="pdt_title">Số lượng</td>
                    <td><input type="" name="quantity" value="<?php echo $product['product_quantity']?>"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Năm sản xuất </td>
                    <td><?php echo $product['product_year'] ?><input type="date" name="year" value="" style="width:200px;float:right;"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Hình ảnh </td>
                    <td><?php echo $product['product_image']?><input type="file" name="uploadimage" value=""  style="width:200px;float:right;"></td>
                </tr>
                <tr>
                    <td class="pdt_title">Tác giả:</td>
                    <td><?php echo $author_name['author_name']?>
                    <select name="author" style="width:200px;float:right;">
                        <?php foreach($author as $value): ?>
                        <option value="<?php echo $value['author_id']?>"><?php echo $value['author_name']?></option>
                        <?php endforeach?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="pdt_title">Nhà cung cấp:</td>
                    <td><?php echo $supplier_name['supplier_name']?>
                    <select name="supplier" style="width:200px;float:right;">
                        <?php foreach($supplier as $value): ?>
                        <option value="<?php echo $value['supplier_id']?>"><?php echo $value['supplier_name']?></option>
                        <?php endforeach?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td class="pdt_title">Danh mục:</td>
                    <td><?php echo $cat_name['category_name']?>
                    <select name="category" style="width:200px;float:right;">
                        <?php foreach($cat as $value): ?>
                        <option value="<?php echo $value['category_id']?>"><?php echo $value['category_name']?></option>
                        <?php endforeach?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    <td><button type="submit" name="product_update">Cập nhật</button></td>                
                </tr>
       </table> </form>

     </div>
</div> 
<?php include 'footer_ad.php'; ?>
    <script>
        document.getElementById("header-product").style.background = "rgb(1 161 75)";
        document.getElementById("header-product").style.color = "white";
    </script>


</body>
</html>