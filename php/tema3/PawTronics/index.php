<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<?php
require_once ("db/Connection.php");
require_once ("db/Repository.php");
require_once ("db/ProductoRepository.php");
require_once ("models/Entity.php");
require_once ("models/Producto.php");
$connection = (new Connection())->getConnection();

//hacemos las consultas
$resultadoComerciales = $connection->query('select nombre from comerciales');
$resultadoComerciales->bindColumn(1, $nombre);
while($registro = $resultadoComerciales->fetch(PDO::FETCH_OBJ)){
    echo $nombre."</br>";
}

//hacemos insercion con repository
$productoRepository = new ProductoRepository();
//$productoRepository->insert(new Producto("ffecsaf", "Sujetador", "Normativo", 63.99, 0));
//$productoRepository->update(new Producto(32, "Vaqueros ya no tan increibles", "Meh", 12.95, 50));
//$productoRepository->delete("32");
$productoBuscado = $productoRepository->findById("PC0001");
if ($productoBuscado) {
    echo "</br>" .
        $productoBuscado->getNombre() . " " .
        $productoBuscado->getDescripcion() . " " .
        $productoBuscado->getPrecio() . " " .
        $productoBuscado->getDescuento() . "</br></br>";
} else {
    echo "</br>"."null"."</br></br>";
}
//echo "</br>".$productoBuscado->getNombre()." ".$productoBuscado->getDescripcion()." ".$productoBuscado->getPrecio()." ".$productoBuscado->getDescuento()."</br></br>";
$resultadoProductos = $productoRepository->findAll();
foreach($resultadoProductos as $producto){
    echo $producto->getNombre()."</br>";
}


?>
</body>
</html>