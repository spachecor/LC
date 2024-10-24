<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Paridad</title>
</head>
<body>
    <h1>Verificación de paridad</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="numero" required/>
        <input type="submit" value="Comprobar">
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //tomamos los valores del DOM
        $numero = (int)$_POST['numero'];
        $resultado = $numero%2==0?"El número es par":"El número es impar";
        echo $resultado;
    }
    ?>
</body>
</html>