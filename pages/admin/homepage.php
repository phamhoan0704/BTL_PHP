<?php
    include '../../database/connect.php';
    $yearCurrent = date('y');
    $monthCurrent = date('m');
    $dayCurrent = date('d');
    $sql = "SELECT month(tbl_order.order_date) as 'month', sum(tbl_product.product_price*tbl_order_detail.order_quantity) as 'total'
            FROM tbl_product INNER JOIN tbl_order_detail on tbl_product.product_id=tbl_order_detail.product_id
                             INNER JOIN tbl_order on tbl_order.order_id=tbl_order_detail.order_id
            WHERE year(tbl_order.order_date) = 2022
            GROUP BY month(tbl_order.order_date) 
            Order by month(tbl_order.order_date) 
    ";
    $result = mysqli_query($conn, $sql);
    $product = array();
    if(mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_array($result, 1))
        {
            $product[] = $row;
        }

    $product_date = [];
    $product_total = [];

    for($i=0;$i<count($product);$i++)
    {
        // $product_date[] = (float)(substr($product[$i]['order_date'], 8, 2));
        $product_date[] = (float)$product[$i]['month'];
        $product_total[] = (float)$product[$i]['total'];
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
    <link rel="stylesheet" href="../../css/admin/homepage.css">
</head>
<body> 

    <div class="order_management_content">
        <?php include 'home_ad.php' ?>
        <!-- ------------------------ -->
        <div class="homepage_main">  
            <div class="homepage__box">
                <div class="title-box">Danh sách cần làm
                    <p>Những việc bạn sẽ phải làm</p>
                </div>
                <div class="to-do-list">
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                    <a href="" class="to-do-item">
                        <p class="item-title">0</p>
                        <p class="item-desc">Chờ lấy hàng</p>
                    </a>
                </div>
            </div>
            <div class="homepage__box sale-analysis">
                <div class="title-box">Phân Tích Bán Hàng
                    <p style="margin-bottom: 0;">Tổng quan về doanh thu của cửa hàng trong năm</p>
                </div>
                <div id="linechart"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Day');
            data.addColumn('number', 'Doanh Thu');

            data.addRows([
                <?php
                    $check = false;
                    for($i=1; $i<=$monthCurrent;$i++)
                    {
                        for($j=0; $j<count($product_date);$j++)
                        {
                            if($i== $product_date[$j]){
                            echo '
                                ['.$product_date[$j].','.$product_total[$j].'],
                            ';
                                $check = true;
                                break;
                            }
                        if($check == false) 
                            echo '
                                ['.$i.',0],
                            ';
                        }
                    }
                ?>
            ]);

            var options = {
                chart: {
                title: '',
                subtitle: ''
                }
            };

            var chart = new google.charts.Line(document.getElementById('linechart'));

            chart.draw(data, google.charts.Line.convertOptions(options));
            }
            
    </script>
</body>
</html>