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
    <link rel="stylesheet" href="../../Css/admin/tab.css">

    <link rel="stylesheet" href="../../css/admin/order_management_ad.css">
</head>
<body> 
<?php
//tat ca
        $sql_order="SELECT *FROM tbl_order";
        $query_order=mysqli_query($conn,$sql_order);
       //$li_order=mysqli_fetch_array($query_order);
        $order=[];
        while ($row = mysqli_fetch_array($query_order)){
            $order[] = $row;
        }
//Chờ xác nhận
        $sql_order_confirm="SELECT *FROM tbl_order WHERE order_status=1";
        $query_order_confirm=mysqli_query($conn,$sql_order_confirm);
        //$li_order=mysqli_fetch_array($query_order);
        $order_confirm=[];
        while ($row = mysqli_fetch_array($query_order_confirm)){
            $order_confirm[] = $row;
        }

//Dang chuan bị hang
        $sql_order_prepare="SELECT *FROM tbl_order WHERE order_status=2";
        $query_order_prepare=mysqli_query($conn,$sql_order_prepare);
        //$li_order=mysqli_fetch_array($query_order);
        $order_prepare=[];
        while ($row = mysqli_fetch_array($query_order_prepare)){
            $order_prepare[] = $row;
        }
//Dang van chuyen
        $sql_order_transport="SELECT *FROM tbl_order WHERE order_status=3";
        $query_order_transport=mysqli_query($conn,$sql_order_transport);
        //$li_order=mysqli_fetch_array($query_order);
        $order_transport=[];
        while ($row = mysqli_fetch_array($query_order_transport)){
            $order_transport[] = $row;
        }
//Da giao
        $sql_order_delivered="SELECT *FROM tbl_order WHERE order_status=4";
        $query_order_delivered=mysqli_query($conn,$sql_order_delivered);
        //$li_order=mysqli_fetch_array($query_order);
        $order_delivered=[];
        while ($row = mysqli_fetch_array($query_order_delivered)){
            $order_delivered[]= $row;
        }

//Don huy
        $sql_order_cancel="SELECT *FROM tbl_order WHERE order_status=5";
        $query_order_cancel=mysqli_query($conn,$sql_order_cancel);
        //$li_order=mysqli_fetch_array($query_order);
        $order_cancel=[];
        while ($row = mysqli_fetch_array($query_order_cancel)){
            $order_cancel[] = $row;
        }


        // var_dump($order[0]['order_id']);
        // die();

        if(isset($_POST['order_delete'])){
            $order_id=$_POST['order_id'];
            mysqli_query($conn,"UPDATE tbl_order SET order_status=5 WHERE order_id=$order_id");

            // mysqli_query($conn,"DELETE FROM tbl_order_detail WHERE order_id=$order_id");
            // mysqli_query($conn,"DELETE FROM tbl_order WHERE order_id=$order_id");
            header('location:order_management_ad.php');
        }
        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action=="search1"){
                $text_search1=$_POST['search_txt1'];
                $sql_order_search="SELECT * FROM tbl_order where order_id LIKE '%$text_search1%' ";
                $query_order_search=mysqli_query($conn,$sql_order_search);
                $order_search=[];
                while($row=mysqli_fetch_array($query_order_search)){
                    $order_search[]=$row;
                }
            }
        }
        if(isset($_POST['action_sort'])){
            $action=$_POST['action_sort'];
            if($action=="sort_order"){
                $sql_order_sort="SELECT *FROM tbl_order ORDER BY order_date DESC";
                $query_order_sort=mysqli_query($conn,$sql_order_sort);
                $order_sort=[];
                while($row=mysqli_fetch_array($query_order_sort)){
                    $order_sort[]=$row;
                }
            }
        }

?>

    <div class="order_management_content">
    
    <?php include 'home_ad.php' ?>
    <div class=" order_management_main">
<!-- Title -->
    <div class="home-tabs">
        <div class="home-tab-title">
                <div class="home-tab-item active">
                    <span>Tất cả</span>
                    <span><?php echo count($order) ?></span>

                </div>
                <div class="home-tab-item">
                    <span>Đặt hàng</span>
                    <span><?php echo count($order_confirm) ?></span>
                </div>
                <div class="home-tab-item">
                    <span>Đang chuẩn bị hàng</span>
                    <span><?php echo count($order_prepare) ?></span>
                </div>
                <div class="home-tab-item">
                    <span>Đang vận chuyển</span>
                    <span><?php echo count($order_transport) ?></span>
                </div>
                <div class="home-tab-item">
                    <span>Đã giao</span>
                    <span><?php echo count($order_delivered) ?></span>
                </div>
                <div class="home-tab-item">
                    <span>Đơn hủy</span>
                    <span><?php echo count($order_cancel) ?></span>

                </div>
                <div class="line"></div>
        </div>

<!-- Content -->
        <div class="home-tab-content">
<!-- Tat ca -->
            <div class="home-tab-pane active">  
                <table>
                    <tr>
                        <td colspan=4>
                            <form method="POST">
                                <label for="" class="label_search">Tìm kiếm</label>
                                <input placeholder="Nhập mã đơn hàng" id="input_search" type="" name="search_txt1" value="<?php if(isset($_POST['action'])) echo $text_search1 ?>">
                                <button type="submit" value="search1" name="action">Tìm kiếm</button>                
                            </form>   
                        </td>
                        <td colspan="3" style="text-align:right;"> 
                        <form method="POST">
                            <button type="submit" name="action_sort" value="sort_order">Sắp xếp theo ngày</button>
                            </form>  
                        </td>
                    </tr>
                 
                    
                    <?php if(isset($_POST['action'])&&$_POST['action']="search1" && $text_search1!="" && $order_search!=[]){?>
                        <tr> <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> <?php echo count($order_search) ?> </span></td></tr>            
                    
                        <tr class="title_order">
                            <td class="title_order1;">Mã hóa đơn</td>
                            <td class="title_order2;">Mã khách hàng</td>
                            <td class="title_order3;">Tổng tiền</td>
                            <td class="title_order4;">Trạng thái</td>
                            <td class="title_order5">Ngày đặt</td>
                            <td colspan="2"></td>
                            
                        </tr>  
                        <?php foreach($order_search as $value):?>
                        <tr>
                            <td><?php echo $value['order_id'] ?></td>
                            <td><?php echo $value['user_id']  ?></td>
                            <td><?php echo $value['order_total'] ?></td>
                            <td >
                                <?php
                                    if($value['order_status']==1){?>
                                        Đặt hàng<?php }?>
                                        <?php if($value['order_status']==2){  ?>
                                            Đang chuẩn bị hàng
                                        <?php }?>
                                        <?php if($value['order_status']==3){  ?>
                                            Đang vận chuyển
                                        <?php }?>
                                        <?php if($value['order_status']==4){  ?>
                                            Giao hàng thành công
                                        <?php }?>
                                        <?php if($value['order_status']==5){  ?>
                                            Đã hủy
                                        <?php }?>
                                </td>
                            <td><?php echo $value['order_date'] ?></td>
                            <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>

                        </tr>
                        <?php endforeach ?>
                        <?php } else if(isset($_POST['action'])&&$text_search1!="" && $order_search==[]) {?>
                            <tr>
                                <td colspan="7"><?php echo "Không có kết quả phù hợp"  ?></td>
                            </tr>
                        <?php } ?>
                </table>
         

                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3">Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php   
                $arr_order=[];
                if(isset($_POST["action_sort"])){
                foreach($order_sort as $value){
                    $arr_order[]=$value;
                }
                 }
                
                else{
                    foreach($order as $value){
                        $arr_order[]=$value;
                    }
                 }

                ?>
                <?php foreach($arr_order as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td >
                        <?php
                            if($value['order_status']==1){?>
                                Đặt hàng<?php }?>
                                <?php if($value['order_status']==2){  ?>
                                    Đang chuẩn bị hàng
                                <?php }?>
                                <?php if($value['order_status']==3){  ?>
                                    Đang vận chuyển
                                <?php }?>
                                <?php if($value['order_status']==4){  ?>
                                    Giao hàng thành công
                                <?php }?>
                                <?php if($value['order_status']==5){  ?>
                                    Đã hủy
                                <?php }?>
                        </td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>

                </tr>
                <?php endforeach ?>
                                

            

                </table>
            </div>
<!-- Dat hang -->
            <div class="home-tab-pane">  
                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3" >Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php foreach($order_confirm as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td>Đặt hàng</td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $value['order_id']?>">
                            <button type="submit" name="order_delete">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
<!-- Dang chuan bi hang -->
            <div class="home-tab-pane">  
                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3">Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php foreach($order_prepare as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td>Đang chuẩn bị hàng</td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="order_id" value="<?php echo $value['order_id']?>">
                            <button type="submit" name="order_delete">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
<!-- Dang van chuyen -->
            <div class="home-tab-pane">  
                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3">Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php foreach($order_transport as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td>Đang vận chuyển </td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                    <td>
                    </td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
<!-- Da giao        -->
            <div class="home-tab-pane">  
                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3">Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php foreach($order_delivered as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td>Giao hàng thành công</td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                    <td></td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
<!-- Don huy   -->
            <div class="home-tab-pane">  
                <table>
                <tr class="title_order">
                    <td class="title_order1">Mã hóa đơn</td>
                    <td class="title_order2">Mã khách hàng</td>
                    <td class="title_order3">Tổng tiền</td>
                    <td class="title_order4">Trạng thái</td>
                    <td class="title_order5">Ngày đặt</td>
                    <td colspan="2"></td>
                    
                </tr>  
                <?php foreach($order_cancel as $value):?>
                <tr>
                    <td><?php echo $value['order_id'] ?></td>
                    <td><?php echo $value['user_id']  ?></td>
                    <td><?php echo $value['order_total'] ?></td>
                    <td >Đã hủy</td>
                    <td><?php echo $value['order_date'] ?></td>
                    <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                    <td>

                    </td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>

           
       
    </div>    </div>
    <script src="../../js/home_tab.js "></script>

</body>
</html>