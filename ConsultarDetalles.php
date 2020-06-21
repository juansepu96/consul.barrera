<?php

require_once "PDO.php";

$consultaBusqueda = $_POST['valorBusqueda'];

$ConsultarDetalles = $conexion -> prepare("SELECT * FROM observaciones WHERE fecha=:fecha");
$ConsultarDetalles -> bindParam(':fecha',$consultaBusqueda);
$ConsultarDetalles -> execute();

$celdas = $ConsultarDetalles->RowCount();

if($celdas<1){ // No hay detalles, creamos el registro en la BD
    $InsertarDetalle = $conexion->prepare ("INSERT INTO observaciones (fecha,detalles) VALUES (:fecha,:detalles)");
    $InsertarDetalle -> bindParam(':fecha',$consultaBusqueda);
    $detalles='';
    $InsertarDetalle -> bindParam(':detalles',$detalles);
    $InsertarDetalle -> execute();
}

// Volvemos a hacer la consulta y cargamos el contenido en el modal. 

$ConsultarDetalles = $conexion -> prepare("SELECT * FROM observaciones WHERE fecha=:fecha");
$ConsultarDetalles -> bindParam(':fecha',$consultaBusqueda);
$ConsultarDetalles -> execute();

foreach ($ConsultarDetalles as $Result){
    $description = $Result['detalles'];
break;
}


echo $description;


?>