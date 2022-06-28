<?php
    include '../../database/connect.php'

?>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Css/admin/product_management_ad.css">
    <link rel="stylesheet" href="../../Css/admin/tab.css">
</head>
<body> 
    <div class="order_management_content">
        
        <?php include 'home_ad.php' ?>
        <div class="order_management_main">  
            <div class="home-tabs">
                <div class="home-tab-title">
                    <div class="home-tab-item active">
                        <span>Dang hoat dong</span> 
                    </div>
                    <div class="home-tab-item">
                        <span>Da an</span>
                    </div>
                    <div class="home-tab-item">
                        <span>HOT DEAL</span>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="home-tab-content">
                    <div class="home-tab-pane active">
                        <form method="POST" action="author_add_ad.php">
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

                        </form>  
                    </div>  
                    <div class="home-tab-pane">
                        <h1>Noi dung tab 2</h1> 
                    </div>
                    <div class="home-tab-pane">
                        <h1>Noi dung tab 3</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/home_tab.js "></script>
    
</body>
</html>