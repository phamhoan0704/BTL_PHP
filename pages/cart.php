<?php
    include '../database/connect.php';
    session_start(); 
    if(isset($_GET["id"])){
        $id=$_GET["id"];
       
    }
    $action=(isset($_GET['action'])) ? $_GET['action']:"add";

    if(!isset($_SESSION["user"])){
        header("location:log_in.php?action=cart");
   }else{
        $username=$_SESSION['user'];
        $result=mysqli_fetch_array(mysqli_query($conn,"SELECT user_id FROM tbl_user WHERE user_name='$username'"));
        $user_id=$result['user_id'];

        $result2=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_cart WHERE user_id='$user_id'"));
        $cart_id=$result2['cart_id'];
       
    if($action=="add"){
    
        $sql_pdt= "SELECT * FROM tbl_cart INNER JOIN tbl_cart_detail ON tbl_cart.cart_id=tbl_cart_detail.cart_id WHERE tbl_cart_detail.cart_id='$cart_id' AND product_id=$id;"; 
        $old_pdt= mysqli_query($conn,$sql_pdt);
        if(mysqli_fetch_row($old_pdt)>0 ){
            
                   
            mysqli_query($conn,"UPDATE tbl_cart_detail SET tbl_cart_detail.product_amount=product_amount+1 WHERE product_id=$id AND tbl_cart_detail.cart_id=$cart_id");
        }
        else{        
            mysqli_query($conn,"INSERT INTO tbl_cart_detail(cart_id,product_id,product_amount) VALUES ('$cart_id',$id,1)");
        }
    }
    if($action=="update"){
        foreach($_GET['quantity'] as $product_id =>$quantity){
            $pdt=mysqli_fetch_array(mysqli_query($conn,"SELECT product_quantity FROM tbl_product WHERE product_id='$product_id'"));
            $product_quantity=$pdt['product_quantity'];
            if($quantity<=$product_quantity)
                 mysqli_query($conn,"UPDATE tbl_cart_detail SET product_amount=$quantity WHERE product_id=$product_id AND cart_id=$cart_id");
            else if($quantity>=$product_quantity){
                mysqli_query($conn,"UPDATE tbl_cart_detail SET product_amount=$product_quantity WHERE product_id=$product_id AND cart_id=$cart_id");

            }
            
       }
     }
     if($action=="delete"){
        $product_id=$_GET["id"];
        mysqli_query($conn,"DELETE FROM tbl_cart_detail WHERE product_id=$product_id AND cart_id=$cart_id");
    }
    if($action=="order"){
        header('location:order.php');
        die();
    }
   }
    //echo $id;



//     $query=mysqli_query($conn,"SELECT *FROM tbl_product WHERE product_id=$id");
//     if($query){
//         $product= mysqli_fetch_array($query);
//     }
//     // $quantity=(isset($_GET["quantity"]))?$_GET['quantity'] : 1;
    
//     //  var_dump($action);
//     //  var_dump($_GET);
//     //  die();

//     $item=[
//         'id'=>$product["product_id"],
//         'name'=>$product["product_name"],
//         'image'=>$product["product_image"],
//         'price'=>($product["product_price"]>0)? $product['product_price']:$product['product_price_pre'],
//         'quantity'=>1
//     ];
// //=======================================================================================
//     if($action=="add"){
//         if(isset($_SESSION['cart'][$id])){
//             $_SESSION['cart'][$id]['quantity']+=1;
//         }else{
//                 $_SESSION['cart'][$id]=$item;
//         }
//     }
//     if($action=="update"){
        
//         foreach($_GET['quantity'] as $id =>$quantity){
//              $_SESSION['cart'][$id]['quantity']=$quantity;
//         }
//      }
//     // if($action=="payment"){
//     //     header('location: order.php');
//     // }
//     if($action=="delete"){
//         unset($_SESSION['cart'][$id]);
//     }






    header('location: cart_view.php');  
    // echo "<pre>";
    // print_r($_SESSION['cart'])
    //them moi vao gio hang



    //cap nhat gio hang

    //xoa san phamkhoi gio hang

?>