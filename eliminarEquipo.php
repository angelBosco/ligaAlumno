<?php
include_once "modelo/Equipo.php";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $r = Equipo::eliminarDeBd($id);
    if ($r == 1) {
        echo '<div class="alert alert-success"> Se ha eliminado un registro</div>';
    } else {
        echo '<div class="alert alert-danger"> No se ha eliminado nada</div>';
    }
}
