<?php

require_once "PDO.php";

$datos =$_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$ActualizarConfiguracion=$conexion->prepare("UPDATE configuraciones SET color=:color WHERE tipo=:tipo");
$ActualizarConfiguracion->bindParam(':tipo',$datos[0]);
$ActualizarConfiguracion->bindParam(':color',$datos[1]);
$ActualizarConfiguracion->execute();

?>