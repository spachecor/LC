<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar datos</title>
    <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <?php
        include_once("UsuarioDAO.php");
        $usuarioDao = new UsuarioDAO();
        $json_data_number = count($usuarioDao->get_all_data());
    ?>
    <span id="numeroRegistros"><?php echo $json_data_number?></span>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <form method="post" action="lista.php">
                    <div class="box d-flex flex-column justify-content-evenly align-items-center">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingNombre" placeholder="Nombre" name="nombre" required>
                            <label for="floatingNombre">Nombre</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" name="email" required>
                            <label for="floatingEmail">Email</label>
                        </div>
                        <span id="oculto" class="subtitle text-center" style="display: none;">¡Cupo lleno! Pulsa en "¡Conócenos!" para saber quienes somos.</span>
                        <button id="boton" type="submit" class="btn btn-dark mt-3 boton">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let numeroRegistros = document.getElementById("numeroRegistros").innerText;
        if(numeroRegistros>=15){
            let nombre = document.getElementById("floatingNombre");
            let email = document.getElementById("floatingEmail");
            let boton = document.getElementById("boton");
            let oculto =document.getElementById("oculto");
            oculto.style.display = "block";
            boton.innerText = "¡Conócenos!";
            nombre.readOnly = true;
            email.readOnly = true;
            email.style.width = "23rem"
            nombre.value = "No podrás rellenarme.";
            email.value = "¡Ya no aceptamos más miembros!"
        }
    </script>
</body>
</html>