<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];


if(isset($consultaBusqueda)){
    $Consulta=$conexion->prepare("SELECT * FROM pacientes WHERE ID=:valor");
    $Consulta->bindParam(':valor',$consultaBusqueda);
    $Consulta->execute();
    $filas=$Consulta->rowcount();

    foreach($Consulta as $Date){
        $description=$Date['DNI']."@#".$Date['nombre'].'@#'.$Date['apellido']."@#".$Date['domicilio'].'@#'.$Date['fecha_nac']."@#".$Date['celular'].'@#'.$Date['tel2'].'@#'.$Date['recomendacion'].'@#'.$Date['ciudad'].'@#'.$Date['os'].'@#'.$Date['afiliado'].'@#'.$Date['email'].'@#'.$Date['observaciones'].'@#'.$Date['facebook'].'@#'.$Date['nro_hc'].'@#'.$Date['activo'];
    }

}

echo $description;


?>