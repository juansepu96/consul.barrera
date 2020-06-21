<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM profesionales WHERE ID=:valor");
    $Consulta->bindParam(':valor',$consultaBusqueda);
    $Consulta->execute();
    $filas=$Consulta->rowcount();

    foreach($Consulta as $Date){
        $hora_in = strtotime($Date['hora_inicio']);
        $hora_in = Date('H:i',$hora_in) ;
        $hora_fin = strtotime($Date['hora_fin']);
        $hora_fin = Date('H:i',$hora_fin) ;
        $description=$Date['ID']."@#".$Date['nombre']."@#".$Date['user'].'@#'.$Date['password']."@#".$Date['tipo'].'@#'.$Date['activo']."@#".$Date['tiempo'].'@#'.$hora_in.'@#'.$hora_fin;
    }

}

echo $description;


?>