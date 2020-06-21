<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$description="";


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM hc WHERE ID_paciente=:valor ORDER BY fecha ASC");
    $Consulta->bindParam(':valor',$consultaBusqueda);
    $Consulta->execute();
    $filas=$Consulta->rowcount();

    foreach($Consulta as $Date){
        $timestamp = strtotime($Date['fecha']);
        $new_date = date("d/m/Y", $timestamp);
        $timestamp2 = strtotime($Date['recordatorio']);
        $new_date2 = date("d/m/Y", $timestamp2);
        $description=$description.$new_date."@#".$new_date2.'@#'.$Date['detalle'].'@#'.$Date['imagen']."@#";
    }

}

echo $description;


?>