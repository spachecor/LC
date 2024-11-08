<?php
function precio_con_iva(&$precio, $iva=0.21) {
    $precio *= (1 + $iva);
}

$precio = 10;
precio_con_iva($precio);
print "El precio con IVA es " . $precio;
?>