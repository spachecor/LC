<?php

global $activeTab;

use repository\ComercialRepository;
use repository\ProductoRepository;
use repository\VentaRepository;
use services\ViewService;

require_once "src/repository/Repository.inc";
require_once "src/repository/ComercialRepository.inc";
require_once "src/repository/ProductoRepository.inc";
require_once "src/repository/VentaRepository.inc";
require_once "src/models/Comercial.php";
require_once "src/models/Producto.php";
require_once "src/models/Venta.php";
require_once "src/services/DateTimeService.inc";
require_once "src/services/ViewService.inc";

$repository = null;
//tomamos el array con las entidades según si queremos comerciales, productos o ventas
if ($activeTab == "Comerciales") {
    $repository = new ComercialRepository();
} else if ($activeTab == "Productos") {
    $repository = new ProductoRepository();
} else {
    $repository = new VentaRepository();
}
//creamos el array vacío y lo llenamos con las entidades
$datos = [];
try {
    $datos = $repository->findAll();
} catch (Exception $e) {
    $datos = null;
}
//usamos codComercial como una variable para el filtrado de las ventas por un comercial en concreto
$codigoComercial = $_GET['codComercial'] ?? '';
//guardamos en un array vacío las nuevas entidades coincidentes con las ventas realizadas por un comercial en concreto
$datosFinal = [];
if(!empty($datos) && $codigoComercial!=''){
    $ventaRepository = new VentaRepository();
    $datosFinal = $ventaRepository->findComercialInVentas($codigoComercial);
}else $datosFinal=$datos;
?>
<div class="contenido-gestionar">
    <h1>Bienvenido a <?= $activeTab ?></h1>
    <div class="filtrado" <?=$activeTab!=''&&$activeTab=='Ventas'?'':'hidden'?>>
        <form action="" method="get">
            <label>Filtrar por comercial:
                <select name="codComercial">
                    <?php
                    $comercialRepository = new ComercialRepository();
                    $comerciales = $comercialRepository->findAll();
                    foreach ($comerciales as $comercial) {
                        $selected = '';
                        if($codigoComercial!=''&&$codigoComercial==$comercial->getId())$selected = 'selected';
                        echo "<option value='" . $comercial->getId() . "'".$selected.">" . $comercial->getNombre() . "</option>";
                    }
                    ?>
                </select>
            </label>
            <input type="hidden" name="tab" value="Ventas">
            <input type="submit" value="Filtrar">
        </form>
    </div>
    <table>
        <tr>
            <?php
            if ($activeTab == "Comerciales") {
                echo "<th>Código</th>";
                echo "<th>Nombre</th>";
                echo "<th>Salario</th>";
                echo "<th>Hijos</th>";
                echo "<th>Fecha de nacimiento</th>";
            } else if ($activeTab == "Productos") {
                echo "<th>Referncia</th>";
                echo "<th>Nombre</th>";
                echo "<th>Descripción</th>";
                echo "<th>Precio</th>";
                echo "<th>Descuento</th>";
            } else {
                echo "<th>Código del comercial</th>";
                echo "<th>Referencia del producto</th>";
                echo "<th>Cantidad</th>";
                echo "<th>Fecha</th>";
            }
            ?>
        </tr>
        <?php
        if ($datosFinal == null) {
            if ($activeTab == "Comerciales" || $activeTab == "Productos") {
                for ($i = 0; $i < 5; $i++) {
                    if ($i == 0)
                        echo "<tr>";
                    echo "<td>No hay datos</td>";
                    if ($i == 4)
                        echo "</tr>";
                }
            } else {
                for ($i = 0; $i < 4; $i++) {
                    if ($i == 0)
                        echo "<tr>";
                    echo "<td>No hay datos</td>";
                    if ($i == 3)
                        echo "</tr>";
                }
            }
        } else {
            ViewService::loopThroughArrayElements($datosFinal, $activeTab);
        }
        ?>
    </table>
</div>