<?php

    function delivery_fee($total){
        $delivery_fee=0;
        if($total>1000000){
            $delivery_fee=0;
        }
        else if($total<1000000){
            $delivery_fee=25000;
        }
        return $delivery_fee;

    }

?>