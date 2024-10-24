<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambito variables locales</title>
</head>
<body>
    <?php
        function calcularSuma($num1, $num2){
            return (int)$num1+(int)$num2;
        }
        $num1 = 2;
        $num2 = 3;
        echo "La suma de ".$num1." y ".$num2." da: ".calcularSuma($num1, $num2);
    ?>
</body>
</html>