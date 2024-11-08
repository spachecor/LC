<?php
    $modulos = array(
        "PR" => "Programación",
        "BD" => "Bases de datos",
        //...,
        "DWES" => "Desarrollo web en entorno servidor"
    );
    
    foreach ($modulos as $codigo => $modulo) {
        print "El código del módulo " . $modulo . " es " . $codigo . "</br>";
    }
?>