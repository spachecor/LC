<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inserción</title>
</head>
<body>
    <?php

        $cod = $_POST["cod"];
        $nombre = $_POST["nombre"];
        $nombre_corto= $_POST["nombre_corto"];
        $descripcion = $_POST["descripcion"];
        $pvp = $_POST["pvp"];
        $familia = $_POST["familia"];

        $servidor = "127.0.0.1";
        $usuario = "root";
        $bd = "dwes";
        $password = "";

        $conexion = mysqli_connect($servidor,$usuario,$password,$bd) or die("Error de conexion");

        $insert = "INSERT producto (cod, nombre, nombre_corto, descripcion, PVP, familia) VALUES ('$cod', '$nombre','$nombre_corto','$descripcion','$pvp','$familia')";

        mysqli_query($conexion, $insert);
        print ("Se ha introducido el producto de código: ".$cod);


    ?>
</body>
</html>