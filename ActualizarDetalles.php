<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$ActualizarDetalles=$conexion->prepare("UPDATE observaciones SET detalles=:detalles WHERE fecha=:fecha");
$ActualizarDetalles->bindParam(':detalles',$datos[1]);
$ActualizarDetalles->bindParam(':fecha',$datos[0]);
if($ActualizarDetalles->execute()){
    echo "OK";
}else{
    echo "NO";
}



?>