<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="shortcut icon" href="img/icono.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <?php
    require_once("Usuario.php");
    include_once("UsuarioDAO.php");
    $usuarioDao = new UsuarioDAO();
    $json_data = $usuarioDao->get_all_data();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'&&count($json_data)<15) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $persona1 = new Usuario($nombre, $email);
        $usuarioDao->insert_to_json($persona1);
    }
    $json_data = $usuarioDao->get_all_data();
    ?>
    <header></header>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="box d-flex flex-column justify-content-evenly align-items-center">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($json_data as $data): ?>
                                <tr>
                                    <td class="text-center"><?= $data->id ?></td>
                                    <td><?= $data->nombre ?></td>
                                    <td><?= $data->email ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>
</body>

</html>