<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora</h1>
    <form method ="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="num1" placeholder="Número 1" required/>
        <select name="operador">
            <option value="sumar">+</option>
            <option value="restar">-</option>
            <option value="multiplicar">*</option>
            <option value="dividir">/</option>
        </select>
        <input type="number" name="num2" placeholder="Número 2" required/>
        <input type="submit" value="calcular"/>
    </form>
    <?php
    //primero indicamos que recogemos el formulario, OJO, estamos mirando el método del formulario
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //recogemos los valores
        $num1 = (int)$_POST['num1'];
        $num2 = (int)$_POST['num2'];
        $operador = $_POST['operador'];

        //hacer la cuenta
        $resultado = 0;
        $simbolo_operador;
        switch($operador){
            case "sumar":
                $resultado = $num1+$num2;
                $simbolo_operador = "+";
                break;
            case "restar":
                $resultado = $num1-$num2;
                $simbolo_operador = "-";
                break;
            case "multiplicar":
                $resultado = $num1*$num2;
                $simbolo_operador = "*";
                break;
            case "dividir":
                $resultado = $num1/$num2;
                $simbolo_operador = "/";
                break;
        }

        echo "Resultado: ".$num1." ".$simbolo_operador." ".$num2." = ".$resultado;
    }
    ?>
</body>
</html>