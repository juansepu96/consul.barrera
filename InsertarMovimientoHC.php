<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$InsertarEnHC=$conexion->prepare("INSERT INTO hc (ID_paciente,fecha,recordatorio,detalle) VALUES (:id,:fecha,:recordatorio,:detalle)");
$InsertarEnHC->bindParam('id',$datos[0]);
$InsertarEnHC->bindParam('fecha',$datos[1]);
$InsertarEnHC->bindParam('recordatorio',$datos[2]);
$InsertarEnHC->bindParam('detalle',$datos[3]);
if($InsertarEnHC->execute()){
    echo "OK";
}else{
    echo "NO";
}



?>