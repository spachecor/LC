<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de temperatura</title>
</head>
<body>
    <?php
    $tipo_conversion=null;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //tomamos los valores de temperatura y el tipo de conversión
        $temp1 = (int)$_POST['temp1'];
        $tipo_conversion = $_POST['tipo_conversion'];
        $resultado = 0;
        if($tipo_conversion=="fahrenheit-celsius"){
            $resultado = ($temp1-32)*(5/9);
        }else{
            $resultado = ($temp1*(9/5))+32;
        }
    }
    if(!$tipo_conversion)$tipo_conversion="fahrenheit-celsius";
    ?>
    <h1>Conversor de temperatura</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Elige el tipo de conversión:
            <select name="tipo_conversion">
                <option value="fahrenheit-celsius" <?php echo ($tipo_conversion == "fahrenheit-celsius") ? 'selected' : ''; ?>>De Fahrenheit a Celsius</option>
                <option value="celsius-fahrenheit" <?php echo ($tipo_conversion == "celsius-fahrenheit") ? 'selected' : ''; ?>>De Celsius a Fahrenheit</option>
            </select>
        </label>
        <input type="number" name="temp1" value="<?php echo $temp1; ?>"/>
        <input type="number" name="temp2" value="<?php echo $resultado; ?>" readonly/>
        <input type="submit" value="Convertir">
    </form>
</body>
</html>