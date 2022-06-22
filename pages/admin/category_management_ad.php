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
    <link rel="stylesheet" href="../../Css/admin/product_management_ad.css">
</head>
<body> 
    <?php
        $sql_category="SELECT *FROM tbl_category";
        $query_category=mysqli_query($conn,$sql_category);
       //$li_order=mysqli_fetch_array($query_order);
     
        while ($row = mysqli_fetch_array($query_category)){
            $category[] = $row;
        }
        // var_dump($order[0]['order_id']);
        // die();
        if(isset($_POST['category_delete'])){
            $category_id=$_POST['category_id'];
            // mysqli_query($conn,"DELETE FROM tbl_product WHERE category_id=$category_id");
            mysqli_query($conn,"DELETE FROM tbl_category WHERE category_id=$category_id");
            header('location:category_management_ad.php');
        }
?>

    <div class="order_management_content">
    
    <?php include 'home_ad.php' ?>
    <form method="POST" action="category_add_ad.php">
        
   
    <div class="order_management_main">  
        <table>
        <tr><td colspan="7"><button type="submit" name="add">Thêm danh mục</button></td>  </tr>
            <tr class="title_order">
                <td>Mã danh mục</td>
                <td>Tên danh mục</td>
                <td colspan="2"></td>
            </tr>  
            <?php foreach($category as $value):?>
            <tr>
                <td><?php echo $value['category_id'] ?></td>
                <td><?php echo $value['category_name']  ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="category_id" value="<?php echo $value['category_id']?>">
                        <button type="submit" name="category_delete">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>

        </table>

    </div>  </form>  </div>
</body>
</html>