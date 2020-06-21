<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$InsertarCte=$conexion->prepare("INSERT INTO cte (ID_paciente,fecha,detalle,importe,tipo) VALUES (:id,:fecha,:detalle,:importe,:tipo)");
$InsertarCte->bindParam('id',$datos[0]);
$InsertarCte->bindParam('fecha',$datos[1]);
$InsertarCte->bindParam('tipo',$datos[2]);
$InsertarCte->bindParam('importe',$datos[3]);
$InsertarCte->bindParam('detalle',$datos[4]);
if($InsertarCte->execute()){
    echo "OK";
}else{
    echo "NO";
}




?>