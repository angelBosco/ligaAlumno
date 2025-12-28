<?php
include_once "modelo/Equipo.php";
$id = $_GET['id'];
$a = Equipo::getEquipo($id);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form method="POST" class="col-4 m-auto p-3"> <!-- action="modificarRegistro.php" -->
        <h5 class="text-center alert alert-secondary">Modificar Alumno</h5>
        <?php
        include_once "procesarModificacion.php";
        ?>
        <!-- Campo oculto para enviar el id del alumno a modificar. -->
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $a->get_nombre() ?>">
        </div>
        <div class="mb-3">
            <label for="puntos" class="form-label">Puntos</label>
            <input type="number" class="form-control" name="puntos" id="puntos" value="<?= $a->get_puntos() ?>">
        </div>
        <div class="mb-3">
            <label for="golesF" class="form-label">Goles Favor</label>
            <input type="number" class="form-control" name="golesF" id="golesF" value="<?= $a->get_golesFavor() ?>">
        </div>
        <div class="mb-3">
            <label for="golesC" class="form-label">Goles Contra</label>
            <input type="number" class="form-control" name="golesC" id="golesC" value="<?= $a->get_golesContra() ?>">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success" name="btnModificar" value="ok">Modificar Equipo</button>
            <button class="btn btn-light">limpiar</button>
        </div>
    </form>
</body>

</html>