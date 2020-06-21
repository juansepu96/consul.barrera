<?php

require_once "PDO.php";

$datos = $_POST['valorBusqueda'];

$datos = explode("@#",$datos);

$InsertarLaboratorio=$conexion->prepare("INSERT INTO laboratorio (ID_paciente,fecha,detalle,importe,tipo) VALUES (:id,:fecha,:detalle,:importe,:tipo)");
$InsertarLaboratorio->bindParam('id',$datos[0]);
$InsertarLaboratorio->bindParam('fecha',$datos[1]);
$InsertarLaboratorio->bindParam('tipo',$datos[2]);
$InsertarLaboratorio->bindParam('importe',$datos[3]);
$InsertarLaboratorio->bindParam('detalle',$datos[4]);
if($InsertarLaboratorio->execute()){
    echo "OK";
}else{
    echo "NO";
}
    



?>