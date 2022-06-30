<?php
    include '../../database/connect.php';

    $dateEnd = date('Y-m-d');
    $dateStart = date('Y-m-d', strtotime($dateEnd. ' - 30 days'));
   
    if(isset($_GET['dateEnd'])) {
        $time = strtotime($_GET['dateEnd']);
        $dateEnd = date('Y-m-d',$time);
    }
    if(isset($_GET['dateStart'])) {
        $time = strtotime($_GET['dateStart']);
        $dateStart = date('Y-m-d',$time);
    }

    $dropdown__select ='productID';

    if(isset($_GET['sort_by'])) $dropdown__select = $_GET['sort_by'];

    switch($dropdown__select)
    {
        case 'productID':
            $sql = "";
            break;
        case 'price-ascending':
            $sql = "Order by total";
            break;
        case 'price-descending':
            $sql = "Order by total desc";
            break;
        case 'sale-amount-ascending':
            $sql = "order by sale_amount";
            break;
        case 'sale-amount-descending':
            $sql = "order by sale_amount desc";
            break;
    }

    $sql = "SELECT tbl_product.product_id, tbl_product.product_name, tbl_product.product_price, sum(tbl_order_detail.order_quantity) as 'sale_amount', tbl_product.product_price*sum(tbl_order_detail.order_quantity) as 'total'
            FROM tbl_product INNER JOIN tbl_order_detail on tbl_product.product_id=tbl_order_detail.product_id
                             INNER JOIN tbl_order on tbl_order.order_id=tbl_order_detail.order_id
                             WHERE tbl_order.order_date >= '$dateStart'
                             and tbl_order.order_date <= '$dateEnd' 
            GROUP BY tbl_product.product_id, tbl_product.product_name, tbl_product.product_price $sql
    ";
    $result = mysqli_query($conn, $sql);
    $product = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $product[] = $row;
        }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../../css/admin/product_management_ad.css"> -->
    <link rel="stylesheet" href="../../css/admin/sale_management.css">
</head>
<body> 

    <div class="sale_management_content">
        <?php include 'home_ad.php' ?>
        <!-- ------------------------ -->
        <div class="sale_management_main">  
            <h1>THỐNG KÊ DOANH THU</h1>
            <div class="sale_management-head">
                <div class="sale_management-filter">
                    <form action="" method="get">
                        <label for="">Từ ngày</label>
                        <input class="date" type="date" value="<?php echo $dateStart ?>" name="dateStart">
                        <label for="">Đến ngày</label>
                        <input class="date" type="date" value="<?php echo $dateEnd ?>" name="dateEnd">
                        <button type="submit">Lọc</button>
                    </form>
                </div>
                <div class="sale_management-option">
                    <select id="selectBox" class="sale_management__select" name="order_management__select" onchange="dropdownOption(value, '<?php echo $dateStart ?>','<?php echo $dateEnd ?>')">
                        <option value="productID" 
                            <?php 
                            if(isset($_GET['sort_by']) )
                                if($_GET['sort_by']=='productID') 
                                    echo 'selected'
                        ?>>Mã Sản Phẩm</option>

                        <option value="sale-amount-descending" <?php 
                            if(isset($_GET['sort_by']) )
                                if($_GET['sort_by']=='sale-amount-descending') echo 'selected'?>>Số Lượng: Giảm dần</option>
                        
                        <option value="sale-amount-ascending" <?php 
                            if(isset($_GET['sort_by']) )
                                if($_GET['sort_by']=='sale-amount-ascending') echo 'selected'?>>Số Lượng: Tăng dần</option>

                        <option value="price-descending" <?php 
                            if(isset($_GET['sort_by']) )
                                if($_GET['sort_by']=='price-descending') echo 'selected'?>>Doanh Thu: Giảm dần</option>
                        <option value="price-ascending" <?php 
                            if(isset($_GET['sort_by']) )
                                if($_GET['sort_by']=='price-ascending') echo 'selected'?>>Doanh Thu: Tăng dần</option>
                    </select>
                </div>
            </div>

            <div class="sale_management-info">
                <div class="float-right">
                    <!-- <form action="" method="post">
                        <input type="submit" name="export_excel" value="Export">
                    </form> -->
                    <div class="float-right">
                        <a href="export.php?dateStart=<?php echo $dateStart?>&dateEnd=<?php echo $dateEnd?>" class="btn btn-success">Export</a>
                    </div>
                </div>
                <table class="sale_management-table">
                    <thead>
                        <tr>
                            <td style="width: 15%">Mã sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá Bán</td>
                            <td>Số lượng</td>
                            <td>Doanh Thu</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=0;$i<count($product);$i++)
                                echo '
                                    <tr>
                                        <td>'.$product[$i]['product_id'].'</td>
                                        <td>'.$product[$i]['product_name'].'</td>
                                        <td style="text-align: right;">'.$product[$i]['product_price'].'</td>
                                        <td style="text-align: right;">'.$product[$i]['sale_amount'].'</td>
                                        <td style="text-align: right;">'.$product[$i]['total'].'</td>
                                    </tr>
                                ';

                        ?>
                        <!-- <tr>
                            <td>SP1</td>
                            <td>Monster #8 (Dark Ver)</td>
                            <td style="text-align: right;">65,000</td>
                            <td style="text-align: right;">55</td>
                            <td style="text-align: right;">3,000,000</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>  
    </div>

    <?php include 'footer_ad.php'; ?>

    <script>
        function dropdownOption(i, start, end)
        {
            console.log(typeof start)
            var url = "sale_management.php?dateStart=" + start + "&dateEnd=" + end + "&sort_by=" + i;
            window.location.href = url;
        }
    </script>
    <script>
        document.getElementById("header-report").style.background = "rgb(1 161 75)";
        document.getElementById("header-report").style.color = "white";
    </script>
</body>
</html>