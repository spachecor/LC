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
require_once("db/repository/Repository.php");
require_once ("db/repository/ProductoRepository.php");
require_once ("db/repository/ComercialRepository.php");
require_once ("db/repository/VentaRepository.php");
require_once ("models/Entity.php");
require_once ("models/Producto.php");
require_once ("models/Comercial.php");
require_once ("models/Venta.php");
require_once("services/DateTimeService.php");

//echo "<h1><b>Buscar muchas ventas</b></h1>";
$productoRepository = new ProductoRepository();
$comercialRepository = new ComercialRepository();
$ventaRepository = new VentaRepository();
/*$resultadoVentas = $ventaRepository->findAll();
foreach ($resultadoVentas as $venta) {
    echo $venta->getProducto()->getNombre()." ";
    echo $venta->getComercial()->getNombre()."</br>";
}
$registroUnico = $ventaRepository->findById(
        [
            "codComercial" => "333",
            "refProducto" => "CC0003",
            "fecha" => "2014-09-06 13:23:44"
        ]
);*/
//echo "</br>".$registroUnico->getComercial()->getNombre()."</br>";
$productoEjemplo = $productoRepository->findById("PC0001");
$comercialEjemplo = $comercialRepository->findById("333");
/*echo $productoEjemplo->getId()."</br>";
echo $comercialEjemplo->getId()."</br>";
$fecha = DateTimeService::toDateTimeFromString("2024-12-03 13:09:00");
$ventaEjemplo = new Venta($comercialEjemplo, $productoEjemplo, 13, $fecha);
$hecho = $ventaRepository->insert($ventaEjemplo);
echo "Por aqui pase";
echo $hecho;
$comercialEjemplo->setNombre("Leopoldo Inventado");
echo $comercialEjemplo->getNombre()."</br>";
echo $comercialRepository->update("555", $comercialEjemplo);*/
$ventaEncontrada = $ventaRepository->findById(
        [
                "codComercial" => "999",
                "refProducto" => "PC0001",
                "fecha" => "2014-01-02 13:23:44"
        ]
);
echo $ventaEncontrada->getCantidad();
$ventaRepository->delete($ventaEncontrada->getId());
//LISTA DE PENDIENTES
//todo agregar el .inc.php en todos los archivos agregables
?>
</body>
</html>