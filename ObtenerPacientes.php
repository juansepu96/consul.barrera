<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$consultaBusqueda='%'.$consultaBusqueda.'%';

$description="";


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM pacientes WHERE ((nombre LIKE :id) OR (DNI like :id) OR (apellido LIKE :id) OR (observaciones LIKE :id) ) ORDER BY apellido ASC");
    $Consulta->bindParam(':id',$consultaBusqueda);
    $Consulta->execute();

    foreach($Consulta as $Date){
        $description=$description.$Date['nombre']."@#".$Date['apellido'].'@#'.$Date['DNI'].'@#'.$Date['ID'].'@#';
    }

}

echo $description;


?>