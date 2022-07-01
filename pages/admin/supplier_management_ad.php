<?php
include '../../Database/connect.php'

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
        $sql_supplier="SELECT *FROM tbl_supplier";
        $query_supplier=mysqli_query($conn,$sql_supplier);
       //$li_order=mysqli_fetch_array($query_order);
     
        while ($row = mysqli_fetch_array($query_supplier)){
            $supplier[] = $row;
        }
        // var_dump($order[0]['order_id']);
        // die();
//dang hoat dong
        $sql_supplier_active="SELECT *FROM tbl_supplier WHERE supplier_status=0";
        $query_supplier_active=mysqli_query($conn,$sql_supplier_active);
       //$li_order=mysqli_fetch_array($query_order);
     
        while ($row = mysqli_fetch_array($query_supplier_active)){
            $supplier_active[] = $row;
        }
//an
$supplier_hide = [];
        $sql_supplier_hide="SELECT *FROM tbl_supplier WHERE supplier_status=1";
        $query_supplier_hide=mysqli_query($conn,$sql_supplier_hide);
       //$li_order=mysqli_fetch_array($query_order);
     
        while ($row = mysqli_fetch_array($query_supplier_hide)){
            $supplier_hide[] = $row;
        }

//xoa, khoi phuc
        if(isset($_POST['supplier_delete'])){
            $supplier_id=$_POST['supplier_id'];
            mysqli_query($conn,"UPDATE tbl_supplier SET supplier_status=1 WHERE supplier_id=$supplier_id");
            header('location:supplier_management_ad.php');
        }

        if(isset($_POST['supplier_restore'])){
            $supplier_id=$_POST['supplier_id'];
            mysqli_query($conn,"UPDATE tbl_supplier SET supplier_status=0 WHERE supplier_id=$supplier_id"); 
            header('location:supplier_management_ad.php');
        }
        if(isset($_POST['action'])){
            $action=$_POST['action'];
            if($action=="search1"){
                $text_search1=$_POST['search_txt1'];
                $sql_supplier_search="SELECT * FROM tbl_supplier where supplier_name LIKE '%$text_search1%' ";
                $query_supplier_search=mysqli_query($conn,$sql_supplier_search);
                $supplier_search=[];
                while($row=mysqli_fetch_array($query_supplier_search)){
                    $supplier_search[]=$row;
                }
            }
        }
?>
    <div class="order_management_content">
    
    <?php include 'home_ad.php' ?>

    <div class=" order_management_main">
    <div class="home-tabs">
        <div class="home-tab-title">
                <div class="home-tab-item active">
                    <span>Tất cả</span>
                    <span><?php echo count($supplier) ?></span>
                </div>
                <div class="home-tab-item">
                    <span>Đang hoạt động</span>
                    <span><?php echo count($supplier_active) ?></span>

                </div>
                <div class="home-tab-item">
                    <span>Đã ẩn</span>
                    <span><?php echo count($supplier_hide) ?></span>

                </div>
                <div class="line"></div>
        </div>
<!-- Thêm   -->
        <table>
            <tr>
                <td colspan="7">
                <form method="POST" action="supplier_add_ad.php"> 
                    <button type="submit" name="add">Thêm nhà cung cấp</button>
                 </form> 
                </td>
            </tr>
        </table>
        <div class="home-tab-content">
            <div class="home-tab-pane active">
<!-- tìm kiếm -->
        <table>
            <tr>
               <td colspan=7>
                    <form method="POST">
                        <label for="" class="label_search">Tìm kiếm</label>
                        <input placeholder="Nhập tên nhà cung cấp" id="input_search" type="" name="search_txt1" value="<?php if(isset($_POST['action'])) echo $text_search1 ?>">
                        <button type="submit" value="search1" name="action">Tìm kiếm</button>                
                    </form>   
                </td>
             </tr>
            <?php if(isset($_POST['action'])&&$_POST['action']="search1" && $text_search1!="" && $supplier_search!=[]){?>
                <tr> <td colspan="7"> Kết quả tìm kiếm :<span style="color: red; font-size: 18px"> <?php echo count($supplier_search) ?> </span></td></tr>            
                <tr class="title_order">
                            <td>Mã nhà cung cấp</td>
                            <td>Tên nhà cung cấp</td>
                            <td>Địa chỉ</td>
                            <td>Số điện thoại</td>
                </tr>  
                <?php foreach($supplier_search as $value):?>
                <tr>
                    <td><?php echo $value['supplier_id'] ?></td>
                    <td><?php echo $value['supplier_name']  ?></td>
                    <td><?php echo $value['supplier_address'] ?></td>
                    <td><?php echo $value['supplier_phone'] ?></td>
                </tr>
                <?php endforeach ?>
                <?php } else if(isset($_POST['action'])&&$text_search1!="" && $supplier_search==[]) {?>
                    <tr>
                        <td colspan="7"><?php echo "Không có kết quả phù hợp"  ?></td>
                    </tr>
                    <?php } ?>
        </table>
 <!-- Danh sách   -->
                <table>

                    <tr class="title_order">
                        <td>Mã nhà cung cấp</td>
                        <td>Tên nhà cung cấp</td>
                        <td>Địa chỉ</td>
                        <td>Số điện thoại</td>
                      
                    </tr>  
                     <?php foreach($supplier as $value):?>
                    <tr>
                        <td><?php echo $value['supplier_id'] ?></td>
                        <td><?php echo $value['supplier_name']  ?></td>
                        <td><?php echo $value['supplier_address'] ?></td>
                        <td><?php echo $value['supplier_phone'] ?></td>
                        <!-- <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td> -->
                        <!-- <td>
                            <form method="POST">
                                <input type="hidden" name="supplier_id" value="<?php echo $value['supplier_id']?>">
                                <button type="submit" name="supplier_delete">Xóa</button>
                            </form>
                        </td> -->
                    </tr>
                    <?php endforeach ?>

                </table>
             
            </div>
<!-- Đang hoat động -->
            <div class="home-tab-pane">
            <form method="POST" action="supplier_add_ad.php">
                <table>
                    <tr class="title_order">
                        <td>Mã nhà cung cấp</td>
                        <td>Tên nhà cung cấp</td>
                        <td>Địa chỉ</td>
                        <td>Số điện thoại</td>
                        <td colspan="2"></td>
                    </tr>  
                     <?php foreach($supplier_active as $value):?>
                    <tr>
                        <td><?php echo $value['supplier_id'] ?></td>
                        <td><?php echo $value['supplier_name']  ?></td>
                        <td><?php echo $value['supplier_address'] ?></td>
                        <td><?php echo $value['supplier_phone'] ?></td>
                        <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="supplier_id" value="<?php echo $value['supplier_id']?>">
                                <button type="submit" name="supplier_delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </table>
                 </form>  
            </div>
<!-- Đã ẩn -->
            <div class="home-tab-pane">
            <form method="POST" action="supplier_add_ad.php">
                <table>
                    <tr class="title_order">
                        <td>Mã nhà cung cấp</td>
                        <td>Tên nhà cung cấp</td>
                        <td>Địa chỉ</td>
                        <td>Số điện thoại</td>
                        <td colspan="2"></td>
                    </tr>  
                     <?php foreach($supplier_hide as $value):?>
                    <tr>
                        <td><?php echo $value['supplier_id'] ?></td>
                        <td><?php echo $value['supplier_name']  ?></td>
                        <td><?php echo $value['supplier_address'] ?></td>
                        <td><?php echo $value['supplier_phone'] ?></td>
                        <td><a href="order_detail_ad.php?id=<?php echo $value["order_id"]?>">Xem chi tiết</a> </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="supplier_id" value="<?php echo $value['supplier_id']?>">
                                <button type="submit" name="supplier_restore">Khôi phục</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach ?>

                </table>
                 </form> 
            </div>

        </div>
    </div>
    </div>
    
    <?php include 'footer_ad.php'; ?>

    <script src="../../js/home_tab.js "></script>
       
    <script>
        document.getElementById("header-supply").style.background = "rgb(1 161 75)";
        document.getElementById("header-supply").style.color = "white";
    </script>
</body>

</html>