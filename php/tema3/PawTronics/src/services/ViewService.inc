<?php
namespace services;
use models\Venta;

/**
 * Clase de respaldo de las vistas, que engloba métodos que ayudan a evitar la redundancia de código
 * @author Selene
 * @version 1.0
 */
class ViewService
{
    /**
     * Función que convierne un array en el contenido de una tabla regido por el contenido del array
     * @param array $array Las entidades que se mostrarán en el contenido de la tabla
     * @param string $activeTab La pestaña actual en la que no encontramos
     * @return void
     */
    public static function loopThroughArrayElements(array $array, string $activeTab): void
    {
        foreach ($array as $dato) {
            $bordeInferior = "";
            $bordeSuperior = "";
            if ($dato === end($array))
                $bordeInferior = " class='borde-inferior'";
            if ($dato === $array[array_key_first($array)])
                $bordeSuperior = " class='borde-superior'";
            echo "<tr>";
            if (is_a($dato, Venta::class)) {
                echo "<td$bordeInferior$bordeSuperior>" . $dato->getComercial()->getId() . "</td>";
                echo "<td$bordeInferior$bordeSuperior>" . $dato->getProducto()->getId() . "</td>";
                echo "<td$bordeInferior$bordeSuperior>" . $dato->getCantidad() . "</td>";
                echo "<td$bordeInferior$bordeSuperior>" . DateTimeService::toStringFromDateTime($dato->getFecha()) . "</td>";
                echo "
                <td$bordeInferior$bordeSuperior>
                    <form method='get' action='index.php'>
                        <input type='hidden' name='tab' value='" . $activeTab . "'/>
                        <input type='hidden' name='eliminar-venta' value='true'/>
                        <input type='hidden' name='idCodComercial' value='".$dato->getComercial()->getId()."'/>
                        <input type='hidden' name='idRefProducto' value='".$dato->getProducto()->getId()."'/>
                        <input type='hidden' name='idFecha' value='".DateTimeService::toStringFromDateTime($dato->getFecha())."'/>
                        <input type='submit' class='eliminar' value=''/>
                    </form>
                </td>";
                echo "
                <td$bordeInferior$bordeSuperior>
                    <form method='get' action='index.php'>
                        <input type='hidden' name='tab' value='" . $activeTab . "'/>
                        <input type='hidden' name='modificar-venta' value='true'/>
                        <input type='hidden' name='idCodComercial' value='".$dato->getComercial()->getId()."'/>
                        <input type='hidden' name='idRefProducto' value='".$dato->getProducto()->getId()."'/>
                        <input type='hidden' name='idFecha' value='".DateTimeService::toStringFromDateTime($dato->getFecha())."'/>
                        <input type='submit' class='modificar' value=''/>
                    </form>
                </td>";
            } else {
                $datoArray = $dato->toArray();
                foreach ($datoArray as $elemento) {
                    echo "<td$bordeInferior$bordeSuperior>" . $elemento . "</td>";
                }
                echo "
                <td$bordeInferior$bordeSuperior>
                    <form method='get' action='index.php'>
                        <input type='hidden' name='tab' value='" . $activeTab . "'/>
                        <input type='hidden' name='id-eliminar' value='" . $dato->getId() . "'/>
                        <input type='submit' class='eliminar' value=''/>
                    </form>
                </td>";
                echo "
                <td$bordeInferior$bordeSuperior>
                    <form method='get' action='index.php'>
                        <input type='hidden' name='modificar-venta' value='true'/>
                        <input type='hidden' name='tab' value='" . $activeTab . "'/>
                        <input type='hidden' name='id-modificar' value='" . $dato->getId() . "'/>
                        <input type='submit' class='modificar' value=''/>
                    </form>
                </td>";
            }
            echo "</tr>";
        }
    }
}