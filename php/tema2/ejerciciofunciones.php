<?php
    $iva = true;
    $precio = 10;
    //precio_con_iva();
    if($iva){
        function precio_con_iva(){
            global $precio;
            $precio_iva = $precio * 1.10;
            print "El precio con IVA es ".$precio_iva;
        }
    }
    precio_con_iva();
?>