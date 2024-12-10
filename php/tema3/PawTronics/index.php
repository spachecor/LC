<?php

use repository\ComercialRepository;
use repository\ProductoRepository;
use repository\VentaRepository;

require_once "src/repository/Repository.inc";
require_once "src/repository/ComercialRepository.inc";
require_once "src/repository/ProductoRepository.inc";
require_once "src/repository/VentaRepository.inc";
require_once "src/models/Comercial.php";
require_once "src/models/Producto.php";
require_once "src/models/Venta.php";
require_once "src/services/DateTimeService.inc";
require_once "src/services/ViewService.inc";
//comprobamos si venimos de una inserción o modificación
$dondeIr = $_GET['donde-ir'] ?? '';
//gestionamos en qué punto estamos con las variables que nos indican lo que mostrar
if($dondeIr!==''){
    $activeTab = $dondeIr;
}else $activeTab = $_GET['tab'] ?? 'Comerciales';
$insertButton = $_GET['insert'] ?? '';
$modificar = $_GET['modificar-venta'] ?? '';
if ($insertButton !== '')$activeTab = '';
//comprobamos si venimos de una petición de eliminación
$errorEliminacion = '';
$idEliminar = $_GET['id-eliminar'] ?? '';
$eliminarVenta = $_GET['eliminar-venta'] ?? '';
if($idEliminar!==''){
    $ventaRepository = new VentaRepository();
    if($activeTab=="Comerciales"){
        $repository = new ComercialRepository();
        //buscamos que el id que queramos eliminar no esté vinculado a una venta
        $ventasRelacionadas = $ventaRepository->findComercialInVentas($idEliminar);
        if(empty($ventasRelacionadas))$repository->delete($idEliminar);
        else $errorEliminacion = "<p class='error'>No puedes eliminar un comercial si está vinculado a una venta</p>";
    }
    else{
        $repository = new ProductoRepository();
        //buscamos que el id que queramos eliminar no esté vinculado a una venta
        $ventasRelacionadas = $ventaRepository->findProductoInVentas($idEliminar);
        if(empty($ventasRelacionadas))$repository->delete($idEliminar);
        else $errorEliminacion = "<p class='error'>No puedes eliminar un producto si está vinculado a una venta</p>";
    }
}else if($eliminarVenta !== ''){
    $ventaRepository = new VentaRepository();
    $ventaRepository->delete(
        [
            "codComercial" => $_GET['idCodComercial'],
            "refProducto" => $_GET['idRefProducto'],
            "fecha" => $_GET['idFecha']
        ]
    );
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionador - Pawtronics</title>
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/gestionar.css">
    <link rel="stylesheet" href="assets/css/insertar.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo-mas-marca">
                <div class="logo"></div>
                <p class="marca">Pawtronics</p>
            </div>
            <div class="menu-mas-cerrar-sesion">
                <a href="?tab=Comerciales" class="pestana <?= $activeTab === 'Comerciales' ? 'active' : '' ?>">
                    Comerciales
                </a>
                <a href="?tab=Productos" class="pestana <?= $activeTab === 'Productos' ? 'active' : '' ?>">
                    Productos
                </a>
                <a href="?tab=Ventas" class="pestana <?= $activeTab === 'Ventas' ? 'active' : '' ?>">
                    Ventas
                </a>
                <span href="" class="pestana insercion <?= $insertButton !== '' ? 'active' : '' ?>">
                    
                    <?php
                    if($insertButton!==''){
                        echo "Estás en inserciones : ".$insertButton;
                    }else if($modificar!==''){
                        echo 'Estás en modificaciones: '.$activeTab;
                    }else{
                        echo 'Estás en la tabla: '.$activeTab;
                    }
                    ?>
                </span>
            </div>
        </nav>
    </header>
    <main>
        <!--boton flotante agregar nuevos registros-->
        <div class="boton-flotante">
            <input type="checkbox" id="btn-insert">
            <div class="opciones">
                <a href="?insert=Comerciales" title="Comerciales">Comerciales</a>
                <a href="?insert=Productos" title="Productos">Productos</a>
                <a href="?insert=Ventas" title="Ventas">Ventas</a>
            </div>
            <label for="btn-insert" class="insert-box"></label>
        </div>
        <!--Contenido-->
        <div><?=$errorEliminacion?></div>
        <div class="contenido-main">
            <?php
            if($insertButton!==''||$modificar!=='') include "views/insertar.php";
            else include "views/gestionar.php";
            ?>
        </div>
    </main>
    <footer>
        <hr>
        <p>&copy; 2024 Pawtronics</p>
    </footer>
</body>

</html>