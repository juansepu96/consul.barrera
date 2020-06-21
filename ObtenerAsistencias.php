<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$description="";


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM turnos WHERE ((ID_paciente=:valor) AND (estado<>'ASISTIO'))");
    $Consulta->bindParam(':valor',$consultaBusqueda);
    $Consulta->execute();
    $filas=$Consulta->rowcount();

    foreach($Consulta as $Date){
        $timestamp = strtotime($Date['fecha']);
        $new_date = date("d/m/Y", $timestamp);
        $description=$description.$new_date.'@#'.$Date['estado'].'@#';
    }

}

echo $description;


?>