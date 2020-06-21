<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

    $EliminarTurnos=$conexion->prepare("DELETE FROM turnos WHERE ID=:id");
    $EliminarTurnos->bindParam(':id',$datos);
    if($EliminarTurnos->execute()){
        echo "Turno Eliminado con Exito";
    }else{
        echo "No se pudo eliminar el turno";
    }



?>