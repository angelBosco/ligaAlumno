<?php
include_once "modelo/Equipo.php";
if(!empty($_POST["btnMax"])) {
    $rows = Equipo::getEquipos();
    foreach ($rows as $equi){
        if($equi->get_golesFavor() > $golesEM){
            $nombreEM = $equi->get_nombre();
            $golesEM = $equi->get_golesFavor();
        }
    }
    echo '<div class="alert alert-sucess">El equipo más goleador es: ' . $nombreEM . '</div>';
}