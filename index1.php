<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
    <!-- Para usar bootstrap-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Para usar los iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container my-3">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 col-cl-8 py-4 bg-white">
                <h2>Listado de Equipos</h2>
                <?php
                include_once 'eliminarEquipo.php';
                ?>

                <form action="maxGoleador.php" method="POST">
                    <button type="button" class="btn btn-success" name="btnSumar">Sumar 2 puntos a todos los equipos</button>

                    <table id="dataTable1" class="table table-primary">
                        <thead>
                            <tr>
                                <th class="centrado">#</th>
                                <th class="centrado">Equipo</th>
                                <th class="centrado">Puntos</th>
                                <th class="centrado">Goles +</th>
                                <th class="centrado">Goles -</th>
                                <th class="centrado">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //vamos a mezclar codigo php
                            //incluyo el modelo para poder utilizar el codigo de la clase Equipo.
                            include_once "modelo/Equipo.php";
                            //invoco a este metodo estatico ::
                            //va a la bd, la recorre fila a fila y lee todo, crea un objeto Equipo y devuelve una array de registros
                            //:: por que es estatico 
                            $rows = Equipo::getEquiposClass();
                            //bucle
                            //antes de poner codigo html tengo que cerrar el php
                            foreach ($rows as $equi) { ?>
                                <tr>
                                    <!-- cuando vamos a especificar el contenido, necesitamos php para obtener la informacion -->
                                    <td class="centrado"><?= $equi->get_id() ?> </td>
                                    <td class="centrado"><?= $equi->get_nombre() ?></td>
                                    <td class="centrado"><?= $equi->get_puntos() ?></td>
                                    <td class="centrado"><?= $equi->get_golesFavor() ?></td>
                                    <td class="centrado"><?= $equi->get_golesContra() ?></td>
                                    <td clase="centrado">
                                        <!-- para editar tenemos que crear otra pagina casi igual, pero con el boton actualizar. -->
                                        <a href="modificarEquipo.php?id=<?= $equi->get_id() ?>">
                                            <i class="bi bi-pencil-fill bg-warning m-2"></i>
                                        </a>
                                        <!-- vas a saltar del index1 a la misma pero con el parametro de la fila que quiero borrar -->
                                        <a href="index1.php?id=<?= $equi->get_id() ?>">
                                            <i class="bi bi-trash-fill bg-danger"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" names="btnmax">Obtener el equipo mas goleador</button>
            </div>
        </div>
</body>

</html>