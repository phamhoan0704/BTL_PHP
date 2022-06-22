<?php 

    function total($cart){
        $total=0;
        foreach($cart as $key=>$value):{
            $total+=$value['product_price']*$value["product_amount"];
        }
    endforeach;
    return $total;
    }

?>