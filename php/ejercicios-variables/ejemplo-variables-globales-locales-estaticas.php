<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables Globales - Locales</title>
</head>
<body>
    <?php
    $a = 1;
    function prueba(){
        global $a;
        $b = $a;
        echo $b;
    }
    prueba();
    function pruebaDos(){
        static $c = 0;
        $c++;
        echo $c;
    }
    pruebaDos();
    pruebaDos();
    pruebaDos();
    pruebaDos();
    pruebaDos();
    pruebaDos();
    ?>
</body>
</html>