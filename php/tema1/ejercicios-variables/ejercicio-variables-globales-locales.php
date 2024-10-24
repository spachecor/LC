<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables globales y locales</title>
</head>
<body>
    <?php
        $pi = 3.14159;
        function calcularAreaCirculo($radio){
            global $pi;
            return round($pi*pow($radio, 2), 2);
        }
        $radio = 3;
        echo "El área de un círculo con radio = ".$radio." es de: ".calcularAreaCirculo($radio);
    ?>
</body>
</html>