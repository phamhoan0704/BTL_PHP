<?php
    include '../database/connect.php';

    $id = $_GET['id'];
    $choose = $_GET['choose'];
    
    if(!isset($_SESSION["user"]))
        header("location:log_in.php");
    else {
        
        $username=$_SESSION['user'];
        $result=mysqli_fetch_array(mysqli_query($conn,"SELECT user_id FROM tbl_user WHERE user_name='$username'"));
        $user_id=$result['user_id'];

        $result2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_cart WHERE user_id='$user_id'"));
        $cart_id=$result2['cart_id'];
        
        $sql_pdt= "SELECT * FROM tbl_cart INNER JOIN tbl_cart_detail ON tbl_cart.cart_id=tbl_cart_detail.cart_id WHERE tbl_cart_detail.cart_id='$cart_id' AND product_id=$id;"; 
        $old_pdt= mysqli_query($conn,$sql_pdt);
        if(mysqli_fetch_row($old_pdt)>0 ){
            mysqli_query($conn,"UPDATE tbl_cart_detail SET tbl_cart_detail.product_amount=product_amount+1 WHERE product_id=$id AND tbl_cart_detail.cart_id=$cart_id");
        }
        else{        
            mysqli_query($conn,"INSERT INTO tbl_cart_detail(cart_id,product_id,product_amount) VALUES ('$cart_id',$id,1)");
        }
       // echo $choose;
        if($choose == 0) header("location:order.php?action=cart");
        else header("location:cart.php?action=cart");
    }
