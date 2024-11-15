<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inserción</title>
</head>
<body>
    <?php

        $familia = $_POST["familia"];

        $servidor = "127.0.0.1";
        $usuario = "root";
        $bd = "dwes";
        $password = "";

        $conexion = mysqli_connect($servidor,$usuario,$password,$bd) or die("Error de conexion");

        $consulta = "SELECT cod, nombre, nombre_corto, descripcion, PVP, familia FROM producto WHERE producto.familia = '$familia'";

        $registros = mysqli_query($conexion, $consulta); //registros contiene un array con arrays(1 array por registro.)
    ?>
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Nombre corto</th>
            <th>Descripción</th>
            <th>PVP</th>
            <th>Familia</th>
        </tr>
        <?php
            foreach($registros as $k => $v){
                echo "<tr><td>".$v['cod']."</td><td>".$v['nombre']."</td><td>".$v['nombre_corto']."</td><td>".$v['descripcion']."</td><td>".$v['PVP']."</td><td>".$v['familia']."</td></tr>";
            }  
        ?>
    </table>
</body>
</html>