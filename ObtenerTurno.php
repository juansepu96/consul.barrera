<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];


$description="";


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM turnos WHERE (ID=:id)");
    $Consulta->bindParam(':id',$consultaBusqueda);
    $Consulta->execute();

    foreach($Consulta as $Date){
        $nombre = ObtenerNombrePaciente($conexion,$Date['ID_paciente']);
        $hora_in = strtotime($Date['hora_inicio']);
        $hora_in = Date('H:i',$hora_in) ;
        $hora_fin = strtotime($Date['hora_fin']);
        $hora_fin = Date('H:i',$hora_fin) ;
        $description=$Date['ID']."@#".$nombre.'@#'.$Date['estado'].'@#'.$hora_in.'@#'.$hora_fin.'@#'.$Date['observaciones'].'@#'.$Date['ID_medico'].'@#'.$Date['ID_paciente'].'@#'.$Date['laboratorio'];
    }

}

echo $description;


?>