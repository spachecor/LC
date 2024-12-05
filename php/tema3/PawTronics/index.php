<?php
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'Comerciales';
$insertButton = isset($_GET['insert']) ? $_GET['insert'] : '';
if ($insertButton !== '')
    $activeTab = '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionador - Pawtronics</title>
    <!--Estilos personalizados-->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/global.css">
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
        <div class="contenido-main">
            <?php
            if($activeTab!=='')include "views/gestionar.php";
            else include "views/insertar.php";
            ?>
        </div>
    </main>
    <footer>
        <hr>
        <p>&copy; 2024 Pawtronics</p>
    </footer>
</body>

</html>