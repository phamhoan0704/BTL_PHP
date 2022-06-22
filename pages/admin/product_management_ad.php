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
    <link rel="stylesheet" href="../../css/admin/product_management_ad.css">
</head>
<body> 
    <?php
        $sql_product="SELECT *FROM tbl_product";
        $query_product=mysqli_query($conn,$sql_product);
       //$li_order=mysqli_fetch_array($query_order);
        $product=[];
        while ($row = mysqli_fetch_array($query_product)){
            $product[] = $row;
        }
        // var_dump($order[0]['order_id']);
        // die();
        if(isset($_POST['product_delete'])){
            $product_id=$_POST['product_id'];
            mysqli_query($conn,"DELETE FROM tbl_product WHERE product_id=$product_id");
            header('location:product_management_ad.php');
        }
?>

    <div class="order_management_content">
    <?php include 'home_ad.php' ?>
    <form method="POST" action="product_add_ad.php">
        
   
    <div class="order_management_main">  
        <table>
        <tr><td colspan="7"><button type="submit" name="add">Thêm sản phẩm</button></td>  </tr>
            <tr class="title_order">
                <td>Mã sản phẩm</td>
                <td>Tên sản phẩm</td>
                <td>Hình ảnh</td>
                <td>Số lượng</td>
                <td>Danh mục</td>
                <td colspan="2"></td>
            </tr>  
            <?php foreach($product as $value):?>
            <tr>
                <td><?php echo $value['product_id'] ?></td>
                <td style="width:300px;"><?php echo $value['product_name']  ?></td>
                <td><img src="../../img/product/<?php echo $value['product_image']?>" alt="">   </td>
                <td><?php echo $value['product_quantity'] ?></td>
                <td><?php echo $value['category_id'] ?></td>
                <td><a href="product_detail_ad.php?id=<?php echo $value["product_id"]?>">Xem chi tiết</a> </td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']?>">
                        <button type="submit" name="product_delete">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>

        </table>

    </div>  </form>  </div>
</body>
</html>