<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<?php
//comenzamos la conexion
$host = "localhost";
$db = "ventas_comerciales";
$user = "dam";
$pass = "hlc";
$dns = "mysql:host=$host;dbname=$db";
$connection = new PDO($dns, $user, $pass);

//hacemos las consultas
$resultadoComerciales = $connection->query('select nombre from comerciales');
$resultadoComerciales->bindColumn(1, $nombre);
while($registro = $resultadoComerciales->fetch(PDO::FETCH_OBJ)){
    echo $nombre;
}
?>
</body>
</html>