<?php
include_once "modelo/Equipo.php";

if (!empty($_POST["btnModificar"])) {
    if (!empty($_POST["id"]) and (!empty($_POST["nombre"])) and (!empty($_POST["puntos"])) and (!empty($_POST["golesF"])) and (!empty($_POST["golesC"]))) {
        // Creo un objeto alumno con su id para luego invocar al método modicarEnBd()
        //$eq = new Equipo($_POST["nombre"], $_POST["puntos"], $_POST["golesF"], $_POST["golesC"], $_POST["id"]);
        $eq = new Equipo();
        $eq->nombre = $_POST["nombre"];
        $eq->puntos = $_POST["puntos"];
        $eq->golesFavor = $_POST["golesF"];
        $eq->golesContra = $_POST["golesC"];
        $eq->id = $_POST["id"];
        $r = $eq->modificarEnBd();
        // echo "<div class='alert alert-warning'>Se han modificado $r registros</div>";
        if ($r == 1) { //Si se ha modificado de forma correcta, lo redirijo al index
            //la función header se ha de llamar antes de poner ningún código html o escribir echos, incluso con espacios en blanco
            header("location:index1.php");
        } //Si hay algún error, lo notifico
        else {
            echo "<div class='alert alert-danger'>Error al modificar equipo</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Hay algún campo vacío</div>";
    }
}
