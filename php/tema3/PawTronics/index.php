<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<?php

use models\Producto;
use models\Comercial;
use models\Venta;
use repository\ComercialRepository;
use repository\ProductoRepository;
use repository\VentaRepository;
use services\DateTimeService;

require_once("src/services/Connection.php");
require_once("src/repository/Repository.php");
require_once("src/repository/ProductoRepository.php");
require_once("src/repository/ComercialRepository.php");
require_once("src/repository/VentaRepository.php");
require_once ("src/models/Entity.php");
require_once ("src/models/Producto.php");
require_once ("src/models/Comercial.php");
require_once ("src/models/Venta.php");
require_once("src/services/DateTimeService.php");

$productoRepository = new ProductoRepository();
$comercialRepository = new ComercialRepository();
$ventaRepository = new VentaRepository();

$producto = new Producto('AC0088', "Zapatillas tiburón", "Muy blanditas", 8.95, 10);
//$productoRepository->insert($producto);

$comercial = new Comercial('123', "Vicente Carrillo", 1800.65, 5, DateTimeService::toDateTimeFromString('1999-12-06 20:23:00'));
//$comercialRepository->insert($comercial);

$venta = new Venta($comercial, $producto, 5, DateTimeService::toDateTimeFromString('2024-12-03 15:03:15'));
//$ventaRepository->insert($venta);
$ventaRepository->delete($venta->getId());
//LISTA DE PENDIENTES
//todo agregar el .inc.php en todos los archivos agregables
?>
</body>
</html>