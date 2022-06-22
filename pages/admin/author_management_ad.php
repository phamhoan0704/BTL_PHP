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
        $sql_author="SELECT *FROM tbl_author";
        $query_author=mysqli_query($conn,$sql_author);
       //$li_order=mysqli_fetch_array($query_order);
 
        while ($row = mysqli_fetch_array($query_author)){
            $author[] = $row;
        }


        // var_dump($order[0]['order_id']);
        // die();
        if(isset($_POST['author_delete'])){
            $category_id=$_POST['author_id'];
            // mysqli_query($conn,"DELETE FROM tbl_product WHERE category_id=$category_id");
            mysqli_query($conn,"DELETE FROM tbl_author WHERE author_id=$author_id");
            header('location:author_management_ad.php');
        }
?>

    <div class="order_management_content">
    
    <?php include 'home_ad.php' ?>
    <form method="POST" action="author_add_ad.php">
        
   
    <div class="order_management_main">  
        <table>
        <tr><td colspan="7"><button type="submit" name="add">Thêm tác giả</button></td>  </tr>
            <tr class="title_order">
                <td>Mã tác giả</td>
                <td>Tên tác giả</td>
                <td colspan="2"></td>
            </tr>  
            <?php foreach($author as $value):?>
            <tr>
                <td><?php echo $value['author_id'] ?></td>
                <td><?php echo $value['author_name']  ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="author_id" value="<?php echo $value['author_id']?>">
                        <button type="submit" name="author_delete">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>

        </table>

    </div>  </form>  </div>
</body>
</html>