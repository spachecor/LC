<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio fechas</title>
</head>
<body>
        <?php
        //Miércoles, 13 de Abril de 2011
        //date_default_timezone_set('Europe/Madrid');

        echo fechaEspanol(date('d'), date('w'), date('n'), date('Y'));

        function fechaEspanol($dia, $diaSemana, $mes, $anio){
            $meses = array(
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Novimebre",
                "Diciembre"
            );
            $semana = array(
                "Lunes",
                "Martes",
                "Miércoles",
                "Jueves",
                "Viernes",
                "Sábado",
                "Domingo"
            );
            return $semana[((integer)$diaSemana)-1].", ".$dia." de ".$meses[((integer)$mes)-1]." de ".$anio;
        }
        ?>
</body>
</html>