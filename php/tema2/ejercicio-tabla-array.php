<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio tabla</title>
</head>
<body>
    <?php
        $funciones = array(
            "reset" => "Sitúa el puntero interno al comienzo del array.",
            "next" => "Avanza el puntero interno una posición.",
            "prev" => "Mueve el puntero interno una posición hacia atrás."
        );
    ?>
    <table>
        <tr>
            <th>
                Función
            </th>
            <th>
                Resultado
            </th>
        </tr>
        <?php
            foreach($funciones as $clave => $valor){
                print("<tr><td>".$clave."</td><td>".$valor."</td></tr>");
            }
        ?>
    </table>
</body>
</html>