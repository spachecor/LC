<?php

use models\Producto;
use models\Comercial;
use models\Venta;
use services\DateTimeService;
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
global $insertButton;
global $activeTab;
global $modificar;
$titulo = "";
if (empty($insertButton) || !isset($insertButton))
    $insertButton = $activeTab;
//control sobre lo que se muestra en la cabecera de la página
if ($modificar == '') {
    switch ($insertButton) {
        case "Comerciales":
            $titulo = "Insertar nuevo comercial";
            break;
        case "Productos":
            $titulo = "Insertar nuevo producto";
            break;
        case "Ventas":
            $titulo = "Insertar nueva venta";
            break;
    }
} else {
    switch ($insertButton) {
        case "Comerciales":
            $titulo = "Modificar comercial";
            break;
        case "Productos":
            $titulo = "Modificar producto";
            break;
        case "Ventas":
            $titulo = "Modificar venta";
            break;
    }
}

//gestionar formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comercialRepository = new ComercialRepository();
    $productoRepository = new ProductoRepository();
    $ventaRepository = new VentaRepository();
    //VALIDACIONES COMERCIALES ----------
    if ($insertButton == 'Comerciales') {
        //validación Código
        if (empty($_POST['codigo'])) {
            $errores['codigo'] = "El código es obligatorio.";
        } else {
            $codigo = $_POST['codigo'];
            if ($modificar == '') {//solo se comprueba en inserciones
                //COMPROBACIÓN QUE COMERCIAL NO REPE
                $comercialBuscado = $comercialRepository->findById($codigo);
                if ($comercialBuscado != null)
                    $errores['comercial-repe'] = "Código ya existente";
            }
        }
        //validación Nombre
        if (empty($_POST['nombreComercial'])) {
            $errores['nombreComercial'] = "El nombre es obligatorio.";
        } else {
            $nombreComercial = $_POST['nombreComercial'];
        }
        //validación Salario
        if (empty($_POST['salario']) || !is_numeric($_POST['salario']) || $_POST['salario'] <= 0) {
            $errores['salario'] = "El salario debe ser un número mayor a 0.";
        } else {
            $salario = (float) $_POST['salario'];
        }
        //validación Número de hijos
        if (empty($_POST['numHijos']) && $_POST['numHijos'] != 0 || !is_numeric($_POST['numHijos']) || $_POST['numHijos'] <= -1 || $_POST['numHijos'] > 70) {
            $errores['numHijos'] = "El número de hijos debe ser igual o mayor de 0 y menor de 70.";
        } else {
            $numHijos = (int) $_POST['numHijos'];
        }
        //validación Fecha de nacimiento
        if (empty($_POST['fechaNacimiento'])) {
            $errores['fechaNacimiento'] = "La fecha de nacimiento es obligatoria.";
        } else {
            $fechaNacimiento = DateTimeService::toDateTimeFromString($_POST['fechaNacimiento']);
        }
    }

    //VALIDACIONES PRODUCTOS ----------
    else if ($insertButton == 'Productos') {
        //validacion referencia
        if (empty($_POST['referencia'])) {
            $errores['referencia'] = "La referencia es obligatoria";
        } else {
            $referencia = $_POST['referencia'];
            if ($modificar == '') {//solo se comprueba en inserciones
                //COMPROBACIÓN DE PRODUCTO NO REPE
                $productoBuscado = $productoRepository->findById($referencia);
                if ($productoBuscado != null)
                    $errores['comercial-repe'] = "Referencia ya existente";
            }
        }
        //validación Nombre
        if (empty($_POST['nombreProducto'])) {
            $errores['nombreProducto'] = "El nombre es obligatorio.";
        } else {
            $nombreProducto = $_POST['nombreProducto'];
        }
        //validacion descripcion
        if (empty($_POST['descripcion'])) {
            $errores['descripcion'] = "La descripción es obligatoria";
        } else {
            $descripcion = $_POST['descripcion'];
        }
        //validacion precio
        if (empty($_POST['precio']) || !is_numeric($_POST['precio']) || $_POST['precio'] <= 0) {
            $errores['precio'] = "El precio debe ser un número mayor a 0.";
        } else {
            $precio = (float) $_POST['precio'];
        }
        //validacion descuento
        if (empty($_POST['descuento']) && $_POST['descuento'] != 0 || !is_numeric($_POST['descuento']) || $_POST['descuento'] <= -1) {
            $errores['descuento'] = "El descuento debe ser un número mayor o igual a 0.";
        } else {
            $descuento = (int) $_POST['descuento'];
        }
    }

    //VALIDACIONES VENTAS ----------
    else {
        //el comercial y el producto no necesitan verificación porque vienen dados por el programa
        $codComercial = $_POST['codComercial'];
        $refProducto = $_POST['refProducto'];
        //validacion cantidad
        if (empty($_POST['cantidad']) || !is_numeric($_POST['cantidad']) || $_POST['cantidad'] < 0) {
            $errores['cantidad'] = "La cantidad debe ser un número mayor o igual a 1";
        } else {
            $cantidad = (int) $_POST['cantidad'];
        }
        //validacion fecha venta
        if (empty($_POST['fechaVenta'])) {
            $errores['fechaVenta'] = "La fecha de venta es obligatoria";
        } else {
            $fechaVenta = DateTimeService::toDateTimeFromString($_POST['fechaVenta']);
            if ($modificar == '') {//solo se comprueba en las inserciones
                //COMPROBACIÓN VENTA NO REPE
                $ventaBuscada = $ventaRepository->findById([
                    "codComercial" => $codComercial,
                    "refProducto" => $refProducto,
                    "fecha" => $_POST['fechaVenta']
                ]);
                if ($ventaBuscada != null)
                    $errores['venta-repe'] = "Venta ya existente";
            }
        }
    }

    if (empty($errores)) {
        //insertar registro
        //1º obtenemos el repository correcto:
        if ($insertButton == "Comerciales") {
            if ($modificar == '') {
                $comercialRepository->insert(new Comercial($codigo, $nombreComercial, $salario, $numHijos, $fechaNacimiento));
            } else
                $comercialRepository->update($_GET['id-modificar'], new Comercial($codigo, $nombreComercial, $salario, $numHijos, $fechaNacimiento));
        } else if ($insertButton == "Productos") {
            if ($modificar == '') {
                $productoRepository->insert(new Producto($referencia, $nombreProducto, $descripcion, $precio, $descuento));
            } else
                $productoRepository->update($_GET['id-modificar'], new Producto($referencia, $nombreProducto, $descripcion, $precio, $descuento));
        } else {
            //buscamos el comercial y el producto
            $comercial = $comercialRepository->findById($codComercial);
            $producto = $productoRepository->findById($refProducto);
            if ($modificar == '') {
                $ventaRepository->insert(new Venta($comercial, $producto, $cantidad, $fechaVenta));
            } else
                $ventaRepository->update(
                    [
                        "codComercial" => $_GET['idCodComercial'],
                        "refProducto" => $_GET['idRefProducto'],
                        "fecha" => $_GET['idFecha']
                    ],
                    new Venta($comercial, $producto, $cantidad, $fechaVenta)
                );
        }
        //redirigir a index.php
        header("Location: index.php?donde-ir=" . $insertButton);
        //terminar el script después de la redirección
        exit;
    }
}
?>
<div class="contenido-insertar">
    <h1><?= $titulo ?></h1>
    <form method="post" action="">
        <!--Formulario Comerciales-->
        <div class="contenedor-formulario" <?= ($insertButton == 'Comerciales') ? '' : 'hidden' ?>>
            <?php
            $comercialAModificar = null;
            if ($modificar != '') {
                $comercialRepository = new ComercialRepository();
                $comercialAModificar = $comercialRepository->findById($_GET['id-modificar']);
            }
            ?>
            <input type="hidden" name="donde-ir" value=<?= $insertButton ?>>
            <div class="fila">
                <label>Código</br>
                    <input type="text" name="codigo" placeholder="Código"
                        value="<?= $comercialAModificar != null ? $comercialAModificar->getId() : '' ?>" <?= $modificar != '' ? 'readonly' : '' ?>>
                </label>
                <label>Nombre</br>
                    <input type="text" name="nombreComercial" placeholder="Nombre"
                        value="<?= $comercialAModificar != null ? $comercialAModificar->getNombre() : '' ?>">
                </label>
                <label>Salario</br>
                    <input type="number" name="salario" placeholder="Salario" step=0.01
                        value="<?= $comercialAModificar != null ? $comercialAModificar->getSalario() : '' ?>">
                </label>
            </div>
            <div class="fila">
                <label>Número de hijos</br>
                    <input type="number" name="numHijos" placeholder="Número de hijos"
                        value="<?= $comercialAModificar != null ? $comercialAModificar->getHijos() : '' ?>">
                </label>
                <label>Fecha de nacimiento</br>
                    <input type="date" name="fechaNacimiento" placeholder="Fecha de nacimiento"
                        value="<?= $comercialAModificar != null ? DateTimeService::toStringFromDateTime($comercialAModificar->getFNacimiento()) : '' ?>">
                </label>
            </div>
            <div>
                <?php
                if (isset($errores) && count($errores) != 0) {
                    foreach ($errores as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                }
                ?>
            </div>
            <div class="fila">
                <input type="submit" value=<?= $modificar == '' ? "Insertar" : "Modificar" ?>>
            </div>
        </div>
        <!--Formulario Productos-->
        <div class="contenedor-formulario" <?= ($insertButton == 'Productos') ? '' : 'hidden' ?>>
            <?php
            $productoAModificar = null;
            if ($modificar != '') {
                $productoRepository = new ProductoRepository();
                $productoAModificar = $productoRepository->findById($_GET['id-modificar']);
            }
            ?>
            <input type="hidden" name="donde-ir" value=<?= $insertButton ?>>
            <div class="fila">
                <label>Referencia</br>
                    <input type="text" name="referencia" placeholder="Referencia"
                        value="<?= $productoAModificar != null ? $productoAModificar->getId() : '' ?>" <?= $modificar != '' ? 'readonly' : '' ?>>
                </label>
                <label>Nombre</br>
                    <input type="text" name="nombreProducto" placeholder="Nombre"
                        value="<?= $productoAModificar != null ? $productoAModificar->getNombre() : '' ?>">
                </label>
                <label>Descripción</br>
                    <input type="text" name="descripcion" placeholder="Descripción"
                        value="<?= $productoAModificar != null ? $productoAModificar->getDescripcion() : '' ?>">
                </label>
            </div>
            <div class="fila">
                <label>Precio</br>
                    <input type="number" name="precio" placeholder="Precio" step=0.01
                        value="<?= $productoAModificar != null ? $productoAModificar->getPrecio() : '' ?>">
                </label>
                <label>Descuento</br>
                    <input type="number" name="descuento" placeholder="Descuento"
                        value="<?= $productoAModificar != null ? $productoAModificar->getDescuento() : '' ?>">
                </label>
            </div>
            <div>
                <?php
                if (isset($errores) && count($errores) != 0) {
                    foreach ($errores as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                }
                ?>
            </div>
            <div class="fila">
                <input type="submit" value=<?= $modificar == '' ? "Insertar" : "Modificar" ?>>
            </div>
        </div>
        <!--Formulario Ventas-->
        <div class="contenedor-formulario" <?= ($insertButton == 'Ventas') ? '' : 'hidden' ?>>
            <?php
            $ventaAModificar = null;
            if ($modificar != '') {
                $ventaRepository = new VentaRepository();
                $ventaAModificar = $ventaRepository->findById(
                    [
                        "codComercial" => $_GET['idCodComercial'],
                        "refProducto" => $_GET['idRefProducto'],
                        "fecha" => $_GET['idFecha']
                    ]
                );
            }
            ?>
            <input type="hidden" name="donde-ir" value=<?= $insertButton ?>>
            <div class="fila">
                <label>Nombre del comercial</br>
                    <select name="codComercial">
                        <?php
                        $comercialRepository = new ComercialRepository();
                        $comerciales = $comercialRepository->findAll();
                        foreach ($comerciales as $comercial) {
                            $selected = '';
                            if ($modificar == '') {
                                if ($comercial === $comerciales[array_key_first($comerciales)])
                                    $selected = ' selected';
                            } else {
                                if ($comercial->getId() == $ventaAModificar->getComercial()->getId())
                                    $selected = ' selected';
                            }
                            echo "<option value='" . $comercial->getId() . "'" . $selected . ">" . $comercial->getNombre() . "</option>";
                        }
                        ?>
                    </select>
                </label>
                <label>Nombre del producto</br>
                    <select name="refProducto">
                        <?php
                        $productoRepository = new ProductoRepository();
                        $productos = $productoRepository->findAll();
                        foreach ($productos as $producto) {
                            $selected = '';
                            if ($modificar == '') {
                                if ($producto === $productos[array_key_first($productos)])
                                    $selected = ' selected';
                            } else {
                                if ($producto->getId() === $ventaAModificar->getProducto()->getId())
                                    $selected = ' selected';
                            }
                            echo "<option value='" . $producto->getId() . "'" . $selected . ">" . $producto->getNombre() . " - " . $producto->getDescripcion() . "</option>";
                        }
                        ?>
                    </select>
                </label>
            </div>
            <div class="fila">
                <label>Cantidad</br>
                    <input type="number" name="cantidad" placeholder="Cantidad"
                        value="<?= $ventaAModificar != null ? $ventaAModificar->getCantidad() : '' ?>">
                </label>
                <label>Fecha de venta</br>
                    <input type="date" name="fechaVenta"
                        value="<?= $ventaAModificar != null ? DateTimeService::toStringFromDateTime($ventaAModificar->getFecha()) : '' ?>">
                </label>
            </div>
            <div>
                <?php
                if (isset($errores) && count($errores) != 0) {
                    foreach ($errores as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                }
                ?>
            </div>
            <div class="fila">
                <input type="submit" value=<?= $modificar == '' ? "Insertar" : "Modificar" ?>>
            </div>
        </div>
    </form>
</div>