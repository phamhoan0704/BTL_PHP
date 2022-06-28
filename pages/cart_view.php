
<?php
include 'header.php';
   //session_start();
   include '../database/connect.php';
    if(isset($_SESSION['user'])){
        //$username=$_SESSION['user'];

        $username=$_SESSION['user'];


        $result=mysqli_fetch_array(mysqli_query($conn,"SELECT user_id FROM tbl_user WHERE user_name='$username'"));
        $user_id=$result['user_id'];

        $result2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_cart WHERE user_id='$user_id'"));

        $cart_id=$result2['cart_id'];      

        $pdt="SELECT * FROM tbl_cart INNER JOIN tbl_cart_detail ON tbl_cart.cart_id=tbl_cart_detail.cart_id
        INNER JOIN tbl_product ON tbl_product.product_id=tbl_cart_detail.product_id
         WHERE tbl_cart.cart_id=$cart_id";
         $q=mysqli_query($conn,$pdt);
        $cart=[];
        while($row=mysqli_fetch_array($q)){
            $cart[]=$row;

        }
    }
    else{

        echo "<script>window.location.href='log_in.php?action=cart'</script>";

        $cart=[];
    }
    // echo "<pre>";
    // print_r($cart);

    include 'cart_function.php';
?>


    <div class="cart_container">
          
        <h1>Giỏ hàng</h1>
        <div class="cart_detail">
            <div class="cart_title">
                <div class="cart_title_item cart_img">
                </div>
                <div class="cart_title_item cart_name">
                    <p>Tên sản phẩm</p>
                </div>
                <div class="cart_title_item cart_qty">
                    <p>Số lượng</p>
                </div>
                <div class="cart_title_item cart_price">
                    <p>Giá tiền</p>
                </div>
                <div class="cart_title_item cart_remove">
                </div>
            </div>
            <div class="cart_list">
     
       <form action="cart.php" method="GET"> 
            
            <?php foreach($cart as $key=>$value): ?> 
                             
                <div class="cart_item">
                    <div class="cart_img">
                        <a href="productdetail.php?id=<?php echo $value["product_id"]?>"><img src="../img/product/<?php echo $value['product_image']?>" alt=""></a>
                    </div>
                    <div class="cart_name">
                        <a href="productdetail.php?id=<?php echo $value["product_id"]?>">	<?php echo $value['product_name'] ?></a>
                    </div>
                    <div class="cart_qty">
                    <!-- <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo $value['product_id']?>"> -->
                    <p><input type="number" name="quantity[<?=$value['product_id']?>]" value="<?php echo $value['product_amount']?>" min=1> </p>  
                    </div>
                    <div class="cart_price">
                        <p><?php echo number_format($value['product_price']) ?>đ</p>
                    </div>

                    <div class="cart_remove">
                        <a href="cart.php?id=<?php echo $value['product_id']?>&action=delete">Xóa</a>
                   
                    </div>
                </div>
                
            <?php endforeach?>
                <!-- <div class="cart_item">
                    <div class="cart_img">
                        <a href=""><img src="../Image/product_image/pdt2.png" alt=""></a>
                    </div>
                    <div class="cart_name">
                        <a href="">Re: Zero - Bắt Đầu Lại Ở Thế Giới Khác - 12</a>
                    </div>
                    <div class="cart_qty">
                        <p><input type="number" value="1" min=1></p>   
                    </div>
                    <div class="cart_price">
                        <p>VND 102.000</p>
                    </div>
                    <div class="cart_remove">
                        <a href="">Xóa</a>
                    </div>
                </div> -->
            </div>
            <div class="cart_total">
                <div class="cart_img"></div>
                <div class="cart_name"></div>
                <div class="cart_qty"><p>Tổng cộng</p></div>
             
                <div class="cart_price"><p><?php echo total($cart) ?> </p></div>
            </div>
        

        <div class="cart_btn">
            <div class="cart_return">
                <a href="home.php">
                    <i class="fa fa-solid fa-reply"></i>
                    <p>Tiếp tục mua hàng</p>
                </a>
            </div>

                <button type="submit" onclick="" name="action" value="order">
               Thanh toán<i class="fa fa-solid fa-angles-right"></i>
                
             </button>
 
                    <button type="submit" onclick="" name="action" value="update">
                    Cập nhật
                    <i class="fa fa-solid fa-angles-right"></i>
                    </button>      
       </form>           
        </div>
    </div>
    </div>
    <?php include 'footer.php'?>
